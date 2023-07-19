<?php
require_once ('../config.php');

function getEventData($employee_name='',$event_name='',$event_date = '')
{
    // initialize database
    global $database;

    // connect to database with PDO

    try {
        $db = new PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['pass']);
    } catch (PDOException $e) {
        die("An error happend, Error: " . $e->getMessage());
    }

    // sql code with each field check

    $sql = "SELECT * FROM events WHERE 1=1 ";
    if($employee_name != ''){
        $sql = $sql." AND employee_name Like "."'%".$employee_name."%'";
    }
    if($event_name != ''){
        $sql = $sql." AND event_name Like "."'%".$event_name."%'";
    }
    if($event_date != ''){
        if(strpos($event_date, '/') !== false) {
            $event_date = explode('/', $event_date)[2] . '-' . explode('/', $event_date)[0] . '-' . explode('/', $event_date)[1];
        }
        $sql = $sql." AND event_date = "."'".$event_date."'";
    }
    $result  = $db->query($sql);
    return $result;
}

function insertEventData($jsonData)
{
    // initialize database
    global $database;

    // connect to database with PDO

    try {
        $db = new PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['pass']);
    } catch (PDOException $e) {
        die("An error happend, Error: " . $e->getMessage());
    }

    // sql query & submit data

    $sql = "INSERT INTO events (participation_id, employee_name, employee_mail, event_id,
                    event_name,participation_fee,event_date) 
                    VALUES (:participation_id, :employee_name, :employee_mail,
                    :event_id,:event_name,:participation_fee,:event_date)";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':participation_id' => $jsonData['participation_id'],
        ':employee_name' => $jsonData['employee_name'],
        ':employee_mail' => $jsonData['employee_mail'],
        ':event_id' => $jsonData['event_id'],
        ':event_name' => $jsonData['event_name'],
        ':participation_fee' => $jsonData['participation_fee'],
        ':event_date' => $jsonData['event_date'],
    ]);
}

?>