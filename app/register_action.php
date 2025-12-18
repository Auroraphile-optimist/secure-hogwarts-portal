<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit;
}

require "db.php";
require "csrf.php";

// ✅ Verify CSRF ONLY for POST
csrf_verify();

$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$password = $_POST['password'];
$house    = $_POST['house'];

if (empty($name) || empty($email) || empty($password) || empty($house)) {
    die("Please fill all fields.");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $pdo->prepare("
    INSERT INTO users (name, email, password, house)
    VALUES (:name, :email, :password, :house)
");

$ok = $stmt->execute([
    ':name'     => $name,
    ':email'    => $email,
    ':password' => $hashedPassword,
    ':house'    => $house
]);

if ($ok) {
    echo "<script>alert('Registration Successful! Please Login.'); 
    window.location.href='login.php';</script>";
    exit;
} else {
    echo "<script>alert('Registration FAILED.'); 
    window.location.href='register.php';</script>";
    exit;
}
?>

