<?php
session_start();

/**
 * 🚫 If user is already logged in,
 * do NOT allow register page
 */
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// 🎨 Register page should be neutral (no house theme)
$pageNoHouseTheme = true;
$pageTitle = "Register - Hogwarts";

// ✅ Include header ONLY ONCE
include "header.php";
?>

<h1 class="magical-title">Become a Wizard of Hogwarts</h1>

<div class="scroll-box">
    <?php include 'register_form_block.php'; ?>
</div>

<!-- ✨ Quill Magic Script -->
<script src="/hogwarts/assets/js/quill-magic.js"></script>

<?php include "footer.php"; ?>

