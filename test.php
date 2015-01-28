<?php
require_once 'classes/XmlParser.php';
require_once 'classes/Activity.php';
require_once 'classes/DB.php';
require_once 'classes/JsonReader.php';
require_once 'classes/User.php';
require_once 'classes/Convertor.php';
require_once 'classes/Lap.php';

//$xmlParser = new XmlParser();
//$xmlParser->read("File/xml.tcx");
//$xml = $xmlParser->fetchLoadedXml();
 
$jsonReader = new JsonReader();
//$jsonFile = Convertor::XmlToJson($xml);
//$jsonReader->read($jsonFile);
//$jsonReader->offset('2', array('Activities','Activity'));
//$jsonFile = $jsonReader->format();
//$jsonReader->create("File/","results2",$jsonFile);

$jsonReader->read('File/results2.json');
$el = $jsonReader->fetchElement("");


$activity = new Activity('bike');
$laps  = $activity->fetchLaps();

$trackpoints = array();

foreach($laps as $lap)
{
    $trackpoints['lap'] = $lap->fetchTrackpoints('60');
}

//$lap = new Lap('1');
//$points =$lap->fetchTrackpoints('100');

?>

<pre>
<?php 
print_r($trackpoints['lap']);
?>

</pre>