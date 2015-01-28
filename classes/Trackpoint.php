<?php

/**
 * Trackpoint short summary.
 *
 * Trackpoint description.
 *
 * @version 1.3
 * @author Tom
 */
 
require_once 'classes/User.php';
require_once 'classes/File.php';
 
class Trackpoint
{
    public function create($seconds)
    {
        $userInfo = User::fetchFile();
        
        $seconds = $seconds / 4;
        $read = "File/results2.json";
        if(count($userInfo) == 2)
            Logger::logError("missiong Session, check if all the needed sessions are active","needed 2 session(folder, file) to proceed");
        else
        {
            $jsonReader = new JsonReader();
            //$jsonReader->read("File/".$userInfo['userFolder']."/".$userInfo['file']);
            $jsonReader->read($read);
            $trackpoints = $jsonReader->fetchElement("trackpoints");
            
            $distance = array();
            $heart = array();
            $speed = array();
            $calcTrackpoints = array();
            
            for($i = 0; $i < count($trackpoints); $i++)
            {
                array_push($distance, $trackpoints[$i]['distance']);
                array_push($heart, $trackpoints[$i]['heartRate']);
                array_push($speed, $trackpoints[$i]['speed']);
                
                if($i % $seconds == 0)
                {
                    $temp_array = array
                    (
                        'distance' => $this->calcAverage($distance),
                        'heartRate' => $this->calcAverage($heart),
                        'speed' => $this->calcAverage($speed),
                    );
                    
                    array_push($calcTrackpoints, $temp_array);
                    $temp_array = array();
                }
            }
            return $calcTrackpoints;
        }
        
    }
    
    private function calcAverage($targetArray = array())
    {
        $total = 0;
        $count = count($targetArray);
        
        foreach($targetArray as $target)
        {
            $total += $target;
        }
        
        return $total / $count;
    }
}
