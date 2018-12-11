<?php

$log = fopen(__DIR__ . DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR . "del_idle_request.txt","a");
$message = 'Cronjob starts at ' . date('Y-m-d h:i:s') . PHP_EOL;

/* SELECT * from "request" WHERE "updated_at" < (SYSDATE - INTERVAL '30' MINUTE);*/

error_reporting(E_ALL);
ini_set('display_errors','On');

$mysqli = new mysqli('localhost','carpoolnowdb','Duip34jitjit-','carpoolnow');
if(mysqli_connect_errno())
{
    printf("Connect failed: %s\n",mysqli_connect_error());
    exit();
}

$requests_query = $mysqli->query("SELECT * FROM request WHERE updated_at < DATE_SUB(NOW(), INTERVAL 30 MINUTE) ");
if(!$requests_query)
{
    fwrite($log,$message. "No idle request found");
    return $message;
}
$requests = $requests_query->fetch_all();

$message .= "Idle requests: " . json_encode($requests). PHP_EOL;

$mysqli->query("DELETE FROM request WHERE updated_at < DATE_SUB(NOW(), INTERVAL 30 MINUTE) ");
$message .= "Deleted " . $mysqli->affected_rows . ' rows'. PHP_EOL;


$message .= "____________________________________________" .PHP_EOL;
fwrite($log,$message);
return $message;