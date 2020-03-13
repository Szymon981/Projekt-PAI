<?php
$pageTitle = 'Najbliższe mecze.';
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';

?>
<?php
class PanelMeczy {
    
    public static function wyswietl() {
        $szablon = file_get_contents("C:\\xampp\\htdocs\\projekt\\src\\views\\szablonmeczu.html");
require_once "src\backend\baza.php";
	$baza = new NormalDatabase();

	
	foreach($baza->getMatch() as $elementyposta){
		if(count($elementyposta) < 5){
			continue;
			
			
		}
			
			$wygenerowanymecz = str_replace('##id##', $elementyposta["id"], $szablon);
			$wygenerowanymecz = str_replace('##druzyna1##', $elementyposta["druzyna1"], $wygenerowanymecz);
			$wygenerowanymecz = str_replace('##druzyna2##', $elementyposta["druzyna2"], $wygenerowanymecz);
			$wygenerowanymecz = str_replace('##data##', $elementyposta["data"], $wygenerowanymecz);
			$wygenerowanymecz = str_replace('##czas##', $elementyposta["czas"], $wygenerowanymecz);
			
			echo $wygenerowanymecz;
	}
	

    }
}
PanelMeczy::wyswietl();
?>

<script>
var assignClickListeners = function() {

        $('.starContainer').click(function () {
            var button = $(this);
            var id = button.data('matchId');
            performAjaxRequest(id, button);
        });

       
    }
    
    var performAjaxRequest = function (id, button) {
        $.ajax({
            method: "GET",
            url: "http://localhost/projekt/ulubioneMecze.php",
            data: {id: id}
        }).done(function (res) {
//            var response = JSON.parse(res);
//            if (response.success) {
//                var score = response.score;
//                $('#score' + id).text(score);
//                button.parent().find('span.minus, span.plus').each(function(index, item){
//                    $(item).hide();
//                });
//            }
            console.log(res);
        });
    };
assignClickListeners();
</script>