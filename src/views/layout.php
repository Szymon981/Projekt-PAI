
<head>
    <?php if (isset($pageTitle)){ ?>
        <title><?php echo $pageTitle; ?></title>
    <?php } ?>
<link type='text/css' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro|EB+Garamond|Raleway|Nunito|Roboto|Droid|Arvo|Aleo|Jura' rel='stylesheet'>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <!--<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>-->
  <script src="../Quiz/public_html/quiz.js"></script>
  <link rel="stylesheet" href="../Quiz/public_html/quiz.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

<div id="main_menu">
    <img class='logo' src = "https://cdn.shopifycloud.com/hatchful-web/assets/67cbe9b74baf7f893488c5fc426d31eb.png">
<!--    <div id="main-menu-items">-->
        <a href="/projekt/newsy.php">Strona główna</a>
        <a href="/projekt/transfery.php">Transfery</a>
        <a href="/projekt/felietony.php">Felietony</a>
        <a href="/projekt/mecze.php">Mecze</a>
        <a href="/projekt/Kontakt.php">Kontakt</a>
        <a href="/projekt/rejestracja.php">Rejestracja</a>
        <a href="/projekt/Parser2.php">Panel admina</a>
        <a href="/projekt/quizy.php">Quiz</a>
        
        <div class="dropdown admin-links">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Rzeczy admina
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="/projekt/Dodajmecz.php">Dodaj mecz</a>
      <a class="dropdown-item" href="/projekt/uzytkownicy.php">Użytkownicy</a>
      <a class="dropdown-item" href="/projekt/stworzquiz.php">Stwórz quiz</a>
      <a class="dropdown-item" href="/projekt/dodajnewsa.php">Dodaj treść</a>
    </div>
    </div>

        <?php
        require_once __DIR__ . "\..\backend\Aplikacja.php";
        if (Aplikacja::isLogged()) {
            $wyloguj = "Wyloguj(" . Aplikacja::getUsername() . ")";
            echo"<a href='/projekt/wyloguj.php'>$wyloguj</a>";
        } else {

            echo'<a href="/projekt/logowanie.php">Zaloguj</a>';
        }
        ?>
        <div style = "clear: both"></div>
        <!--</div>-->
</div>
<?php 
$flahMessage = Aplikacja::getFlashMessage();
if (!empty($flahMessage)) {
    echo "<div class='success'>" . $flahMessage . "</div>";
    
}
?>
<style>
    @media(max-width: 800px){
        
        body .news{
            
            
        }
        body h1{
            
        }
    }
    h1 {            
        color: #2699FB;         
    }
    body{       
        
        

    }
  
   
    .page-link{
        float: left;
    }
    
    
/*    #main_menu a{
        color:white;
        text-decoration: none;
        margin: 10px 20px;
        font-size:18px;

    }*/
    
/*    .logo{
        width: 50px;
    }*/
    .success {
        background: green;
        color:white;
        padding: 15px;
        font-size: 18px;
    }
    .error {
        background: red;
        color:white;
        padding: 15px;
        font-size: 18px;
    }
    form input, form textarea, form select {
        padding: 10px;
        margin-left: 10px;
        margin-top:20px;
    }
    form input[type=submit] {
        background: #2699FB;
        color:white;
        border:none;
    }

    .card{
        float: left;
        width: 40%;
        margin: 10px;
        padding: 20px;
        min-height: 250px;

    }	

    .news img{
        width: 50%;
        float:left;
    }
    
    .news .tresc-newsa {
        width:50%;
        float:right;
    }



    .newsbody{
        width:45%;
        float:left;
        padding-left:10px;
        
    } 

    h1{
        font-size:20px;
        margin-top:0px;

    }
    .minus{
        color:red;
    }
    
    .plus{
        
        color:green;
    }
    
    .comment{
        margin-left: 15px;
        background: lightblue;
        width: 500px;
        padding:15px;
        margin-bottom: 20px;
        border-radius: 20px;
        text-align: center
    }
    
    .scoreButtons{
        cursor: pointer;
        font-weight:bold;
        font-size: 20px;
        
    }
    #add-comment{
        background: #2699FB;
        color:white;
        border:none;
        font-size: 17px;
        height: 60px;
        width: 200px;
    }
    
    .news-inside{
        background: lightblue;
        width: 850px;
        margin:15px;
        padding:10px;
        padding-right:10px;
        display: inline-block
        
        
    }
    #news-inside{
        /*font-family: italian;*/
        font-family: "Times New roman", "Helvetica";
        border-radius: 20px;
        text-align:center
    }
    
    #author{
        color:blueviolet;
        background:lightblue;
        
    }
    
    #commentForm{
        font-family: "Century Gothic", "Helvetica";
        font-weight: bold;
        margin-left: 15px;
    }
    
    .starContainer{
        
        width: 15%;
        float: right;
        cursor: pointer;
    }
    
    .user-container{
        width: 1000px;
        margin-left: 20px;
        
    }
    
    .imie, .rola, .trashbinContainer{
        float: left;
        width: 200px;
    }
    
    .current-page-link{
        font-size: 20px;
    }
    
    .quiz-name{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    
    #quiz-h1,  #quiz-select-button, #save-score{
      display: inline-block;
      margin: 10px;
    }
    
    
</style>