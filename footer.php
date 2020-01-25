<?php
require_once "layout.php"
?>
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #2699FB;
  color: white;
  text-align: center;
}
</style>



<div class="footer" id="footer">
	<img class='logo' src = "https://cdn.shopifycloud.com/hatchful-web/assets/67cbe9b74baf7f893488c5fc426d31eb.png">
	<div id="main-menu-items">
			<a href="/projekt/dodajnewsa.php">Dodaj newsa</a>
			<a href="/projekt/newsy.php">Strona glowna</a>
			<a href="/projekt/transfery.php">Transfery</a>
			<a href="/projekt/felietony.php">Felietony</a>
			<a href="/projekt/mecze.php">Mecze</a>
			<a href="/projekt/Kontakt.php">Kontakt</a>
			<a href="/projekt/rejestracja.php">Rejestracja</a>
		<?php 
			require_once "Aplikacja.php";
			if(Aplikacja::isLogged()){
				$wyloguj = "Wyloguj(".Aplikacja::getUsername().")";
				echo"<a href='/projekt/wyloguj.php'>$wyloguj</a>";
			}
			else{
				
				echo'<a href="/projekt/logowanie.php">Zaloguj</a>';
			}
		?>
	</div>
</div>