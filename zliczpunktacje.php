<?php
require_once "src/backend/baza.php";
//metoda: getCommentById($id)
//$_GET['akcja'], GET['id']
//1. wyciagnac komentarz z bazy
//2. ustawic mu +/1 w zalezosci od wartosci akcja (uzyc update w bazie danych - zrobic w funkcji query)
//3. obliczyc jaki jest score
//4. zapisac
//5. zwrocic nizej score


$db = new NormalDatabase();
$score = $db->updateCommentScoreById((int)$_GET['id'], (int)$_GET['akcja']);
 $result = [
     'success' => true,
     'score' => $score
 ];
 
 echo json_encode($result);
