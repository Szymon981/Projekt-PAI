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
    <label id = 'sort'>Sortuj po:</label>
    <button id = 'date-sort' class = "btn btn-light">Dacie</button>
    <button id = 'score-sort' class = "btn btn-dark">Wyniku komentarza</button>
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
        <div style="width:700px;">
            
            <div>
                <label>Treść:</label>
            </div>
            <div>
                <div class = "row">
                    <div id = "regulamin" class = "col-lg-6" style="background: red">
                        <h1>Zasady dodawania komentarzy:</h1>
                        <p>1.formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.</p>
                        <p>2.</p>
                        <p>3.</p>
                        <p>4.formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.</p>
                        <p>6.</p>
                        <p>7.formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.</p>
                    </div>
                    <div id = "comment-field" class = "col-lg-6">
                         <textarea rows="10" cols="40" name="tresc" id="tresc"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div style="clear:both"></div>
        <input name="idnewsa" type="hidden" value="<?php echo $_GET['id'] ?>">
        <button id="add-comment" class = "btn btn-primary"> Dodaj komentarz</button>




</div>


<script>
    var commentsStructure = [
        <?php 
        foreach ($comments as $comment):        
        ?>
            {
                id: <?php echo $comment['id'];?>,
                autor: "<?php echo $comment['user_name'];?>",
                body: "<?php echo $comment['content'];?>",
                score: <?php echo $comment['wynik'];?>,
                date: "<?php echo $comment['created'];?>"
            },
        <?php
        endforeach;
        ?>
    ];
    
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
    
    
    $('#add-comment').click(function () {
        $.ajax({
            method: "POST",
            url: "http://localhost/projekt/dodawaniekomentarza.php",
            data: {
                idnewsa: <?php echo $_GET['id']?>,
                tresc: window.editor.value(), 
                autor: $('#autor').val()}
        }).done(function (res) {
            var response = JSON.parse(res);
            console.log(response);
            renderNewComment(response.id, response.autor, response.tresc, response.score);
            var structure = {
                id: response.id,
                autor: response.autor,
                body: response.tresc,
                score: response.score,
                date: response.data
            }
            commentsStructure.push(structure);
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
    $(document).ready(function(){
    assignClickListeners("");
        window.editor = new SimpleMDE({element: document.getElementById("tresc") });
        
        document.getElementsByClassName("CodeMirror")[0].style.height = (document.getElementById("regulamin").clientHeight-45)+"px"
    });
    function createComparingFunction(field){
        return function (a,b){
            if(a[field] < b[field])
                return 1;
            if(a[field] > b[field])
                return -1;
            else
                return 0;
            }
    }
    
    var sortCommentByScore = function(){
        
        
        var sortedStructure = commentsStructure.sort(createComparingFunction('score'));
        return sortedStructure;
    }
    $("#score-sort").click(function(){
        $("#comments-section .comment").remove();
        var sorted = sortCommentByScore();
        for(var i = 0; i < sorted.length; i++){
            renderNewComment(sorted[i].id, sorted[i].autor, sorted[i].body, sorted[i].score)
            console.log(sorted);
        }
    });
    
    var sortCommentByDate = function(){
        var sortedStructure = commentsStructure.sort(createComparingFunction('date'));
        return sortedStructure;
        
    }
    
    $('#date-sort').click(function(){
        $("#comments-section .comment").remove();
        
        var sorted = sortCommentByDate();
        for(var i = 0; i < sorted.length; i++){
            renderNewComment(sorted[i].id, sorted[i].autor, sorted[i].body, sorted[i].score);
        }
    });
</script>