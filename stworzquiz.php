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
            $("#sport-quiz-container").prepend("<div class = 'alert alert-danger'><p>"+response.msg+"</p></div>");
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
<form>
    <div id = "sport-quiz-container">
        <div class = "form-group">
            <label for = "nazwa-quizu">Nazwa quizu</label>
            <input id = "nazwa-quizu">
        </div>
        <div class = "form-group">
            <label for = "description">Opis</label>
            <textarea id = "description" rows = "10" cols = "50"></textarea>
        </div>
        <div class = "form-group">
            <label for = "level">Poziom trudności:</label>
            <select id = "level">
                <option value = "1">Łatwy</option>
                <option value = "2">Średni</option>
                <option value = "3">Trudny</option>
            </select>
        </div>
    </div>
        <button id = "open-popup" class = "btn btn-primary">Otwórz popupa</button>
        <button id = "submit" class = "btn btn-success">Zapisz Quiz</button>
</form>
   