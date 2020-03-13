<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PanelNewsow
 *
 * @author Szymon
 */
class PanelNewsow {
    
    public static function wyswietl($typTresci) {
        $szablon = file_get_contents("C:\\xampp\htdocs\projekt\szablonnewsa.html");
require_once "src\backend\baza.php";
	$baza = new NormalDatabase();

	
	foreach($baza->getNews($typTresci) as $elementyposta){
		if(count($elementyposta) < 4){
			continue;
			
			
		}
			$zajawkatresci = substr($elementyposta["tresc"],0,100);
			$wygenerowanynews = str_replace('##idnewsa##', $elementyposta["id"], $szablon);
			$wygenerowanynews = str_replace('##tytul##', $elementyposta["tytul"], $wygenerowanynews);
			$wygenerowanynews = str_replace('##obrazek##', $elementyposta["obrazek"], $wygenerowanynews);
			$wygenerowanynews = str_replace('##autor##', $elementyposta["autor"], $wygenerowanynews);
			$wygenerowanynews = str_replace('##tresc##', strip_tags($zajawkatresci), $wygenerowanynews);
			
			echo $wygenerowanynews;
	}
	

    }
}
