<?php
require_once 'src\backend\baza.php';
$baza = new NormalDatabase();
$baza->addComment($_POST['idnewsa'], $_POST);
$newComment = $baza->getCommentById($baza->getMaxCommentId());
 $result = [
     'success' => true,
     'id' => $newComment['id'],
     'autor' => $newComment['user_name'],
     'tresc' => $newComment['content'],
     'score' => $newComment['wynik'],
     'plusy' => $newComment['plusy'],
     'minusy' => $newComment['minusy'],
     'data' => $newComment['created']
 ];
 
 echo json_encode($result);
