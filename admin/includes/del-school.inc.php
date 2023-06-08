<?php

include 'dbh.inc.php';

// get the barangay id from the url ?id=[school_id]
$id = $_GET['id'];

// Prepare the delete statement
$statement = $pdo->prepare("DELETE FROM tbl_schools WHERE school_id = :id");

// Bind the parameter
$statement->bindParam(':id', $id);
$statement->execute();

// Go back to the add-school page
header('Location: ../add-school.php?delete=success');
