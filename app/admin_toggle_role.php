<?php
require "admin_guard.php";
require "db.php";
require "csrf.php";
require "admin_log.php";

csrf_verify();

if (!isset($_POST['user_id'])) {
    die("Missing user_id");
}

$targetUserId = (int) $_POST['user_id'];
$adminId = $_SESSION['user_id'];

if ($targetUserId === $adminId) {
    header("Location: admin_users.php");
    exit;
}

$stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$targetUserId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found");
}

$newRole = ($user['role'] === 'admin') ? 'user' : 'admin';

$pdo->prepare("UPDATE users SET role = ? WHERE id = ?")
    ->execute([$newRole, $targetUserId]);

log_admin_action($pdo, $adminId, "Changed role to $newRole", $targetUserId);

header("Location: admin_users.php");
exit;

