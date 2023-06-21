<?php

include 'dbh.inc.php';

if (isset($_POST['add-brgy'])) {
    $barangay_name = $_POST['barangay_name'];

    // Prepare the SQL statement
    $statement = $pdo->prepare("INSERT INTO tbl_barangays (barangay_name) VALUES (:barangay_name)");
    // Bind the parameter
    $statement->bindParam(':barangay_name', $barangay_name);

    // Execute the statement
    $statement->execute();

    echo "<script>alert('Insertion successful!');</script>";
    header('Location: ../add-brgy.php?message=Successfully Added!');
}
