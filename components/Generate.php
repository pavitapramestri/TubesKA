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
        // Gunakan variabel lingkungan jika tersedia
        $this->dbname = getenv('MYSQL_DB') ?: $dbname;
        $this->tablename = $tablename;
        $this->servername = getenv('MYSQL_HOST') ?: $servername;
        $this->username = getenv('MYSQL_USER') ?: $username;
        $this->password = getenv('MYSQL_PASSWORD') ?: $password;

        // create connection
        $this->con = mysqli_connect($this->servername, $this->username, $this->password);

        // check connection
        if (!$this->con) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        // Query untuk membuat database jika belum ada
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";

        // Execute query
        if (mysqli_query($this->con, $sql)) {
            $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

            // Query untuk membuat tabel jika belum ada
            $sql = "CREATE TABLE IF NOT EXISTS $this->tablename (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                product_name VARCHAR(25) NOT NULL,
                product_price FLOAT,
                product_image VARCHAR(100)
            );";

            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating table: " . mysqli_error($this->con);
            }
        } else {
            die("Error creating database: " . mysqli_error($this->con));
        }
    }

    // Get product from database
    public function getData()
    {
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return [];
        }
    }
}
