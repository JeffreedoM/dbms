<?php
session_start();
include 'dbh.inc.php';
include 'login-system.inc.php';

$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$projectFolder = rtrim(dirname((dirname($baseUrl))), '/') . '/';

$user_data = checkLogin($pdo);
