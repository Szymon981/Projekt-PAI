<style>

    body.logo{
        width: 50px;
    }
    .success {
        background: green;
        color:white;
        padding: 15px;
        font-size: 18px;
    }


</style>
<?php
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
if (isset($_GET['id'])) {
    require_once "src\backend\baza.php";
    $baza = new NormalDatabase();
    $post = $baza->getNewsById($_GET['id']);
    $baza2 = new NormalDatabase();
    $comments = $baza2->getCommentByNewsId($_GET['id']);
} else {

    throw new Exception("Nieprawaidłowe żądanie, brakuje id newsa");
}
?>

<div class="news-inside" id = "news-inside">
    <p>
    <?php
    echo "<h1>$post[1]</h1>";
    echo '<br>';
    echo "<img src = '$post[2]'>";
    echo '<br>';
    echo "<p id = 'content'>$post[4]</p>";
    echo '<br>';
    echo "<p id = 'author' style = 'text-align: right'>$post[3]</p>";
    echo '<br>';
    ?>
    </p>
</div>
<div id = "comment-template" class="comment" style="display:none">
    <?php
        echo"<h1 class='author' style = 'text-align: left'></h1>";
        echo"<br>";
        echo"<p class = 'comment-body'></p>";
        echo"<br>";
        echo"<p class = 'scoreButtons'><span data-comment-id='' class = 'plus'>+</span>".
                " <span data-comment-id=''  class = 'minus'>-</span> <span id = 'score' ></span></p>";
           ?>
</div>
<div id="comments-section">

    <label id = 'comment-mark' style = "font-weight: bold">Komentarze:</label>
    <?php
    foreach ($comments as $value) {
    ?>
<div class = "comment">
    <?php
        echo"<h1 class='author' style = 'text-align: left'>" . $value['user_name'] . "</h1>";
        echo"<br>";
        echo"<p class = 'comment-body'>" . $value['content'] . "</p>";
        echo"<br>";
        echo"<p class = 'scoreButtons'><span data-comment-id='" . $value['id'] 
                . "' class = 'plus'>+</span> <span data-comment-id='" 
                . $value['id'] . "'  class = 'minus'>-</span> <span id = 'score" 
                .$value['id']."' >" 
                . ((int) $value['plusy'] + (int) $value['minusy']) . 
                "</span></p>";
           ?>
</div>
    <?php
    }
 
    ?>
</div>


<div id="commentForm" style="margin-bottom:120px;">
    <?php
    if (Aplikacja::isLogged()) {
        ?>
            <p>Dodajesz komentarz jako: <?php echo Aplikacja::getUsername(); ?></p>
<?php } else {
    ?>
    <div style="width:400px;">
            
            <div style = "width: 15%; float:left;">
                <label>Autor:</label>
            </div>
            <div style  = "width:85%; float:right" >
                <input name="autor" id="autor" type="text">
            </div>
        </div>
            
            
        <?php } ?>
        <br>
        <div style="width:400px;">
            
            <div style = "width: 15%;float:left">
                <label>Treść:</label>
            </div>
            <div style  = "width:85%; float:right" >
                <textarea rows="10" cols="40" name="tresc" id="tresc"></textarea>
            </div>
        </div>
        <br>
        <div style="clear:both"></div>
        <input name="idnewsa" type="hidden" value="<?php echo $_GET['id'] ?>">
        <button id="add-comment"> Dodaj komentarz</button>




</div>


<script>
    var renderNewComment = function(id, autor, tresc, score){
        var htmlId = 'comment-' + id;
        var newComment = $('#comment-template').clone();
        newComment.attr('id', htmlId);
        newComment.appendTo("#comments-section");
        $('#' + htmlId +' .author').text(autor);  
        $('#' + htmlId +' .comment-body').text(tresc);  
        $('#' + htmlId +' #score').attr("id", "score" + id);  
        $('#' + htmlId +' #score' + id).text(score); 
        $('#' + htmlId +' .scoreButtons span').attr("data-comment-id", id); 
        newComment.show();
        
        assignClickListeners('#' + htmlId + " ");    
           
    }
    var performAjaxRequest = function (akcja, id, button) {
        $.ajax({
            method: "GET",
            url: "http://localhost/projekt/zliczpunktacje.php",
            data: {akcja: akcja, id: id}
        }).done(function (res) {
            var response = JSON.parse(res);
            if (response.success) {
                var score = response.score;
                $('#score' + id).text(score);
                button.parent().find('span.minus, span.plus').each(function(index, item){
                    $(item).hide();
                });
            }
            console.log(res);
        });
    };
    
    $('#add-comment').click(function () {
        $.ajax({
            method: "POST",
            url: "http://localhost/projekt/dodawaniekomentarza.php",
            data: {
                idnewsa: <?php echo $_GET['id']?>,
                tresc: $('#tresc').val(), 
                autor: $('#autor').val()}
        }).done(function (res) {
        var response = JSON.parse(res);
        console.log(response);
        renderNewComment(response.id, response.autor, response.tresc, response.score);
            // jezeli success to
            //1. wyczysc formularz
            //2. podepnij diva z nowym komentarzem na strone
            //3. podepnij listenery do akcji (plus minus)
        })
    });
    var assignClickListeners = function(parentSelector) {

        $(parentSelector + '.plus').click(function () {
            var button = $(this);
            var id = button.data('commentId')
            performAjaxRequest("1", id, button);
        });

        $(parentSelector + '.minus').click(function () {
            var button = $(this);
            var id = button.data('commentId')
            performAjaxRequest("-1", id, button);
        });
    }
    assignClickListeners("");
</script>