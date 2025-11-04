<?php
define("DB_HOST", "172.31.22.43");
define("DB_USER", "Daniel200645157");
define("DB_PASS", "tdMKjeW8df");
define("DB_NAME", "Daniel200645157");
try{
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // set PDO error mode to exception for easier debuggin
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    // if our connection fails stop the script and display the error
    die("Connection failed: " . $e->getMessage());
}
?>