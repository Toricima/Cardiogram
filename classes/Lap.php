<?php

/**
 * Lap short summary.
 *
 * Lap description.
 *
 * @version 1.0
 * @author Tom
 */
 
require_once 'classes/JsonReader.php';
require_once 'classes/Trackpoint.php';
 
class Lap extends JsonReader
{       
    private $_lapNumber;
    
    public function Lap($number)
    {
        $this->_lapNumber = $number;
    }
    
    public function fetchTotalTimeSeconds()
    {
       return $this->fetch("TotalTimeSeconds");
    }
    
    public function fetchDistanceMeters()
    {
        return $this->fetch("fetchDistanceMeters");
    }
    
    public function fetchMaximumSpeed()
    {
        return $this->fetch("MaximumSpeed");
    }
    
    public function fetchAverageHearthRate()
    {
        return $this->fetch("AverageHeartRate");
    }
    
    public function fetchMaximumHeartRate()
    {
        return $this->fetch("MaximumHeartRate");
    }
    
    public function fetchTrackpoints($seconds)
    {
        $trackpoint = new Trackpoint();
        $trackpoints = $trackpoint->create($seconds);
        
        return $trackpoints;
    }
    
    public function fetch($name)
    {
       //$userDir = User::fetchFile();
       $userDir = "File/results2.json";
       $this->read($userDir);
       
       $element = $this->fetchElement($name);
       return $element;
    }
}
