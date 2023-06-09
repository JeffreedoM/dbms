<?php
include 'admin/includes/dbh.inc.php';

class Bldg
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    
}
