<?php

include 'dbh.inc.php';

if (isset($_POST['add-school'])) {
    $school_name = $_POST['school_name'];
    $barangay_id = $_POST['barangay_id'];

    if (!empty(($_FILES['sitedev_plan']['name']))) {
        // For building image
        $fileName = $_FILES['sitedev_plan']['name'];
        $fileTmpName = $_FILES['sitedev_plan']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileNameNew = uniqid('', true) . "." . strtolower($fileExt);
        $fileDestination = '../assets/images/uploads/' . $fileNameNew;

        // Upload the bldg Image
        move_uploaded_file($fileTmpName, $fileDestination);
    } else {
        $fileNameNew = ''; // Set fileNameNew to null when sitedev_plan is not set
    }

    // Prepare the SQL statement
    $statement = $pdo->prepare("INSERT INTO tbl_schools (school_name, barangay_id, sitedev_plan) VALUES (:school_name, :barangay_id, :sitedev_plan)");
    // Bind the parameter
    $statement->bindParam(':school_name', $school_name);
    $statement->bindParam(':barangay_id', $barangay_id);
    $statement->bindParam(':sitedev_plan', $fileNameNew);

    // Execute the statement
    $statement->execute();

    echo "<script>alert('Insertion successful!');</script>";
    header('Location: ../add-school.php');
}
