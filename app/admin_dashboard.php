<?php
session_start();
require "db.php";
require "admin_guard.php";
// 🔐 Admin protection
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$pageNoHouseTheme = true;
$pageBackground   = "/hogwarts/assets/backgrounds/hogwarts-library.jpg";
$pageTitle        = "Headmaster’s Office";

include "header.php";

// 📊 Fetch stats
$totalUsers   = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$activeUsers  = $pdo->query("SELECT COUNT(*) FROM users WHERE status='active'")->fetchColumn();
$bannedUsers  = $pdo->query("SELECT COUNT(*) FROM users WHERE status='banned'")->fetchColumn();

$houseStats = $pdo->query("
    SELECT house, COUNT(*) as total
    FROM users
    GROUP BY house
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="admin-dashboard">

    <h1 class="magical-title">🧙 Headmaster’s Office</h1>
    

    <div class="admin-seal">
       <img src="/hogwarts/assets/images/hogwarts-seal.png"
            alt="Official Hogwarts Seal">
    </div>
    <div class="stats-grid">
        <div class="stat-card">👥 Total Students<br><strong><?= $totalUsers ?></strong></div>
        <div class="stat-card">🟢 Active<br><strong><?= $activeUsers ?></strong></div>
        <div class="stat-card">🚫 Banned<br><strong><?= $bannedUsers ?></strong></div>
    </div>

    <h2 class="magic-title">🏰 House Distribution</h2>

    <div class="stats-grid">
        <?php foreach ($houseStats as $row): ?>
            <div class="stat-card">
                <?= htmlspecialchars($row['house']) ?><br>
                <strong><?= $row['total'] ?></strong>
            </div>
        <?php endforeach; ?>
    </div>

    <br>
    <a href="admin_users.php" class="magic-btn">📜 Manage Students</a>

</div>

<?php include "footer.php"; ?>

