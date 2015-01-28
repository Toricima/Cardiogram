<?php

/**
 * Hash short summary.
 *
 * Hash description.
 *
 * @version 1.0
 * @author Toricima
 */
class Hash
{
    public function Create($username,$password)
    {
        $salt = $this->Mksalt($username,$password);
        $hash = hash('sha512',$password.$salt);
        return $hash;
    }
    
    public function uniqueId($name, $password)
    {
        $hash = hash('sha512',$password.$name);
        $id = substr($hash,0, 7);
        return $id;
    }
    
    private function Mksalt($username, $password)
    {
        $l_username = strlen($username);
        $l_password = strlen($password);
        $salt = hash("sha512",$password.$username);
        
        $salt = substr($salt,$l_username,$l_password);
        $salt.= $l_username.$l_password;
        
        return $salt;          
    }
    
    private function toNumber($char)
    {
        return ord($char);
    }
}