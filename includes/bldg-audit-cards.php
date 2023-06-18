<?php
include '../admin/includes/functions.inc.php';



// Get buildings for the current page
$buildings = $silang->getBuildingsLazy($buildingsPerPage, $offset);

// Render the buildings as JSON response
$response = [
    'buildings' => $buildings
];
header('Content-Type: application/json');
echo json_encode($response);
