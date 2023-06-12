<?php

include '../admin/includes/dbh.inc.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the POST variables
    $keyword = $_POST['keyword'] ?? '';
    $barangayId = $_POST['barangay'] ?? '';
    $school_name = $_POST['school'] ?? '';

    $_SESSION['barangayId'] = $barangayId;
    $_SESSION['school_name'] = $school_name;

    // echo "Keyword: $keyword <br>";
    // echo "brgy ID: $barangayId <br>";
    // echo "School ID: $school_name <br>";
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
        $_SESSION['keyword'] = $keyword;
        // Check if there are no results
        if ($stmt->rowCount() == 0) {
            $_SESSION['no_result'] = "No results found.";
        }
        header('Location: ../');
        return;
    }

    if (!empty($barangayId) || !empty($school_name)) {
        // Start building the base SQL query
        $sql = "
            SELECT *
            FROM tbl_school_buildings sb
            JOIN tbl_schools s ON sb.school_id = s.school_id
            JOIN tbl_barangays b ON s.barangay_id = b.barangay_id";

        $conditions = [];

        if (!empty($barangayId)) {
            // Add condition for barangay ID
            $conditions[] = "b.barangay_id = :barangay_id";
        }

        if (!empty($school_name)) {
            // Add condition for school name
            $conditions[] = "s.school_name = :school_name";
        }

        if (!empty($conditions)) {
            // Append conditions to the SQL query
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        if (!empty($barangayId)) {
            // Bind barangay ID parameter
            $stmt->bindParam(':barangay_id', $barangayId);
        }

        if (!empty($school_name)) {
            // Bind school name parameter
            $stmt->bindParam(':school_name', $school_name);
        }

        // Execute the SQL statement
        $stmt->execute();
        // Fetch the results
        $categorySearchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Store the results in session
        $_SESSION['category_results'] = $categorySearchResults;
        // Assign the results to buildings variable
        $buildings = $categorySearchResults;

        // Redirect to the desired location
        header('Location: ../');
    }




    // header('Content-Type: application/json');
    // echo json_encode($keywordSearchResults);
    // header('Location: ../');
}
