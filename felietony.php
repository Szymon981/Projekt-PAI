<?php
	require_once 'layout.php';
        require_once 'footer.php';
        require_once 'PanelNewsow.php';
	// jesli string to wypisz
	// jesli nie string to wywolaj funkcje __toString()
	// jesli nie ma wywolaj nazwe obiektu
        
        PanelNewsow::wyswietl(2);
       
	
?>