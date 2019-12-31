<?php
require_once 'interfejs.php';

class FileDatabase implements DatabaseFacade {
	
	public function getNews() {
		$plikznewsami = file_get_contents("C:\Users\Szymon\Desktop\\newsy.txt");
		$newsy = explode(";",$plikznewsami);
		$posty = [];
		foreach($newsy as $post){
			$tymczasowy = explode("#", $post);
			if(count($tymczasowy) === 5){
			$posty[] = $tymczasowy; 
			}
		}
		
		return $posty;
	}
	public function getNewsById($id){
		$plikznewsami = file_get_contents("C:\Users\Szymon\Desktop\\newsy.txt");
		$newsy = explode(";",$plikznewsami);
		$posty = [];
		foreach($newsy as $post){
			$tymczasowy = explode("#", $post);
			if(count($tymczasowy) === 5 && $tymczasowy[4] == $id){
				return $tymczasowy; 
			}
			
		}
		throw new Exception("Nie znaleziono newsa");
		
		
		
		
	}
	
	public function addNews($dane){
		
		//uzywamy isset zeby miec pewnosc ze tablica nie jest pusta - inaczej strona pokazuje blad {
	//przypisywanie do poszczegolnych zmiennych wyciagnietych danych metoda post, wyciagamy to po atrybucie name z pol, ktorych kod jest na dole pliku
		$tytul = $dane['tytul'];
		$tresc = $dane['tresc'];
		$img = $dane['obrazek'];
		$autor = $dane['autor'];
		$idnewsa =  rand();
		//utworzenie zmiennych, by na sztywno nie wstawiac 
		$sciezkadopliku = ("C:\Users\Szymon\Desktop\\newsy.txt");
		$trescpliku = file_get_contents($sciezkadopliku);
		//konkatynacja(dodawanie) nowych newsow do bazy danych
		$nowywpisnewsa = $tytul."#".$img."#".$tresc."#".$autor.'#'.$idnewsa;
		$trescpliku = $trescpliku.";".$nowywpisnewsa;
		file_put_contents($sciezkadopliku, $trescpliku);
	}
	
}