<head>
    <?php if (isset($pageTitle)){ ?>
        <title><?php echo $pageTitle; ?></title>
    <?php } ?>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<div id="main_menu">
    <img class='logo' src = "https://cdn.shopifycloud.com/hatchful-web/assets/67cbe9b74baf7f893488c5fc426d31eb.png">
    <div id="main-menu-items">
        <a href="/projekt/dodajnewsa.php">Dodaj treść</a>
        <a href="/projekt/Dodajmecz.php">Dodaj mecz</a>
        <a href="/projekt/newsy.php">Strona główna</a>
        <a href="/projekt/transfery.php">Transfery</a>
        <a href="/projekt/felietony.php">Felietony</a>
        <a href="/projekt/mecze.php">Mecze</a>
        <a href="/projekt/Kontakt.php">Kontakt</a>
        <a href="/projekt/rejestracja.php">Rejestracja</a>
        <a href="/projekt/Parser2.php">Panel admina</a>
        <?php
        require_once __DIR__ . "\..\backend\Aplikacja.php";
        if (Aplikacja::isLogged()) {
            $wyloguj = "Wyloguj(" . Aplikacja::getUsername() . ")";
            echo"<a href='/projekt/wyloguj.php'>$wyloguj</a>";
        } else {

            echo'<a href="/projekt/logowanie.php">Zaloguj</a>';
        }
        ?>
    </div>
</div>
<?php 
$flahMessage = Aplikacja::getFlashMessage();
if (!empty($flahMessage)) {
    echo "<div class='success'>" . $flahMessage . "</div>";
    
}
?>
<style>
    
    h1 {            
        color: #2699FB;         
    }
    body{       
        margin:0px;
        font-family: "Century Gothic", "Helvetica";				
        

    }
    #main-container { 
        width:50%;
        margin: 20px auto; 
    }
    #main-menu-items {     
        width:auto;
        float: right;
        padding-top:10px;
    }
    #main_menu {
        background: #2699FB;
    }
    #main_menu a{
        color:white;
        text-decoration: none;
        margin: 10px 20px;
        font-size:18px;

    }
    .logo{
        width: 50px;
    }
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

    .news{
        float: left;
        width: 40%;
        margin: 10px;
        padding: 20px;
        height: 250px;

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
    
    
</style>