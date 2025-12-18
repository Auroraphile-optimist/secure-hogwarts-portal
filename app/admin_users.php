<?php
require "admin_guard.php";
require "db.php";
require "csrf.php";

$pageTitle = "Student Registry";
$pageNoHouseTheme = true;

include "header.php";

$stmt = $pdo->query("SELECT id, name, email, house, role, status FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- 🧙 Admin Navigation -->
<div style="text-align:center; margin:20px 0;">
    <a href="admin_dashboard.php" class="magic-btn">🧙 Headmaster’s Office</a>
    <a href="admin_logs.php" class="magic-btn" style="margin-left:15px;">📜 View Admin Logs</a>
</div>

<h1 class="magical-title">📜 Hogwarts Student Registry</h1>

<table class="admin-table">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>House</th>
    <th>Role</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php foreach ($users as $u): ?>
<tr>
    <td><?= htmlspecialchars($u['name']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= htmlspecialchars($u['house']) ?></td>
    <td><?= htmlspecialchars($u['role']) ?></td>
    <td><?= htmlspecialchars($u['status']) ?></td>

    <td class="admin-actions">

    <form method="POST" action="admin_toggle_status.php">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
      <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
      <button title="Ban / Unban">
        <?= $u['status'] === 'active' ? '🚫' : '✅' ?>
      </button>
    </form>

    <?php if ($u['id'] !== $_SESSION['user_id']): ?>
    <form method="POST" action="admin_toggle_role.php">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
      <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
      <button title="Toggle Admin">
        <?= $u['role'] === 'user' ? '👑' : '⬇️' ?>
      </button>
    </form>
    <?php endif; ?>

    <form method="POST" action="admin_delete.php"
        onsubmit="return confirm('Expel this student?');">
     <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
     <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
     <button title="Delete">❌</button>
    </form>

    </td>

</tr>
<?php endforeach; ?>
</table>

<?php include "footer.php"; ?>

