<?php
// include 'dbh.inc.php';
// function checkLogin()

function checkLogin($pdo)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];

        $result = $pdo->query("SELECT * FROM tbl_accounts WHERE user_id = '$id' LIMIT 1");
        $result->execute();
        $numRows = $result->rowCount();
        if ($result && $numRows > 0) {
            $user_data = $result->fetch();
            return $user_data;
        }
    }


    //redirect to login if not logged in
    header('Location: ../admin');
    die;
}
