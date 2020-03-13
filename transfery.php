<?php

$pageTitle = 'Najnowsze doniesienia transferowe.';
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once 'PanelNewsow.php';
// jesli string to wypisz
// jesli nie string to wywolaj funkcje __toString()
// jesli nie ma wywolaj nazwe obiektu


PanelNewsow::wyswietl(3);
?>