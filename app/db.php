<?php
$host = "localhost";
$dbname = "hogwarts_portal";
$username = "hogwarts_user";
$password = "Magic@123";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", 
                   $username, 
                   $password,
                   [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

