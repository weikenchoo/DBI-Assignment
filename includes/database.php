<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = NULL;
$dbName = "sakila";

function connect() {
    GLOBAL $servername;
    GLOBAL $dbUsername;
    GLOBAL $dbPassword;
    GLOBAL $dbName;
    
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if(!$conn) {
        die("Failed to connect to MYSQL" . mysqli_connect_error() . "\nDebugging errno" . mysqli_connect_errno());
    }

    return $conn;
}

// $connection = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

