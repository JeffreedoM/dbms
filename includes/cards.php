<?php
include '../admin/includes/functions.inc.php';

$buildingsPerPage = 12; // Number of buildings to fetch per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

// Calculate the offset for pagination
$offset = ($page - 1) * $buildingsPerPage;

// Get buildings for the current page
$buildings = $silang->getBuildingsLazy($buildingsPerPage, $offset);

// Render the buildings as JSON response
$response = [
    'buildings' => $buildings
];
header('Content-Type: application/json');
echo json_encode($response);
