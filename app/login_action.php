<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

require "db.php";
require "csrf.php";

csrf_verify();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch user by email using PDO
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
    // Verify hashed password
      if (password_verify($password, $user['password'])) {

            // 🔐 Prevent session fixation (FIRST after auth)
            session_regenerate_id(true);

        // 🚫 BLOCK BANNED USERS FIRST
           if ($user['status'] === 'banned') {
               echo "<script>
                   alert('You are banned by the Ministry of Magic!');
                   window.location.href='login.php';
               </script>";
               exit;
           }
      
           // ✅ Store user session
           $_SESSION['user_id']    = $user['id'];
           $_SESSION['user_name']  = $user['name'];
           $_SESSION['user_email'] = $user['email'];
           $_SESSION['house']      = $user['house'];
           $_SESSION['role']       = $user['role'];
           $_SESSION['status']     = $user['status'];

           // 🕒 Track activity time
           $_SESSION['last_activity'] = time();
           // Redirect to dashboard
           header("Location: dashboard.php");
           exit;


        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with this email!'); window.location.href='login.php';</script>";
    }
}
?>

