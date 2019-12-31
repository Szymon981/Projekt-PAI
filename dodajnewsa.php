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
require_once 'menu.php';

if (isset($_POST['tytul']))
{	
	require_once 'bazaplikowa.php';
	$baza = new FileDatabase();
	$baza->addNews($_POST);
echo "<div class='success'>Został dodany news</div>";
}

?>

<form method = 'post'> <!-- formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.-->
<div class='news'>
Tytul<input id='tytul' name='tytul' type='text'></input><br>
Obrazek<input id='obrazek' name='obrazek' type='text'></input><br>
Tresc<input id ='tresc' name='tresc' type='text'></input><br>
Autor<input id='autor' name='autor' type='text'></input><br>
<input type='submit' value='Dodaj'></input>
</div>
</form>