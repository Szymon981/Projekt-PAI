<?php
$pageTitle = 'Quiz.';
require_once "src/backend/baza.php";
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';

?>
<script>
    function submitAjaxRequest(){
        var name = $("#nazwa-quizu").val();
        var description = $("#description").val();
        var level = $("#level").val();
        $.ajax({
            method: "POST",
            url: "http://localhost/projekt/zapiszquiz.php",
            data:{name: name, structure: quizToJson(), description: description, level: level}
            
        }).success(function(res){
            var response = JSON.parse(res);
            if(response.success == false){
            $("#sport-quiz-container").prepend("<div class = 'error'><p>"+response.msg+"</p></div>");
        }
        else{
            location.href = response.url;
        }
        }).error(function(res){
           console.log(res);
        });
    }
    $(document).ready(function(){
        CreateQuiz('#open-popup', '#sport-quiz-container');
        $("#submit").click(function(){
//                if(JSON.parse(quizToJson()).length == 0){
//                    $("#sport-quiz-container").prepend("<div class = 'error'><p>Coś poszło nie tak.</p></div>").fadeOut("slow");
//                }
//                else{
                submitAjaxRequest();
//            }
            });
    });
    
    
  
    
    
            
</script>
<div id = "sport-quiz-container">
    <input id = "nazwa-quizu" placeholder="Nazwa quizu"><br>
    <textarea id = "description" placeholder = "Opis" rows = "10" cols = "50"></textarea><br>
    Poziom trudności: <select id = "level">
        <option value = "1">Łatwy</option>
        <option value = "2">Średni</option>
        <option value = "3">Trudny</option>
    </select>
</div>
    <button id = "open-popup">Otwórz popupa</button>
    <button id = "submit">Zapisz Quiz</button>
   