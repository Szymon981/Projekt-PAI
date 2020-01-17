<?php
require_once 'layout.php';
require_once 'footer.php';
require_once 'Aplikacja.php';


if(!empty($_POST)){
	if(!(Aplikacja::zaloguj($_POST['login'], Aplikacja::encodePassword($_POST['haslo'])))){
		echo "<div class='error'>Nieprawidlowe haslo lub login</div>";
	}
}

?>
<div id="main-container">
	<form method = 'post'>

	Login:<input id = 'login' name = 'login' type = 'text' value=''></input>
	<br>
	Haslo:<input id = 'haslo' name = 'haslo' type = 'password' value=''></input>
	<input type='submit' value='Zaloguj'></input>
	</form>
</div>