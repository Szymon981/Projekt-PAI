<?php
require_once __DIR__.'\baza.php';
class Aplikacja{
	private static $czysesjawystartowala = false;
	
        public static function encodePassword($password){
            return sha1($password);
        }
        
        public static function setFlashMessage($msg) {
            self::wystartujsesje();
            
            $_SESSION['flashMessage'] = $msg;
            
        }
        public static function getFlashMessage() {
            self::wystartujsesje();
            
            if (!empty($_SESSION['flashMessage'])) {
                $flashMessage = $_SESSION['flashMessage'];
                $_SESSION['flashMessage'] = null;
                return $flashMessage;
            }
            
            return null;
        }
        
	public static function isLogged(){
		
		self::wystartujsesje();
		if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {		
			return true;
		}
		
		return false;
		
	}
        
        public static function isAdmin(){
		if (self::isLogged() && ((int)$_SESSION['rola'] === 3)) {		
			return true;
		}
		
		return false;
        }

	public static function zaloguj($login, $haslo){		
		$db = new NormalDatabase();
                $user = $db->getUserByLoginandPassword($login, $haslo);
		if($user !== null){
			self::wystartujsesje();
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $login;
			$_SESSION['rola'] = $user['rola'];
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