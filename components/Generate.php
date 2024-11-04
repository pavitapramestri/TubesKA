<?php

class Generate
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    // constructor
    public function __construct(
        $dbname = "cart_php",
        $tablename = "product",
        $servername = "localhost",
        $username = "root",
        $password = ""
    ) {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // check connection
        if (!$this->con) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        // Query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // Execute query
        if (mysqli_query($this->con, $sql)) {
            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // Create table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(25) NOT NULL,
            product_price FLOAT,
            product_image VARCHAR(100)
            );";

            if (!mysqli_query($this->con, $sql)) {
                echo "Error create table:" . mysqli_error($this->con);
            }
        } else {
            return false;
        }
    }

    // Get product from database
    public function getData(){
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}
