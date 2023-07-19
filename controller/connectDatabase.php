<?php
require_once ('../config.php');

function connectDataBase()
{
    // initialize database
    global $database;

    // connect to database with PDO
    try {
        $db = new PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['pass']);
        return $db;
    } catch (PDOException $e) {
        die("An error happend, Error: " . $e->getMessage());
    }
}

?>