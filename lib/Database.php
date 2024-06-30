<?php

$filePath = realpath(dirname(__FILE__));
include_once $filePath . '/../config/config.php';

class Database
{
    public $host     = HOST;
    public $user     = USER;
    public $password = PASSWORD;
    public $databse  = DATABSE;

    public $link;
    public $error;

    public function __construct()
    {
        $this->dbCon();
    }

    public function dbCon()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->databse);

        if (!$this->link) {

            $this->error = die('DataBase Connection Failed!');
            return false;
        }
    }
    // DataBAse Connection End

    public function select($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);

        if (mysqli_num_rows($result) > 0) {

            return $result;
        } else {

            return false;
        }
    }
    // Select Query End

    public function selectWithOutNumRows($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }
    // Select Query End

    public function insert($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }
    // Insert Query End

    public function update($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }
    // Update Query End

    public function delete($query)
    {
        $result = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }
    // Delete Query End
}
