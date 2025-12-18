<?php
require "admin_guard.php";
require "db.php";

$pageTitle = "Admin Audit Logs";
$pageNoHouseTheme = true;

include "header.php";

$logs = $pdo->query("
    SELECT l.*, u.name AS admin_name
    FROM admin_logs l
    JOIN users u ON l.admin_id = u.id
    ORDER BY l.created_at DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="magical-title">📜 Admin Audit Logs</h1>

<table class="admin-table">
<tr>
    <th>Admin</th>
    <th>Action</th>
    <th>Target User ID</th>
    <th>Time</th>
</tr>

<?php foreach ($logs as $log): ?>
<tr>
<td><?= htmlspecialchars($log['admin_name']) ?></td>
<td><?= htmlspecialchars($log['action']) ?></td>
<td><?= $log['target_user_id'] ?? '-' ?></td>
<td><?= $log['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include "footer.php"; ?>

