<?php

/**
 * LapArray short summary.
 *
 * LapArray description.
 *
 * @version 1.0
 * @author Tom
 */
require_once 'classes/Lap.php';

class LapArray
{
    public $_lapObjArray = array();
    
    public function setupLaps()
    {
        $json = new JsonHandler();
        $json->setupJsonFile();
        $lapCount = $json->countElements("Lap");
        
    }
    
    public function addLap($lap)
    {
        $this->_lapObjArray = $lap;
    }
}
