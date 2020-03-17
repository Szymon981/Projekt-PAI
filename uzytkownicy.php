<?php
$pageTitle = 'Strona dla adminów.';
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once "src\backend\Aplikacja.php";
require_once "src\backend\baza.php";


////if(!(Aplikacja::isAdmin())){
//    throw new Exception("Nie jesteś adminem, nie masz dostępu do tej strony.");
//}

class PanelUzytkownika{
    public static function wyswietl(){
        $szablon = file_get_contents("C:\\xampp\htdocs\projekt\szablonuzytkownika.html");
        $baza = new NormalDatabase();
        
        foreach($baza->getUser() as $daneuzytkownika){
            if(count($daneuzytkownika) < 3){
                continue;
            }
                $rola = Aplikacja::getRoleName($daneuzytkownika["rola"]);
                $wygenerowanyuzytkownik = str_replace('##id##', $daneuzytkownika["id"], $szablon);
		$wygenerowanyuzytkownik = str_replace('##imie##', $daneuzytkownika["imie"], $wygenerowanyuzytkownik);
                $wygenerowanyuzytkownik = str_replace('##rola##', $rola, $wygenerowanyuzytkownik);
                
                echo $wygenerowanyuzytkownik;
                
	}
        
    }
    
    
     
    
}
PanelUzytkownika::wyswietl();
?>

<script>
var assignClickListeners = function() {

        $('.trashbin').click(function () {
            var button = $(this);
            var id = button.data('userId');
            performAjaxRequest(id, button);
            
            

        });

       
    }
    
    var performAjaxRequest = function (id, button) {
        var callback = function (res) {
           
        button.parents(".user-container").hide();
        }; 
        
        $.ajax({
            method: "POST",
            url: "http://localhost/projekt/usunieciuzytkownicy.php",
            data: {id: id}
        }).done(callback);
    };
assignClickListeners();

</script>