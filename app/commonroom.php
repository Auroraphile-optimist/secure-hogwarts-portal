<?php
session_start();
require "session_guard.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$house = strtolower($_SESSION['house']);

switch ($house) {
    case "gryffindor":
        header("Location: gryffindor.php");
        break;
    case "slytherin":
        header("Location: slytherin.php");
        break;
    case "ravenclaw":
        header("Location: ravenclaw.php");
        break;
    case "hufflepuff":
        header("Location: hufflepuff.php");
        break;
    default:
        echo "Unknown house!";
}
exit();
?>

