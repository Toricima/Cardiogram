<?php

/**
 * DirectoryHandler short summary.
 *
 * DirectoryHandler description.
 *
 * @version 1.0
 * @author Tom
 */
class Folder
{
    public static function create($dir)
    {
        var_dump($dir);
        if(!mkdir($dir))
            die(Logger::logError("File coudld not created","Specific error unknown"));
        
    }
    
    public static function isEmpty()
    {
        if(is_dir_empty)
            return true;
        else
            return false;
    }
    
    public static function exists()
    {
        return false;
    }
    
    public static function delete($dir)
    {
        rmdir($dir);
    }
    
    public function setProtection($password)
    {
    }
}
