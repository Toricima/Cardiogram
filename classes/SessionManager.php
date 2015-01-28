<?php

/**
 * SessionManager short summary.
 *
 * SessionManager description.
 *
 * @version 1.1
 * @author Tom
 */
 
 require_once 'classes/Logger.php';
 
class SessionManager
{
    public static function start()
    {
        if(!session_start)
            session_start();
        else
            Logger::logError("Session has already started","Unable to start the session");
    }  
    
    public static function stop()
    {
        if(session_start)
            session_destroy();
        else
            Logger::logError("session was already destroyed","unable to destory session");
    }
    
    public static function read($name)
    {
        if(isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            Logger::logError($name."does not exist","The requested session does not exist");
    }
    
    public static function readAll()
    {
        if(isset($_SESSION))
            return $_SESSION;
        else
            Logger::logError("There aren't any active sessions","Unable to find session");
    }
}
