<?php
include '../admin/includes/functions.inc.php';

// Retrieve the selected barangay from the request
$selectedBarangay = $_GET["barangay"];

// Fetch the school options based on the selected barangay
$schoolOptions = $silang->getSchoolOptions($selectedBarangay);

// Return the school options as a JSON response
header("Content-Type: application/json");
echo json_encode($schoolOptions);
