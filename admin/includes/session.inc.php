<?php

include 'dbh.inc.php';

$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$projectFolder = rtrim(dirname(dirname(dirname(dirname($baseUrl)))), '/') . '/';
