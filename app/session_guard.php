<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ⏱ Idle timeout (seconds)
$SESSION_TIMEOUT = 900; // 15 minutes

if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}

// Update activity time
$_SESSION['last_activity'] = time();

