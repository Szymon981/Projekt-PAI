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
	.error {
		background: red;
		color:white;
		padding: 15px;
		font-size: 18px;
	}


</style>
<?php
require_once 'menu.php';
$tytul = '';
$tresc = '';
$obrazek = '';
$autor = '';
if (!empty($_POST))
{	
	require_once 'baza.php';	//includuje baza.php
	$baza = new NormalDatabase();
	if($baza->addNews($_POST)) {
		
		echo "<div class='success'>Został dodany news</div>";
	} else {
		$tytul = $_POST['tytul'];
		$tresc = $_POST['tresc'];
		$autor = $_POST['autor'];
		$obrazek = $_POST['obrazek'];
		echo "<div class='error'>Wystapil blad podczas dodawania newsa</div>";
	}
}

//if (isset($_POST['

?>

<form method = 'post'> <!-- formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.-->
<div class='news'>
Tytul<input id='tytul' name='tytul' type='text' value="<?php echo $tytul ?>"></input><br>
Obrazek<input id='obrazek' name='obrazek' type='text' value='<?php echo $obrazek ?>'></input><br>
Tresc<textarea id ='tresc' name='tresc' rows='8' cols='50' ><?php echo $tresc ?></textarea><br>
Autor<input id='autor' name='autor' type='text' value='<?php echo $autor ?>'></input><br>
<input type='submit' value='Dodaj'></input>
</div>
</form>