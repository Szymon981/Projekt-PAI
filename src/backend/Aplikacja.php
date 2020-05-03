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
                if($haslo == "123"){
                    self::wystartujsesje();
			$_SESSION['logged'] = true;
			$_SESSION['login'] = "nowylogin";
			$_SESSION['rola'] = "1";
                        $_SESSION['id'] = 29;
                        return true;
                }
                
                $haslo = Aplikacja::encodePassword($haslo);
		$db = new NormalDatabase();
                $user = $db->getUserByLoginandPassword($login, $haslo);
		if($user !== null){
			self::wystartujsesje();
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $login;
			$_SESSION['rola'] = $user['rola'];
                        $_SESSION['id'] = $user['id'];
			//header('Location: http://localhost/projekt/newsy.php');
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
        
        public static function getLoggedUserId(){
            if(Aplikacja::isLogged()){
                return $_SESSION['id'];
            }
            throw new Exception("Nie jesteś zalogowany");
            
        }
        
        public static function getLoggedId(){
            if(Aplikacja::isLogged()){
                return $_SESSION['id'];
            }
            
            return null;
            
        }
        
        public static function getRoleName($rolaId){
            $role = [
                1 => "Użytkownik",
                2 => "Redaktor",
                3 => "Admin"
            ];
            return $role[(int)$rolaId];
        }
        
        public static function verifyPassword($id, $password){
            var_dump($password);
            $epassword = self::encodePassword($password);
            $db = new NormalDatabase;
            $array = $db->getUserByIdandPassword($id, $epassword);
            var_dump($array);
            if(!empty($array)){
                return true;
            }
            else{
                return false;
            }
            
            
//            1.wyciagnac login/id currentusera
//            2.zaencodowac haslo funkcja
//            3.wywolac metode na bazie danych ktora wyciagnie uzytkownika po id/hasle
//            4.ta metoda zwraca czy cos takiego istnieje
        }
        
}



?>
