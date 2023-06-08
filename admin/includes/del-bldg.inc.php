<?php

include 'dbh.inc.php';

// get the barangay id from the url ?id=[building_id]
$id = $_GET['id'];

// Prepare the delete statement
$statement = $pdo->prepare("DELETE FROM tbl_school_buildings WHERE building_id = :id");

// Bind the parameter
$statement->bindParam(':id', $id);
$statement->execute();

// Go back to the add-brgy page
header('Location: ../bldg-list.php?delete=success');
