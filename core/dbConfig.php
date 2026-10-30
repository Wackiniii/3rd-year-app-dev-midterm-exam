<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "pdo_03";
$dsn = "mysql:host={$host};dbname={$dbname}";
$pdo = new PDO($dsn, $user, $password);
$pdo->exec("SET time_zone = '+08:00';");

if ($pdo) {
    echo "Successfully connected to the database, " . $dbname;
}
else {
    echo "Connection failed";
}

?>