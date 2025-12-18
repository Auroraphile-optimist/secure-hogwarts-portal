<?php
require "admin_guard.php";

$pageTitle = "Headmaster's Office";
$pageNoHouseTheme = true;
$pageBackground = "/hogwarts/assets/backgrounds/hogwarts-hall.jpg";

include "header.php";
?>

<h1 class="magical-title">🏰 Headmaster’s Office</h1>

<div class="admin-panel">
    <a href="admin_users.php" class="magic-btn">👥 Manage Students</a>
</div>

<?php include "footer.php"; ?>

