<?php

/*Connecting to database*/

$servername= "localhost";
$dbUsername= "root";
$dbPassword= "";
$dbName= "attendance";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn){
    die(" Connection failed: ".mysqli_connect_error());
}