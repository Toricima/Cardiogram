<?php

/**
 * User short summary.
 *
 * User description.
 *
 * @version 1.5
 * @author Toricima
 */

require_once 'classes/DB.php';
require_once 'classes/Time.php';
require_once 'classes/Hash.php';
require_once 'classes/SessionManager.php';

class User extends DB
{
    public $_username,
            $_userId;
                 
    public function User($name)
    {
        $this->_username = $name;
        parent::__construct();
    }
    
    public function Register($password, $email)
    {     
        $time = new Time("Amsterdam");
        $hash = new Hash();
        
        $date = $time->Now();
        $password = $hash->Create($this->_username, $password);
        $unique = $hash->uniqueId($this->_username,$password);
        
        $this->Insert("user", array('username' , 'password','email', 'uniqueId', 'joindate'),
                              array($this->_username, $password, $email, $unique, $date));
        return true;
    }
    
    public function Login($password)
    {
        $hash = new Hash();
        $password = $hash->Create($this->_username,$password);
        
        if($this->Check($this->_username,$password))
        {
            $select = $this->Select(array('user'),array('username','=',$this->_username));
            $this->_userId = $this->results()[4];
            
            if(count($this->results()))
                return true;
            else
                return false;
            
        }
         else
            false;
    }
    
    public static function fetchFile()
    {
        $userfolder = SessionManager::read("userfolder");
        $filename = SessionManager::read("file");
                
        return "File/".$userfolder."/".$filename;
    }
    
    private function Check($name, $password)
    {
       $this->Select(array("user"),array("username","=",$name,"AND","password","=",$password));
       var_dump($this->Results());
            if($this->ResultCount() == 1)
                 return true;
            else
                return false;
    }
    
    public function fetchUserId()
    {
        return $this->_userId;
    }
}
