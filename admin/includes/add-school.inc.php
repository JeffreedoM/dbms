<?php

include 'dbh.inc.php';

if (isset($_POST['add-school'])) {
    $school_name = $_POST['school_name'];
    $barangay_id = $_POST['barangay_id'];

    // Prepare the SQL statement
    $statement = $pdo->prepare("INSERT INTO tbl_schools (school_name, barangay_id) VALUES (:school_name, :barangay_id)");
    // Bind the parameter
    $statement->bindParam(':school_name', $school_name);
    $statement->bindParam(':barangay_id', $barangay_id);

    // Execute the statement
    $statement->execute();

    echo "<script>alert('Insertion successful!');</script>";
    header('Location: ../add-school.php');
}
