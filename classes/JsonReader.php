<?php

/**
 * JsonHandler short summary.
 *
 * JsonHandler description.
 *
 * @version 1.5
 * @author Tom
 */
 
 require_once 'classes/JsonFormat.php';
 require_once 'classes/Logger.php';
 require_once 'classes/File.php';
 
class JsonReader extends JsonFormat
{
    private $_lap;
    private $_selectedFile;
    
    
    public function read($directory)
    {
       $this->_selectedFile = $directory;
    }
     
    public function offset($offset,$values)
    {
       $this->_lap = $this->_selectedFile['Activities']['Activity'];
    }
    
    public function create($dir, $name, $file)
    {
        try
        {
            $readJson = fopen($dir.$name.".json",'w');
        }
        catch(Exception $e)
        {
            Logger::logError("File already exist",$e);
        }
        
        fwrite($readJson, json_encode($file));
        fclose($readJson);   
    }
    
    public function addContentToFile($name,$content = array())
    {
        $readJson = fopen($name.".json",'a');
        fwrite($readJson, json_encode($content));
        fclose($readJson);
    }
    
    public function format()
    {
        $lapFormat = $this->lapFormat($this->_lap);
        return $lapFormat;
    }
    
    public function fetchElement($name)
    {
        $data = file_get_contents ($this->_selectedFile);
        $json = json_decode($data, true);
        
        if($this->isEmpty($name))
            return $json;
        else if($name == 'lap')
            return $json;
        else
            return $json['lap'][$name];
            
    }
    
    public function countElements($target)
    {
        return $counter;
    }
    
    public function fetchElementByAttribute()
    {
    }
    
    private function isEmpty($target)
    {
        if(count($target) ==  0 || $target == "")
            return true;
        else 
            return false;
    }
   
}
