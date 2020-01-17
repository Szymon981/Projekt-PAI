<?php
require_once 'baza.php';
class Aplikacja{
	private static $czysesjawystartowala = false;
	
        public static function encodePassword($password){
            return sha1($password);
        }
        
	public static function isLogged(){
		
		self::wystartujsesje();
		if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {		//sprawdzamy issetem czy pole logged w tablicy session jest zadeklarowane i sprawdzamy czy jesteśmy zalogowani
			return true;
		}
		
		return false;
		
	}

	public static function zaloguj($login, $haslo){		//odrazu po uzyciu tej funkcji nadajemy parametr true polu logged i dodajemy do tablicy session pole login 
		$db = new NormalDatabase();
		if($db->getUserByLoginandPassword($login, $haslo) !== null){
			self::wystartujsesje();
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $login;
			header('Location: http://localhost/projekt/newsy.php');
		}
		return false;
	}
	
	public static function getUsername(){
		return $_SESSION['login'];
		
	}
	
	public static function wyloguj() {
		self::wystartujsesje();
		session_destroy();
	}
	
	private static function wystartujsesje(){
		if(self::$czysesjawystartowala === false){
			self::$czysesjawystartowala = true;
			session_start();
		}
	}
        
}



?>