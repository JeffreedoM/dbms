<?php

include 'dbh.inc.php';

if (isset($_POST['add-bldg'])) {
    $school_id = $_POST['school_id'];
    $building_name = $_POST['building_name'];
    $year_established = $_POST['year_established'];

    if (!empty(($_FILES['bldg_image']['name']))) {
        // For building image
        $fileName = $_FILES['bldg_image']['name'];
        $fileTmpName = $_FILES['bldg_image']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileNameNew = uniqid('', true) . "." . strtolower($fileExt);
        $fileDestination = '../assets/images/uploads/' . $fileNameNew;

        // Upload the bldg Image
        move_uploaded_file($fileTmpName, $fileDestination);
    } else {
        $fileNameNew = ''; // Set fileNameNew to null when bldg_image is not set
    }
    // Prepare the SQL statement
    $statement = $pdo->prepare("INSERT INTO tbl_school_buildings (
        school_id,
        building_name, 
        year_established,
        bldg_image
        ) VALUES (
        :school_id,
        :building_name, 
        :year_established,
        :bldg_image

        )");
    $params = array(
        ':school_id' => $school_id,
        ':building_name' => $building_name,
        ':year_established' => $year_established,
        ':bldg_image' => $fileNameNew
    );

    // Execute the statement
    $statement->execute($params);

    echo "<script>alert('Insertion successful!');</script>";
    header('Location: ../add-school-bldg.php');
}
