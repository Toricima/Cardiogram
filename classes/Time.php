<?php

/**
 * Time short summary.
 *
 * Time description.
 *
 * @version 1.0
 * @author Toricima
 */
class Time
{
    private $_timezone;
    
    public function Time($location)
    {
       $this->_timezone = date_default_timezone_set("Europe/".$location); 
    }
    
    public function Now()
    {
        $date = date('d-m-y H:i:s');
        return $date;
    }
    
    public function calcMinutes($seconds)
    {
        return $seconds / 60;
    }
    
    public function calcHours($seconds)
    {
        return ($seconds / 60) /60;
    }
}
