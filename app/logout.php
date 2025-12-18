<?php
session_start();
require "csrf.php";

// ❌ Block direct GET access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

// ✅ Verify CSRF token
csrf_verify();

// 🔐 Destroy session securely
$_SESSION = [];
session_destroy();

// 🔄 Redirect to login
header("Location: login.php");
exit;

