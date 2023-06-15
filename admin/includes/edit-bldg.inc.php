<?php

include 'dbh.inc.php';

if (isset($_POST['edit-bldg'])) {

    $building_id = $_POST['building_id'];
    $school_id = $_POST['school_id'];
    $building_name = $_POST['building_name'];
    $year_established = $_POST['year_established'];

    $location = $_POST['location'] ?? '';
    $storey = $_POST['storey'] ?? '';
    $year_nscp = $_POST['year_nscp'] ?? '';
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
        building_name = :building_name,
        year_established = :year_established,
        bldg_image = :bldg_image,
        location = :location,
        storey = :storey,
        year_nscp = :year_nscp,
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
        ':building_id' => $building_id ?? '',
        ':building_name' => $building_name ?? '',
        ':year_established' => $year_established ?? '',
        ':bldg_image' => $bldg_image ?? '',
        ':location' => $location ?? '',
        ':storey' => $storey ?? '',
        ':year_nscp' => $year_nscp ?? '',
        ':type_of_bldg' => $type_of_bldg ?? '',
        ':type_of_structure' => $type_of_structure ?? '',
        ':design_occupancy' => $design_occupancy ?? '',
        ':rvs_score' => $rvs_score ?? '',
        ':vulnerability' => $vulnerability ?? '',
        ':physical_conditions' => $physical_conditions ?? '',
        ':compliance' => $compliance ?? '',
        ':mitigation_actions' => $mitigation_actions ?? ''
    );

    // Execute the prepared statement
    $statement->execute($params);
    header('Location: ../edit-bldg.php?id=' . $building_id . '&update=success');
}
