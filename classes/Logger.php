<?php

/**
 * Logger short summary.
 *
 * Logger description.
 *
 * @version 1.2
 * @author Tom
 */
 
 require_once 'classes/JsonReader.php';
 require_once 'classes/Time.php';
 
class Logger
{
    private static $_errorArray = array();
    
    public static function logError($description,$error)
    {
        $time = new Time('Amsterdam');
        $now = $time->Now();
        
        
        $error = array('Error has accured',$now,$description,$error);
        
        
        self::$_errorArray[] = $error;
        self::saveLog();
    }
    
    private static function saveLog()
    {
        $json = new JsonReader();
        
        if(self::doesFileExist('log.json'))
            $json->addContentToFile('log',array(self::$_errorArray));
        else
            $json->newJson("log/",'log',self::$_errorArray);
    }
    
    private static function doesFileExist($name)
    {
        $dir = $_SERVER['DOCUMENT_ROOT']."/log/";
        $files = scandir($dir);
        
        foreach($files as $file)
        {
            if($file == $name)
            {
                return true;
                die();
            }       
        }
        return false;
    }
}
