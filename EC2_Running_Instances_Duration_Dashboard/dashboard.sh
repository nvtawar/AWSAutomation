
instances_data=$(aws ec2 describe-instances --query 'Reservations[*].Instances[*].{Name:Name,Instance:InstanceId,Type:InstanceType,Key:KeyName,LaunchTime:LaunchTime,PrivateIP:PrivateIpAddress,UsedBY:Tags[?Key==`UsedBy`]|[0].Value,Status:State.Name}' --output json)

total_count=0
running_count=0
stopped_count=0

mysql -u root -proot << EOF 
use dashboard;
delete from dashboardEC2;
EOF

for row in $(echo "${instances_data}" | jq -r '.[][] | @base64'); do
	_jq()	{
		echo ${row} | base64 --decode | jq -r ${1}
	}
total_count=$((total_count+1))
if [ $(_jq '.Status') == "running" ] 
then
	running_count=$((running_count+1))
else
	stopped_count=$((stopped_count+1))
fi

mysql -u root -proot << EOF 
use dashboard;
insert into dashboardEC2 (InstanceID, InstanceType, KeyName, LaunchTime, PrivateIP, UsedBy, Status) values ( "$(_jq '.Instance')","$(_jq '.Type')","$(_jq '.Key')","$(_jq '.LaunchTime')","$(_jq '.PrivateIP')","$(_jq '.UsedBY')","$(_jq '.Status')");
EOF
echo $(_jq '.Instance')
done
printf "Number of total instances:%d\n" $total_count
printf "Number of running instances:%d\n" $running_count
printf "Number of stopped instances:%d\n" $stopped_count
