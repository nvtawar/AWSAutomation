<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>EC2-EMR Admin Dashboard - Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

  </head>
  <body>  

    
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
	  
        <div class="templatemo-top-nav-container">
		<div class="row">
   <header class="templatemo-site-header">
	  <div class="square"></div>
            <h2>EC2-EMR DASHBOARD</h2>
         
	</header>
	</div>
	  <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <h1><center>EC2 DASHBOARD</center></h1>
				<br/>
			

<h4><center>  
Running Instances: 
<?php
$conn=mysqli_connect("localhost","root","root","dashboard");
// Check connection
if (mysqli_connect_errno())
	  {
		    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		      }
$sql="select count('Status') from dashboardEC2 where Status='running'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
echo "$row[0]";
$running_count = $row[0];
mysqli_close($conn);
?> &nbsp;&nbsp;|&nbsp;&nbsp;
				
Stopped Instances: <?php
$conn=mysqli_connect("localhost","root","root","dashboard");
// Check connection
if (mysqli_connect_errno())
	  {
		    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		      }
$sql="select count('Status') from dashboardEC2 where Status='stopped'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
echo "$row[0]";
$stopped_count=$row[0];
mysqli_close($conn);
?>
&nbsp;&nbsp;|&nbsp;&nbsp;

Total Instances: <?php echo $running_count+$stopped_count; ?>
 </center></h4>
				
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1 col-lg-6 col-md-6">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
            
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">Running Instances</h2></div>
                <div class="table-responsive" style="height:300px;overflow:auto;">
                  <table class="table table-striped table-bordered">
		    <thead>
			<tr>
               <td><b>Instance ID</b></td>
                        <td><b>InstanceType</b></td>
                        <td><b>KeyName</b></td>
                        <td><b>LaunchTime</b></td>
                        <td><b>PrivateIP</b></td>
                        <td><b>UsedBy</b></td>
                        <td><b>Status</b></td>
                      </tr>
                    </thead>
                    <tbody>
		     
<?php
$conn = mysqli_connect("localhost", "root", "root", "dashboard");
// Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT * FROM dashboardEC2 where Status='running'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 // output data of each row
 while($row = $result->fetch_assoc()) {
 echo "<tr><td>" . $row["InstanceID"]. "</td><td>" . $row["InstanceType"] . "</td><td>" . $row["KeyName"]. "</td><td>" . $row["launchTime"]. "</td><td>". $row["PrivateIP"]."</td><td>". $row["UsedBy"]."</td><td>".$row["Status"]."</td></tr>";

 }}
	 $conn->close();
?>                    
                    </tbody>
		  </table> 
                </div>                          
              </div>
	    </div>

		   <div clv class="col-1 col-lg-6 col-md-6">
    <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
   <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">STOPPED INSTANCES</h2></div>
<div class="table-responsive" style="height:300px;overflow:auto;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<td><b>Instance ID</b></td>
<td><b>InstanceType</b></td>
<td><b>KeyName</b></td>
<td><b>LaunchTime</b></td>
               <td><b>PrivateIP</b></td>
                        <td><b>UsedBy</b></td>
              <td><b>Status</b></td>
             </tr>
          </thead>
           <tbody> 
<?php
$conn = mysqli_connect("localhost", "root", "root", "dashboard");
// Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT * FROM dashboardEC2 where Status='stopped'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 // output data of each row
 while($row = $result->fetch_assoc()) {
 echo "<tr><td>" . $row["InstanceID"]. "</td><td>" . $row["InstanceType"] . "</td><td>" . $row["KeyName"]. "</td><td>" . $row["launchTime"]. "</td><td>". $row["PrivateIP"]."</td><td>". $row["UsedBy"]."</td><td>".$row["Status"]."</td></tr>";

 }}
	 $conn->close();
?>                    
                    </tbody>
		  </table> 
                </div>                          
              </div>
	    </div>
          </div> 
		  
		  <div class="templatemo-flex-row flex-content-row">
            <div class="col-1 col-lg-6 col-md-6">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
            
		<div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase"><center>GPU Statistics</center>
</h2></div>
                <div class="table-responsive" style="height:300px;overflow:auto;">
                  <table class="table table-striped table-bordered">
		    <thead>
			<tr>
               <td><b>Instance ID</b></td>
                        <td><b>InstanceType</b></td>
                        <td><b>KeyName</b></td>
                        <td><b>LaunchTime</b></td>
                        <td><b>PrivateIP</b></td>
                        <td><b>UsedBy</b></td>
                        <td><b>Normalized Hours</b></td>
                      </tr>
                    </thead>
                    <tbody>
		     
<?php
$conn = mysqli_connect("localhost", "root", "root", "dashboard");
// Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT * FROM dashboardEC2 where InstanceType='g3.8xlarge' or InstanceType='p3.2xlarge'' and Status='running'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 // output data of each row
 while($row = $result->fetch_assoc()) {
	 $current=time();
	 $launchtime=strtotime($row["launchTime"]);
	 $norm_hours=(-$launchtime+$current)/3600;
 echo "<tr><td>" . $row["InstanceID"]. "</td><td>" . $row["InstanceType"] . "</td><td>" . $row["KeyName"]. "</td><td>" . $row["launchTime"]. "</td><td>". $row["PrivateIP"]."</td><td>". $row["UsedBy"]."</td><td>".$norm_hours."</td></tr>";

 }}
	 $conn->close();
?>                    
                    </tbody>
		  </table> 
                </div>                          
              </div>
				</div>  
		
          </div>
		  
          <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
              <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
               
                <div class="templatemo-flex-row flex-content-row">
                  <div class="col-1 col-lg-6 col-md-12">
                    <h2 class="text-center">Type-wise Instances' Count</h2>
                    <div id="bar_chart_div" class="templatemo-chart"></div> <!-- Bar chart div -->
                  </div>
                  
                </div>                
              </div>
            </div>
          </div>
		  
		  
		  
          <footer class="text-right">
            <p>Copyright &copy;  Seagate
            | Design: AWS EMR Team</p>
          </footer>         
        </div>
      </div>
	  
	    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php
$conn = mysqli_connect("localhost", "root", "root", "dashboard");
// Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT InstanceType, count(*) as Count FROM dashboardEC2 group by InstanceType order by InstanceType";
 $result = $conn->query($sql);
 // create data object
$data = Array();

while ($row = $result->fetch_assoc()) {
   
   $data[] = $row; // Adding to array
   }
// encode data to json format
echo json_encode($data);
echo "<script>
        var my_2d = ".json_encode($data)."
		google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'InstanceType');
        data.addColumn('number', 'Count');
		for(i = 0; i < my_2d.length; i++)
{       var obj =my_2d[i];
    data.addRow([obj.InstanceType, parseInt(obj.Count)]);
}
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'Type-wise Instance Count'};

        // Instantiate and draw the chart
        var chart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
        chart.draw(data, options);
      }
</script>";
	 $conn->close();
?>  
    
  
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>
