<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "dbms";

//data source name
$dsn = "mysql:host=$host;dbname=$dbName";

//create a PDO instance
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
