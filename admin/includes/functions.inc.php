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

    // Get one barangay from the database
    public function getOneBarangay($barangayId)
    {

        $query = "SELECT *
        FROM tbl_barangays b
        JOIN tbl_schools s ON b.barangay_id = s.barangay_id
        JOIN tbl_school_buildings sb ON s.school_id = sb.school_id
        WHERE b.barangay_id = :barangayId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':barangayId', $barangayId);
        $stmt->execute();
        // Fetch all rows as an associative array
        $barangay = $stmt->fetch();

        return $barangay;
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

    // Get one barangay from the database
    public function getOneSchool($school_name)
    {

        $query = "SELECT *
        FROM tbl_barangays b
        JOIN tbl_schools s ON b.barangay_id = s.barangay_id
        JOIN tbl_school_buildings sb ON s.school_id = sb.school_id
        WHERE s.school_name = :school_name";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':school_name', $school_name);
        $stmt->execute();
        // Fetch all rows as an associative array
        $school = $stmt->fetch();

        return $school;
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

    // Get building from the database based on its id
    public function getOneBuilding($id)
    {

        $query = "SELECT * FROM tbl_school_buildings sb
        JOIN tbl_schools s ON sb.school_id = s.school_id
        JOIN tbl_barangays b ON s.barangay_id = b.barangay_id
        WHERE building_id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // Fetch all rows as an associative array
        $buildings = $stmt->fetch();

        return $buildings;
    }

    public function getDefectImages($id)
    {
        $query = "SELECT * FROM tbl_building_defects WHERE building_id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
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

    public function getSchoolOptions($selectedBarangayId)
    {
        $query = "SELECT school_name FROM tbl_schools WHERE barangay_id = :barangay_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':barangay_id', $selectedBarangayId);
        $stmt->execute();
        $schools = $stmt->fetchAll();
        // Store the school options in an array
        $schoolOptions = array();

        foreach ($schools as $school) {
            $schoolOptions[] = $school['school_name'];
        }
        return $schoolOptions;
    }
}


$silang = new Silang($pdo);
