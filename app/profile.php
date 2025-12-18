<?php 
session_start();
require "session_guard.php";
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT name, email, house, created_at FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['name'];
$email = $user['email'];
$house = $user['house'];
$created_at = $user['created_at'];

include "header.php";
?>

<h1 class="magical-title">Your Wizard Profile</h1>

<!-- House Badge (only ONCE) -->
<div class="house-badge">
    <img src="/hogwarts/assets/icons/houses/<?php echo strtolower($house); ?>.png"
         class="dashboard-house-badge"
         alt="House Badge">
</div>

<div class="scroll-box">

    <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>House:</strong> <?= htmlspecialchars($house) ?></p>
    <p><strong>Joined:</strong> <?= htmlspecialchars($created_at) ?></p>

    <a href="dashboard.php" class="scroll-link">Return to Great Hall</a>
</div>

<?php include "footer.php"; ?>

