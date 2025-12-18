<?php
require "admin_guard.php";
require "db.php";
require "csrf.php";
require "admin_log.php";

csrf_verify();

if (!isset($_POST['user_id'])) {
    die("Missing user_id");
}

$userId = (int) $_POST['user_id'];

$stmt = $pdo->prepare("SELECT status FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found");
}

$newStatus = ($user['status'] === 'active') ? 'banned' : 'active';

$pdo->prepare("UPDATE users SET status = ? WHERE id = ?")
    ->execute([$newStatus, $userId]);

log_admin_action($pdo, $_SESSION['user_id'], "Toggled status to $newStatus", $userId);

header("Location: admin_users.php");
exit;

