<!DOCTYPE html>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <script src="lib/Chartjs/Chart.js"></script>
    <script src="JS/jquery-2.1.1.min.js"></script>
</head>
<body>
    <?php
require_once 'classes/Activity.php';
require_once 'classes/DB.php';
require_once 'classes/JsonReader.php';
require_once 'classes/User.php';
require_once 'classes/Lap.php';

 $jsonReader = new JsonReader();
$jsonReader->read('File/results2.json');
$el = $jsonReader->fetchElement("");


$activity = new Activity('bike');
$laps  = $activity->fetchLaps();

$trackpoints = array();

if(isset($_GET['time']))
    $seconds = $_GET['time'];
else
    $seconds = 10;



foreach($laps as $lap)
{
    $trackpoints['lap'] = $lap->fetchTrackpoints($seconds);
}

//$lap = new Lap('1');
//$points =$lap->fetchTrackpoints('100');

?>
    <script>
       var objs = <?php echo json_encode($trackpoints['lap']);  ?>;
       var heartRates = [];
       
       
       for(var key in objs){
          var obj = objs[key];
          for(var prop in obj)
          {
              if(prop == "heartRate")
                heartRates.push(obj[prop]);
          }
       }
       
       
       
    </script>
    <canvas id="myChart" width="1200" height="500"></canvas>
    <form method="POST">
        <label>Seconds</label>
        <select id="target" name="seconds">
            <option id="a" value="10">10</option>
            <option id="b" value="60">60</option>
        </select>
    </form>
    
<?php
  if(isset($_POST['seconds']))
    $seconds = $_POST['seconds'];
  else
    $seconds = 10;
 
 ?>
    <script src="JS/graph.js"></script>
</body>
</html>