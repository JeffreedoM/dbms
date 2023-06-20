<?php

include 'dbh.inc.php';

// get the barangay id from the url ?id=[building_id]
$id = $_GET['id'];

$query = "SELECT *
        FROM tbl_school_buildings sb 
        JOIN tbl_building_defects bd ON sb.building_id = bd.building_id
        WHERE sb.building_id = :building_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':building_id', $id);
$stmt->execute();
// Fetch all rows as an associative array
$row = $stmt->fetch();

// For selecting defect_images
$query = "SELECT bd.defect_images
        FROM tbl_building_defects bd
        JOIN tbl_school_buildings sb ON bd.building_id = sb.building_id
        WHERE sb.building_id = :building_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':building_id', $id);
$stmt->execute();
// Fetch all rows as an associative array
$defect_images = $stmt->fetchAll();

for ($i = 0; $i < count($defect_images); $i++) {
    // delete the defect_images in the uploads folder
    unlink('../assets/images/uploads/' . $defect_images[$i]['defect_images']);
}

// delete building image
unlink('../assets/images/uploads/' . $row['bldg_image']);

// Prepare the delete statement
$statement = $pdo->prepare("DELETE FROM tbl_school_buildings WHERE building_id = :id");

// Bind the parameter
$statement->bindParam(':id', $id);
$statement->execute();

// Go back to the add-brgy page
header('Location: ../bldg-list.php?delete=success');
