<?php
require "admin_guard.php";
require "db.php";
require "csrf.php";
require "admin_log.php";

/**
 * Only allow POST
 */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_users.php");
    exit;
}

csrf_verify();

if (!isset($_POST['id'])) {
    header("Location: admin_users.php");
    exit;
}

$userId  = (int) $_POST['id'];
$adminId = $_SESSION['user_id'];

// ❌ Prevent admin deleting himself
if ($userId === $adminId) {
    header("Location: admin_users.php");
    exit;
}

// Check user exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: admin_users.php");
    exit;
}

// 📜 Log BEFORE delete
log_admin_action(
    $pdo,
    $adminId,
    "Deleted user account",
    $userId
);

// ❌ Delete user
$delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
$delete->execute([$userId]);

header("Location: admin_users.php");
exit;

