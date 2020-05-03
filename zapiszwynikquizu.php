<?php
require_once 'src\backend\baza.php';
require_once 'src\backend\Aplikacja.php';
$result = "";
$quizId = $_POST['quizId'];
$userId = Aplikacja::getLoggedId();
$score = $_POST['score'];
if(empty($_POST['quizId']) || empty($_POST['score'])){
$result = [
    'success' => false,
    'msg' => "Brakuje którejś danej do przesłania"
    ];
}
else{
    $db = new NormalDatabase();
    $db->saveQuizScore($quizId,$userId,$score);
    $result = [
        'success' => true,
        'msg' => "Zapisano wynik"
    ];
}
$jsonResult = json_encode($result);
echo $jsonResult;
?>

