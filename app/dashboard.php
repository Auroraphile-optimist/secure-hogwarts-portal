<?php
session_start();
require "session_guard.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['name'];
$house = $_SESSION['house'];

// Disable house background for dashboard
$pageNoHouseTheme = true;
$pageBackground   = "/hogwarts/assets/backgrounds/hogwarts-hall.jpg";
include "header.php";
?>
<div class="magic-dashboard">

    <!-- House Badge -->
    <div class="house-badge">
        <img src="/hogwarts/assets/icons/houses/<?php echo strtolower($house); ?>.png"
             alt="House Badge"
             class="dashboard-house-badge">
    </div>

    <!-- Welcome Card -->
    <div class="welcome-card">
        <h1 class="neon-title">Welcome, <?php echo $name; ?>!</h1>
        <h2 class="house-text">House: <?php echo $house; ?></h2>
        <p class="subtitle">You have entered the Magical Dashboard.</p>

        <a href="commonroom.php" class="magic-btn">Enter Your Common Room</a>
    </div>

</div>

<!-- Magic Particles -->
<script src="/hogwarts/app/assets/js/magic-particles.js"></script>

<?php include "footer.php"; ?>

