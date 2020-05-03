<!--<script>
$("#quiz-select-button").click(function(){
   location.href = '/projekt/quiz.php?id=<?php echo $quizes['id'] ?>';
});

</script>-->
<script>
function redirect(id){
    location.href = "/projekt/quiz.php?id="+id;
}
</script>
<?php
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once "src\backend\baza.php";
$db = New NormalDatabase();
$wygenerowanaNazwa = '';

foreach($db->getQuizes() as $quizes):?>
    
<div class = "quiz-name">
    <h1 id = "quiz-h1"><?php echo $quizes['name']?></h1>
    <p id = "level"> | Poziom trudności: <?php echo $quizes['level'] ?>  </p>
    <p id = "question-number"> | Liczba pytań: <?php echo $quizes['questions_number'] ?> | </p>
    <button id = "quiz-select-button" onclick = 'redirect(<?php echo $quizes['id']?>)'>Wybierz Quiz</button>
   
    
</div>
<br>
<?php 
endforeach;
?>


