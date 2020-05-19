
<?php
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once "src\backend\baza.php";
require_once 'src\backend\Aplikacja.php';

$db = new NormalDatabase();
$quiz = $db->getQuizById($_GET['id']);
echo $quiz["name"];

$userId = "999";
if(Aplikacja::isLogged()){
    $userId = $_SESSION['id'];
}
?>
<div id = "quiz-container">
    <div>Twój wynik to:
        <span id = "current-score">0</span>
        /
        <span id = "max-score">0</span>
        <p  id = "1"><?php echo $_GET['id'] ?></p>
        <p  id = "2"><?php echo $userId ?></p> 
    </div>
 <button id = "save-score" class = "btn btn-success">Zapisz wynik</button>
</div>

<script type = "text/javascript">
'use strict';
var structure = <?php echo $quiz['structure']?>;
$(document).ready(function(){
    for(var i = 0; i < structure.length; i++){
        var questionName = structure[i]['questionText'];
        var answer1 = structure[i]['answers'][0];
        var answer2 = structure[i]['answers'][1];
        var answer3 = structure[i]['answers'][2];
        var answer4 = structure[i]['answers'][3];
        var validAnswer = structure[i]['validAnswer'];
        
        createNewQuestion("#quiz-container", questionName, answer1, answer2, answer3, answer4, validAnswer);
    }
})
function submitAjaxRequest(){
    var quizId = <?php echo $_GET['id'] ?>;
    var score = $("#current-score").html();
    
    
    $.ajax({
        method:"POST",
        url:"http://localhost/projekt/zapiszwynikquizu.php",
        data:{quizId: quizId, score: score}
        
    }).success(function(res){
        var response = JSON.parse(res);
        if(response.success == true){
            $("#quiz-container").prepend("<div class = 'success'><p>"+response.msg+"</p></div>").fadeOut("slow");
        }
        else{
            $("#quiz-container").prepend("<div class = 'error'><p>"+response.msg+"</p></div>").fadeOut("slow");
            console.log(quizId);
            console.log(score);
            console.log(userId);
        }
    }).error(function(res){
    var response = JSON.parse(res);
    console.log(response);
    });
    
    
}
$(document).ready(function(){
        $("#save-score").click(function(){
           submitAjaxRequest(); 
        });
    });

</script>
