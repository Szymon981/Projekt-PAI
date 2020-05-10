<script>

</script>

<?php

class PanelNewsow {
    
    public static function wyswietl($typTresci, $paginacja = true) {
        $szablon = file_get_contents("C:\\xampp\htdocs\projekt\szablonnewsa.html");
        require_once "src\backend\baza.php";

        $itemsPerPage = 10;
        $currentPage = 1;
        if (isset($_GET['strona'])) {
            $currentPage = $_GET['strona'];
        }
        $baza = new NormalDatabase();
        $tab = $baza->getNews($typTresci, $currentPage);
        if ($paginacja == true) {
            $counter = $baza->getAllNewsNumber();
            for ($i = 1; $i <= ceil($counter / $itemsPerPage); $i++):
                ?>
                <button onclick = "wyswietlStrone(<?php echo $i ?>)" class = "page-link
                   <?php
                   if ($currentPage == $i) {
                       echo "current-page-link";
                   }
                   ?>
                   " ><?php echo $i ?></button>
                <?php
            endfor;
        }
        echo "<div style = 'clear:both'></div>";
        echo "<div id = 'news-container' class = 'row'>";

        foreach ($tab as $elementyposta) {
            if (count($elementyposta) < 4) {
                continue;
            }
            $zajawkatresci = substr($elementyposta["tresc"], 0, 100);
            $wygenerowanynews = str_replace('##idnewsa##', $elementyposta["id"], $szablon);
            $wygenerowanynews = str_replace('##tytul##', $elementyposta["tytul"], $wygenerowanynews);
            $wygenerowanynews = str_replace('##obrazek##', $elementyposta["obrazek"], $wygenerowanynews);
            $wygenerowanynews = str_replace('##autor##', $elementyposta["autor"], $wygenerowanynews);
            $wygenerowanynews = str_replace('##tresc##', strip_tags($zajawkatresci), $wygenerowanynews);

            echo $wygenerowanynews;
        }
        echo "</div>";
    }

}
