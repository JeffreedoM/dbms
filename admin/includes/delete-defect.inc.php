<?php

include 'dbh.inc.php';
include 'functions.inc.php';



$id = $_GET['id'];
$building_id = $_GET['building_id'];

$query = "SELECT * FROM tbl_building_defects WHERE id=:id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$building = $stmt->fetch();

// delete the image in the uploads folder
unlink('../assets/images/uploads/' . $building['defect_images']);

// Prepare the DELETE statement
$stmt = $pdo->prepare("DELETE FROM tbl_building_defects WHERE id = :id");

// Bind the parameter
$stmt->bindParam(':id', $id);

// Execute the statement
$stmt->execute();


header('Location: ../edit-bldg.php?id=' . $building_id);
