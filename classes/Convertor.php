<?php

/**
 * Convertor short summary.
 *
 * Convertor description.
 *
 * @version 1.0
 * @author Tom
 */
class Convertor
{
    public static function XmlToJson($xml)
    {
        $json = json_encode($xml);
        $json = json_decode($json, true);
        
        return $json;
    }
}
