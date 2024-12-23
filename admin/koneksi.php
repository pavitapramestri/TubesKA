<?php
$host = "mysql";
$username = "root";
$password = "root_password";
$database = "cart_db";
$koneksi = new mysqli($host, $username, $password, $database);

// $servername = getenv('MYSQL_HOST') ?: 'localhost'; // Mengambil host dari environment variable atau default ke localhost
// $username = getenv('MYSQL_USER') ?: 'root'; // Mengambil username dari environment variable atau default ke root
// $password = getenv('MYSQL_PASSWORD') ?: 'root_password'; // Mengambil password dari environment variable atau default kosong
// $dbname = getenv('MYSQL_DB') ?: 'cart_db'; // Mengambil nama database dari environment variable atau default ke test

// // Membuat koneksi
// $conn = new mysqli($servername, $username, $password, $dbname);
