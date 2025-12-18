<?php
session_start();

/**
 * 🚫 If user is already logged in,
 * redirect them away from login page
 */
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Login page should NOT use house theme
$pageNoHouseTheme = true;
$pageTitle = "Login - Hogwarts";

include "header.php";
?>

<h1 class="magical-title">Enter the Wizarding Realm</h1>

<div class="scroll-box">
    <?php include 'login_form_block.php'; ?>
</div>

<?php include "footer.php"; ?>

