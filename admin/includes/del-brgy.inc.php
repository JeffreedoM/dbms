<?php

include 'dbh.inc.php';

// get the barangay id from the url ?id=[barangay_id]
$id = $_GET['id'];

// Prepare the delete statement
$statement = $pdo->prepare("DELETE FROM tbl_barangays WHERE barangay_id = :id");

// Bind the parameter
$statement->bindParam(':id', $id);
$statement->execute();

// Go back to the add-brgy page
header('Location: ../add-brgy.php?delete=success');
