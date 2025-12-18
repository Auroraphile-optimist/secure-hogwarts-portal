<?php
function log_admin_action($pdo, $adminId, $action, $targetUserId = null) {
    $stmt = $pdo->prepare(
        "INSERT INTO admin_logs (admin_id, action, target_user_id)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$adminId, $action, $targetUserId]);
}

