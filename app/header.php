<?php
require_once "csrf.php";
// header.php - canonical header which only applies house-theme when allowed
// 🔐 Secure session cookie settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Enable only if HTTPS (VM = HTTP, so keep OFF for now)
ini_set('session.cookie_secure', 0); // change to 1 in production
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default page title
$pageTitle  = isset($pageTitle) ? $pageTitle : 'Hogwarts Portal';

// Determine whether to apply house theme.
// If $pageNoHouseTheme is set (true) on the page BEFORE include "header.php",
// the theme will NOT be applied.
$bodyClass = '';

if ( ! (isset($pageNoHouseTheme) && $pageNoHouseTheme) ) {
    // Only apply house theme when user is logged in and house is set
    if (isset($_SESSION['user_id']) && !empty($_SESSION['house'])) {
        $bodyClass = 'house-' . strtolower($_SESSION['house']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/hogwarts/styles.css">
    <link rel="stylesheet" href="/hogwarts/house-theme.css">
</head>
<?php
$inlineStyle = "";

if (isset($pageBackground)) {
    $inlineStyle = "background: url('$pageBackground') center/cover fixed !important;";

}
?>
<body class="<?= htmlspecialchars($bodyClass) ?>" style="<?= $inlineStyle ?>">

<div class="container">
<?php if (isset($_SESSION['user_id'])): ?>
<nav class="magic-nav">
    <a href="dashboard.php">🏰 Home</a>
    <a href="profile.php">🪄 Profile</a>
    <a href="commonroom.php">🔥 Common Room</a>

    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="admin_dashboard.php">🧙 Admin</a>
    <?php endif; ?>

    <!-- 🔐 Logout (POST + CSRF) -->
    <form method="POST" action="logout.php" style="display:inline;">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>
</nav>
<?php endif; ?>

