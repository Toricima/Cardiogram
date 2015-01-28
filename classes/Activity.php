<?php

/**
 * Activity short summary.
 *
 * Activity description.
 *
 * @version 1.1
 * @author Tom
 */
 require_once 'classes/User.php';
 require_once 'classes/JsonReader.php';
 require_once 'classes/Lap.php';
 
class Activity extends Lap
{
    private $_activity;
    
    public function Activity($activity)
    {
        $this->_activity = $activity;
    }
    
    public function fetchLaps()
    {
        $count = $this->countLaps();
        $laps = array();
        
        for($i = 0; $i < $count; $i++)
        {
            $lap = new Lap($i);
            array_push($laps, $lap);
        }
        
        return $laps;
    }
    
    public function  countLaps()
    {
        $laps = $this->fetch("lap");
        return count($laps);
    }
}
