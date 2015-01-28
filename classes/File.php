<?php

/**
 * FileHandler short summary.
 *
 * FileHandler description.
 *
 * @version 1.0
 * @author Tom
 */
 
 require_once 'classes/Logger.php';
 
class File
{
    public static function upload($file = array())
    {
    
       $tmp  = $_FILES['file']['tmp_name'];
       $file_name = $_FILES['file']['name'];
       $piece = explode(".", $file_name);

       
       $allowed_files = array('xml','tcx');
       
       if(in_array($piece[1],$allowed_files))
       {  
            $path = "./File/".$file_name;
            if(!file_exists($path))
            { 
                if(move_uploaded_file($tmp,$path))
                    return true;
            }
        }
        else
        {
            Logger::logError("{$file_name} was nog allowed","A probited file has been uploaded");
            return false;
        }
    }
    
    public static function fetchAllFromUser($dir)
    {
        $files = scandir($dir);
        return $files;
    }
    
    public static function read($location)
    {
        if(File::doesExist)
        {
            $handle = fopen($location,'r');
            return $handle;
        }
        else 
            return false;
        
    }
    
    public static function delete($filename)
    {
    }
    
    private static function doesExist($location)
    {
        if(file_exist($location))
            return true;
        else 
            return false;
    }
}
