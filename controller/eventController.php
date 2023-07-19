<?php
require_once ('../config.php');
require_once ('connectDatabase.php');

function getEventData($employee_name='',$event_name='',$event_date = '')
{

    // connect to database
    $db = connectDataBase();

    // sql code with each field check

    $sql = "SELECT * FROM events WHERE 1=1 ";
    if($employee_name != ''){
        $sql = $sql." AND employee_name Like "."'%".$employee_name."%'";
    }
    if($event_name != ''){
        $sql = $sql." AND event_name Like "."'%".$event_name."%'";
    }
    if($event_date != ''){
        $event_date = date("Y-m-d", strtotime($event_date));
        $sql = $sql." AND event_date = "."'".$event_date."'";
    }
    $result  = $db->query($sql);
    return $result;
}

function insertEventData($jsonData)
{
    // connect to database
    $db = connectDataBase();

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