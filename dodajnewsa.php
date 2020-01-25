<?php
$pageTitle = 'Dodaj swoją treść.';
require_once 'layout.php';
require_once 'footer.php';
$tytul = '';
$tresc = '';
$obrazek = '';
$autor = '';
$typ = 1;
require_once "Aplikacja.php";
	if(!(Aplikacja::isLogged())){
		throw new Exception("Zaloguj sie aby dodawac newsy");
	}
	
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
		$typ = (int)$_POST['wybortresci'];
		echo "<div class='error'>Wystapil blad podczas dodawania newsa</div>";
	}
}
/*
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
*/
//if (isset($_POST['

?>
<div id="main-container">
<form method = 'post'> <!-- formularz pozwala wysyłac dane do serwera. Mogą byc wyslane metoda get lub post. get wysyla wszystko w adresie url i mozemy to podejrzec, a post wysyla w srodku requesta, mozemy to podejrzec narzedziami develeperskim, ale nie jest to az tak widoczne.-->
<div class=''>
<input id='tytul' name='tytul' type='text' value="<?php echo $tytul ?>" placeholder = 'Tytuł'></input><br>
<input id='obrazek' name='obrazek' type='text' value='<?php echo $obrazek ?>' placeholder = 'Obrazek'></input><br>
<textarea id ='tresc' name='tresc' rows='8' cols='50' placeholder = 'Treść'><?php echo $tresc ?></textarea><br>
<input id='autor' name='autor' type='text' value='<?php echo $autor ?>' placeholder = 'Autor'></input><br>
 Wybór treści<select id="wybortresci" name="wybortresci">
                <option value="1" <?php echo $typ === 1 ? "selected" : "" ?>>News</option> <!-- jesli jest rowne numerowi typu to wez ta opcje, jesli nie wez pierwsze z brzegu -->
                <option value="2" <?php echo $typ === 2 ? "selected" : "" ?>>Felieton</option>
                <option value="3" <?php echo $typ === 3 ? "selected" : "" ?>>Transfery</option>

            </select>
 <br>
<input type='submit' value='Dodaj'></input>
</div>
</form>
</div>
 <option value=="1" >News</option>