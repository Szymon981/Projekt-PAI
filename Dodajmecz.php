<?php
$pageTitle = 'Dodaj mecz.';
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';

require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once "src\backend\Aplikacja.php";
require_once "src\backend\baza.php";	
$druzyna1 = '';
$druzyna2 = '';
$data = '';
$czas = '';

	if(!(Aplikacja::isLogged())){
		throw new Exception("Zaloguj sie aby dodawac mecze");
	}
	
	if (!empty($_POST))
{	
	$baza = new NormalDatabase();
	if($baza->addMatch($_POST)) {
		
		echo "<div class='success'>Został dodany mecz</div>";
	} else {
		$druzyna1 = $_POST['druzyna1'];
		$druzyna2 = $_POST['druzyna2'];
		$data = $_POST['data'];
		$czas = $_POST['czas'];
		echo "<div class='error'>Wystapil blad podczas dodawania meczu</div>";
	}
}

?>
<meta charset="utf-8">
<div id="main-container">
<form method = 'post'>  
<div class=''>
<input id='druzyna1' name='druzyna1' type='text' value="<?php echo $druzyna1 ?>" placeholder = 'Druzyna1'></input><br>
<input id='druzyna2' name='druzyna2' type='text' value="<?php echo $druzyna2 ?>" placeholder = 'Druzyna2'></input><br>
<input id='data' name='data' type='text' value="<?php echo $data ?>" placeholder = 'Data'></input><br>
<input id='czas' name='czas' type='text' value="<?php echo $czas ?>" placeholder = 'Czas'></input><br>
<input type='submit' value='Dodaj'></input>
</div>
</form>
</div>

  <script>
  $( function() {
    $( "#data" ).datepicker({
        
        dateFormat: 'yy-mm-dd',
        currentText: "Dzisiaj"
    });
  } );
  var dostepneDruzyny = [
      
      "Barcelona",
      "Manchester City",
      "Real Madryt",
      "Atletico Madryt",
      "Manchester United"
  ];
  $("#druzyna1, #druzyna2").autocomplete({
      source:dostepneDruzyny,
      minLength:3
  });
  
  </script>
