<?php

/**
 * jsonFormat short summary.
 *
 * jsonFormat description.
 *
 * @version 1.3
 * @author Tom
 */
class JsonFormat
{
    protected function lapFormat($json)
    {     
            $lap = array
            (
                'total_time'        => $json['Lap']['TotalTimeSeconds'],
                'distance'          => $json['Lap']['DistanceMeters'],
                'maxSpeed'          => $json['Lap']['MaximumSpeed'],
                'calories'          => $json['Lap']['Calories'],
                'avgHeartRateBpm'   => $json['Lap']['AverageHeartRateBpm']['Value'],
                'maxHeartRateBpm'   => $json['Lap']['MaximumHeartRateBpm']['Value'],
                'intensity'         => $json['Lap']['Intensity'],
                'cadence'           => $json['Lap']['Cadence'],
                'triggerMethod'     => $json['Lap']['TriggerMethod'],
                'trackpoints'       => $this->trackpointFormat($json['Lap'])
            );
            
            $laps = array('lap' => $lap);
            
            return $laps;
    }
    
    protected function trackpointFormat($json)
    {
        $trackpoints = array();
        $offsetTrackpoint = $json['Track']['Trackpoint'];
        $countTrackpoint = count($offsetTrackpoint) - 1;
        $trackpoint = array();
        $trackpointArray = array();
        
        for($i = 0; $i < $countTrackpoint;$i++)
        {   
            $trackpoint = array
            (
                "time"        => $offsetTrackpoint[$i]['Time'],
                "distance"    => $offsetTrackpoint[$i]['DistanceMeters'],
                "heartRate"   => $offsetTrackpoint[$i]['HeartRateBpm']['Value'],
                "speed"       => $offsetTrackpoint[$i]['Extensions']['TPX']['Speed']
            );
           
            array_push($trackpoints, $arr["trackpoint{$i}"] = $trackpoint);
        }
        
        return $trackpoints;
    }
}
