<?php
include 'dbh.inc.php';

class Silang
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Get all barangays from the database
    public function getBarangays()
    {
        $query = "SELECT * FROM tbl_barangays";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $barangays = $stmt->fetchAll();

        return $barangays;
    }

    // Get all schools from the database
    public function getSchools()
    {

        $query = "SELECT * FROM tbl_schools";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        // Fetch all rows as an associative array
        $schools = $stmt->fetchAll();

        return $schools;
    }

    // Get all buildings from the database
    public function getBuildings()
    {

        $query = "SELECT * FROM tbl_school_buildings";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        // Fetch all rows as an associative array
        $buildings = $stmt->fetchAll();

        return $buildings;
    }

    // Get all buildings from the database
    public function getBuildingsLazy($limit, $offset)
    {
        $query = "SELECT * FROM tbl_school_buildings LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all rows as an associative array
        $buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $buildings;
    }

    // Get logged in user
    public function getCurrentUser()
    {
        $query = "SELECT username FROM tbl_accounts";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        // Fetch all rows as an associative array
        $account = $stmt->fetch();

        return $account['username'];
    }
}


$silang = new Silang($pdo);
