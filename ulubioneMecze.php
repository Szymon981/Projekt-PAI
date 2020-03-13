<?php
require_once "src/backend/baza.php";
require_once "src/backend/Aplikacja.php";
$matchId = $_POST['id'];
$userId = Aplikacja::getLoggedUserId();
$db = new NormalDatabase();
$db->addFavourite($matchId, $userId);
?>
