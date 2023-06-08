<?php

include 'dbh.inc.php';

if (isset($_POST['edit-brgy'])) {
    $barangay_id = $_POST['barangay_id'];
    $barangay_name = $_POST['barangay_name'];

    // Prepare the SQL statement
    $statement = $pdo->prepare("UPDATE tbl_barangays SET barangay_name = :barangay_name WHERE barangay_id = :barangay_id");
    // Bind the parameters
    $statement->bindParam(':barangay_name', $barangay_name);
    $statement->bindParam(':barangay_id', $barangay_id);

    // Execute the statement
    $statement->execute();

    header('Location: ../add-brgy.php?update=success');
}
