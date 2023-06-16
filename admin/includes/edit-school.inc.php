<?php

include 'dbh.inc.php';

if (isset($_POST['edit-school'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];

    $statement = $pdo->prepare("SELECT sitedev_plan FROM tbl_schools WHERE school_id = :school_id");
    $statement->execute(array(':school_id' => $school_id));
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $previousImage = $row['sitedev_plan'];

    // Check if sitedev_plan file is uploaded
    if (!empty($_FILES['sitedev_plan']['name'])) {
        // For building image
        $fileName = $_FILES['sitedev_plan']['name'];
        $fileTmpName = $_FILES['sitedev_plan']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileNameNew = uniqid('', true) . "." . strtolower($fileExt);
        $fileDestination = '../assets/images/uploads/' . $fileNameNew;

        // Upload the bldg Image
        move_uploaded_file($fileTmpName, $fileDestination);
        $sitedev_plan = $fileNameNew;
        echo 'may new image';

        // Delete the previous image if it exists
        if (!empty($previousImage)) {
            $previousImagePath = '../assets/images/uploads/' . $previousImage;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
    } else {
        $sitedev_plan = $previousImage; // Use the previous image if no new image is uploaded
        echo 'no new image';
    }

    // Prepare the SQL statement
    $statement = $pdo->prepare("UPDATE tbl_schools SET school_name = :school_name, sitedev_plan = :sitedev_plan  WHERE school_id = :school_id");
    // Bind the parameters
    $statement->bindParam(':school_name', $school_name);
    $statement->bindParam(':school_id', $school_id);
    $statement->bindParam(':sitedev_plan', $sitedev_plan);

    // Execute the statement
    $statement->execute();

    header('Location: ../add-school.php?update=success');
}
