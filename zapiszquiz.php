<?php
require_once "src/backend/baza.php";
require_once "src/backend/Aplikacja.php";

    if(empty($_POST['name'])){
        $result = [
            'success' => false,
            'msg' => "Nazwa nie jest rowna quiz"
        ];
    }
    else{
    $tab = json_decode($_POST['structure']);
    $questionNumber = count($tab);
    $db = new NormalDatabase();
    $db->createQuiz($_POST['name'], $_POST['structure'], $_POST['description'], $_POST['level'], $questionNumber);
  
    
    $db2 = new NormalDatabase();
    $var = $db2->getQuizByName($_POST['name']);
    $id = $var['id'];
    $address = "/projekt/quiz.php?id=$id";
    $result = [
        'success' => true,
        'url' => $address
    ];
    }
    $jsonResult = json_encode($result);
    echo $jsonResult;
            
?>

