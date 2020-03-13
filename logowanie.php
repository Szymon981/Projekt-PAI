<?php
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once 'src\backend\Aplikacja.php';


if(!empty($_POST)){
	if(!(Aplikacja::zaloguj($_POST['login'], Aplikacja::encodePassword($_POST['haslo'])))){
		echo "<div class='error'>Nieprawidlowe haslo lub login</div>";
	}
}

?>
<div id="main-container">
	<form method = 'post'>

	<input id = 'login' name = 'login' type = 'text' value='' placeholder = 'Login'></input>
	<br>
	<input id = 'haslo' name = 'haslo' type = 'password' value='' placeholder = 'Hasło'></input>
	<input type='submit' value='Zaloguj'></input>
	</form>
</div>