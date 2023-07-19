<?php

require_once ('../config.php');
require_once ('eventController.php');

// get data from json file
function getJsonFile($path='')
{
    if($path=='') {
        $path = 'data/Code Challenge (Events).json';
    }
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);
    return $jsonData;
}

// add multi row Json
function insertMultiData($path=''){
    $jsonData = getJsonFile($path);
    foreach ($jsonData as $jsonValue) {
        insertEventData($jsonValue);
    }
    return true;
}

?>