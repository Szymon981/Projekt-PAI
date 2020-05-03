<script>



function wyswietlStrone(strona){
        
        $.ajax({
            method: "GET",
            url: "http://localhost/projekt/newsyajax.php?strona="+strona,
            })
        .success(function(res){
            $("#news-container .news").remove();
            $("#news-container").html(res);
            });
       
        };
</script>
<?php
        $pageTitle = 'Strona główna.';
	require_once 'src\views\layout.php';
        require_once 'src\views\footer.php';
        require_once 'PanelNewsow.php';
	// jesli string to wypisz
	// jesli nie string to wywolaj funkcje __toString()
	// jesli nie ma wywolaj nazwe obiektu

	PanelNewsow::wyswietl(1);
	

?>