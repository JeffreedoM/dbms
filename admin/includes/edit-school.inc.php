<?php

include 'dbh.inc.php';

if (isset($_POST['edit-school'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];

    // Prepare the SQL statement
    $statement = $pdo->prepare("UPDATE tbl_schools SET school_name = :school_name WHERE school_id = :school_id");
    // Bind the parameters
    $statement->bindParam(':school_name', $school_name);
    $statement->bindParam(':school_id', $school_id);

    // Execute the statement
    $statement->execute();

    header('Location: ../add-school.php?update=success');
}
