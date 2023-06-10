<?php

include '../admin/includes/dbh.inc.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the POST variables
    $keyword = $_POST['keyword'] ?? '';
    $barangayId = $_POST['barangay'] ?? '';
    $school_name = $_POST['school'] ?? '';

    echo "Keyword: $keyword <br>";
    echo "brgy ID: $barangayId <br>";
    echo "School ID: $school_name <br>";

    // Start building the SQL query
    $sql = "SELECT * FROM tbl_school_buildings sb
     JOIN tbl_schools s ON sb.school_id = s.school_id
     JOIN tbl_barangays b ON s.barangay_id = b.barangay_id
     WHERE s.school_name = :school_name";

    // Execute the SQL query using PDO
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':school_name', $school_name);
    $stmt->execute();

    // Fetch the results
    $categorySearchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['category_results'] = $categorySearchResults;

    // Check if there are no results
    if ($stmt->rowCount() == 0) {
        echo "No results found.";
    } else {
        // Example: Print the results
        foreach ($buildings as $building) {
            echo $building['building_name'] . "<br>";
        }
    }

    if (!empty($keyword)) {
        // Start building the SQL query
        $sql = "SELECT * FROM tbl_school_buildings sb
            JOIN tbl_schools s ON sb.school_id = s.school_id
            JOIN tbl_barangays b ON s.barangay_id = b.barangay_id
            WHERE sb.building_name LIKE :keyword
            OR s.school_name LIKE :keyword
            OR b.barangay_name LIKE :keyword";

        // Bind the keyword parameter
        $keywordParam = '%' . $keyword . '%';

        // Execute the SQL query using PDO
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':keyword', $keywordParam, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the results
        $keywordSearchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['keyword_results'] = $keywordSearchResults;

        // Check if there are no results
        // if ($stmt->rowCount() == 0) {
        //     echo "No results found.";
        // } else {
        //     // Example: Print the results
        //     foreach ($keywordSearchResults as $row) {
        //         echo "Barangay: $row[barangay_name] <br>";
        //         echo "School: $row[school_name] <br>";
        //         echo "Building: $row[building_name] <br>";
        //     }
        // }

        header('Location: ../');
    }

    // header('Location: ../');
}
