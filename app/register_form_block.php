<?php
require_once "csrf.php";
?>

<div class="register-wrapper">

    <!-- ✍️ Magic Quill -->
    <img
        src="/hogwarts/assets/images/quill.png"
        class="magic-quill"
        alt="Magic Quill"
    >

    <form method="POST" action="register_action.php" class="scroll-form">

        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

        <label>Name</label>
        <input
            type="text"
            name="name"
            class="scroll-input"
            placeholder="Enter your name"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            class="scroll-input"
            placeholder="Enter your magical email"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            class="scroll-input"
            placeholder="Choose a secret spell"
            required
        >

        <label>Choose Your House</label>
        <div class="house-select">
            <label><input type="radio" name="house" value="Gryffindor" required> 🦁 Gryffindor</label>
            <label><input type="radio" name="house" value="Hufflepuff"> 🦡 Hufflepuff</label>
            <label><input type="radio" name="house" value="Ravenclaw"> 🦅 Ravenclaw</label>
            <label><input type="radio" name="house" value="Slytherin"> 🐍 Slytherin</label>
        </div>

        <button type="submit" class="magic-btn">
            ✨ Complete Registration
        </button>

        <a href="login.php" class="scroll-link">
            Already a wizard? Login here
        </a>

    </form>

</div>

