<?php

/**
 * XmlHandler short summary.
 *
 * XmlHandler description.
 *
 * @version 1.0
 * @author Tom
 */
class XmlParser
{   
    private $_loadedXml;
    
    public function read($xml)
    {
        $this->_loadedXml = simplexml_load_file($xml);
    }
     
    public function fetchLoadedXml()
    {
        return $this->_loadedXml;
    }
}