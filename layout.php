<head>
    <?php if (isset($pageTitle)){ ?>
        <title><?php echo $pageTitle; ?></title>
    <?php } ?>
</head>

<div id="main_menu">
    <img class='logo' src = "https://cdn.shopifycloud.com/hatchful-web/assets/67cbe9b74baf7f893488c5fc426d31eb.png">
    <div id="main-menu-items">
        <a href="/projekt/dodajnewsa.php">Dodaj treść</a>
        <a href="/projekt/newsy.php">Strona główna</a>
        <a href="/projekt/transfery.php">Transfery</a>
        <a href="/projekt/felietony.php">Felietony</a>
        <a href="/projekt/mecze.php">Mecze</a>
        <a href="/projekt/Kontakt.php">Kontakt</a>
        <a href="/projekt/rejestracja.php">Rejestracja</a>
        <?php
        require_once "Aplikacja.php";
        if (Aplikacja::isLogged()) {
            $wyloguj = "Wyloguj(" . Aplikacja::getUsername() . ")";
            echo"<a href='/projekt/wyloguj.php'>$wyloguj</a>";
        } else {

            echo'<a href="/projekt/logowanie.php">Zaloguj</a>';
        }
        ?>
    </div>
</div>
<style>
    h1 {            <!-- kolor wszystkich h1 -->
        color: #2699FB;         
    }
    body{       <!-- czcionka i margines od strony newsa -->
        margin:0px;
        font-family: "Century Gothic", "Helvetica";				
        <!-- pierwsza czcionka wystepuje na windowsie, druga jest podana gdyby na danym systemie nie bylo gothic, a trzecia to ogolny typ czcionki, ktory bedzie dzialal na kazdym systemie -->

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
        margin: 10px 30px;
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
        padding-right:10px;


    }

    h1{
        font-size:20px;
        margin-top:0px;

    }

</style>