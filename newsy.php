<style>
	body{

	}
	.news{
		float: left;
		width: 40%;
		margin: 10px;
		background: #c9f0ec;
		padding: 20px;
		height: 250px;
		
	}	
	
	.news img{
		width: 50%;
		float:left;
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

<?php
	require_once 'menu.php';
	// jesli string to wypisz
	// jesli nie string to wywolaj funkcje __toString()
	// jesli nie ma wywolaj nazwe obiektu

	$szablon = file_get_contents("C:\\xampp\htdocs\projekt\szablonnewsa.html");
	require_once 'bazaplikowa.php';
	$baza = new FileDatabase();

	
	foreach($baza->getNews() as $elementyposta){
		if(count($elementyposta) < 4){
			continue;
			
			
		}
			$zajawkatresci = substr($elementyposta[2],0,100);
			$wygenerowanynews = str_replace('##obrazek##', $elementyposta[1], $szablon);
			$wygenerowanynews = str_replace('##tytul##', $elementyposta[0], $wygenerowanynews);
			$wygenerowanynews = str_replace('##tresc##', $zajawkatresci, $wygenerowanynews);
			$wygenerowanynews = str_replace('##autor##', $elementyposta[3], $wygenerowanynews);
			$wygenerowanynews = str_replace('##idnewsa##', $elementyposta[4], $wygenerowanynews);
			echo $wygenerowanynews;
			//echo "<div class='news'><img src='$elementyposta[1]'>";
			//echo "<div class='newsbody'><h1>$elementyposta[0]</h1>";
			/*echo "<p>$zajawkatresci</p>";
			echo "<h4>$elementyposta[3]</h4>";
			echo "<h4>$elementyposta[4]</h4></div></div>";*/
			
			
			//zrobic to dla pozostalych elementow tablicy elementyposta
	}
	

?>