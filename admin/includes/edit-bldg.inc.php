<?php

include 'dbh.inc.php';

if (isset($_POST['edit-bldg'])) {

    $building_id = $_POST['building_id'];
    $school_id = $_POST['school_id'];
    $building_name = $_POST['building_name'];
    $year_established = $_POST['year_established'];

    $location = $_POST['location'] ?? '';
    $storey = $_POST['storey'] ?? '';
    $type_of_bldg = $_POST['type_of_bldg'] ?? '';
    $type_of_structure = $_POST['type_of_structure'] ?? '';
    $design_occupancy = $_POST['design_occupancy'] ?? '';
    $rvs_score = $_POST['rvs_score'] ?? '';
    $vulnerability = $_POST['vulnerability'] ?? '';
    $physical_conditions = $_POST['physical_conditions'] ?? '';
    $compliance = $_POST['compliance'] ?? '';
    $mitigation_actions = $_POST['mitigation_actions'] ?? '';

    $statement = $pdo->prepare("SELECT bldg_image FROM tbl_school_buildings WHERE building_id = :building_id");
    $statement->execute(array(':building_id' => $building_id));
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $previousImage = $row['bldg_image'];

    // Check if bldg_image file is uploaded
    if (!empty($_FILES['bldg_image']['name'])) {
        // For building image
        $fileName = $_FILES['bldg_image']['name'];
        $fileTmpName = $_FILES['bldg_image']['tmp_name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileNameNew = uniqid('', true) . "." . strtolower($fileExt);
        $fileDestination = '../assets/images/uploads/' . $fileNameNew;

        // Upload the bldg Image
        move_uploaded_file($fileTmpName, $fileDestination);
        $bldg_image = $fileNameNew;
        echo 'may new image';

        // Delete the previous image if it exists
        if (!empty($previousImage)) {
            $previousImagePath = '../assets/images/uploads/' . $previousImage;
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }
    } else {
        $bldg_image = $previousImage; // Use the previous image if no new image is uploaded
        echo 'no new image';
    }

    $statement = $pdo->prepare("UPDATE tbl_school_buildings SET
        school_id = :school_id,
        building_name = :building_name,
        year_established = :year_established,
        bldg_image = :bldg_image,
        location = :location,
        storey = :storey,
        type_of_bldg = :type_of_bldg,
        type_of_structure = :type_of_structure,
        design_occupancy = :design_occupancy,
        rvs_score = :rvs_score,
        vulnerability = :vulnerability,
        physical_conditions = :physical_conditions,
        compliance = :compliance,
        mitigation_actions = :mitigation_actions
    WHERE building_id = :building_id");

    $params = array(
        ':school_id' => $school_id ?? '',
        ':building_id' => $building_id ?? '',
        ':building_name' => $building_name ?? '',
        ':year_established' => $year_established ?? '',
        ':bldg_image' => $bldg_image ?? '',
        ':location' => $location ?? '',
        ':storey' => $storey ?? '',
        ':type_of_bldg' => $type_of_bldg ?? '',
        ':type_of_structure' => $type_of_structure ?? '',
        ':design_occupancy' => $design_occupancy ?? '',
        ':rvs_score' => $rvs_score ?? '',
        ':vulnerability' => $vulnerability ?? '',
        ':physical_conditions' => nl2br($physical_conditions) ?? '',
        ':compliance' => $compliance ?? '',
        ':mitigation_actions' => nl2br($mitigation_actions) ?? ''
    );

    // Execute the prepared statement
    $statement->execute($params);


    // For adding new  defect images
    if (!empty($_FILES['defect_img']['name'][0])) {
        $images = $_FILES['defect_img'];

        // Iterate over each uploaded image
        for ($i = 0; $i < count($images['name']); $i++) {
            $fileName = $images['name'][$i];
            $fileTmp = $images['tmp_name'][$i];

            // Generate a unique name for the file
            $uniqueName = uniqid() . '-' . bin2hex(random_bytes(8));
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $targetFileName = $uniqueName . '.' . $fileExtension;

            // Move the uploaded file to a designated folder
            $targetDir = "../assets/images/uploads/";
            $targetFile = $targetDir . $targetFileName;
            move_uploaded_file($fileTmp, $targetFile);

            // Insert image metadata into the database
            $stmt = $pdo->prepare("INSERT INTO tbl_building_defects (building_id, defect_images) VALUES (:building_id, :file_name)");

            $stmt->bindValue(':building_id', $building_id);
            $stmt->bindValue(':file_name', $targetFileName); // Use the generated unique file name
            $stmt->execute();
        }
        echo "Images uploaded successfully!";
    } else {
        echo "No images selected!";
    }

    header('Location: ../edit-bldg.php?id=' . $building_id . '&update=success');
}
