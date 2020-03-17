<?php
require_once "src/backend/baza.php";
require_once "src/backend/Aplikacja.php";
$userId = $_POST['id'];
$db = new NormalDatabase();
$db->deleteUser($userId);
?>
