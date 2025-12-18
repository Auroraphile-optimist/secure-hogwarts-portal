<?php
require_once "csrf.php";
?>
<form method="POST" action="login_action.php">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

    <label>Email</label>
    <input type="email" name="email" class="scroll-input" placeholder="Enter your magical email" required>

    <label>Password</label>
    <input type="password" name="password" class="scroll-input" placeholder="Enter your secret spell" required>

    <button type="submit" class="magic-btn">Cast Login Spell</button>

    <a href="register.php" class="scroll-link">New wizard? Register here</a>

</form>

