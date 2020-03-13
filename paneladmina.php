<?php

require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once 'src\backend\Aplikacja.php';
require_once 'Parser.php';

if(!Aplikacja::isAdmin()){
    throw new Exception("Nie masz dostępu do tej strony");
}

$curl = curl_init('https://www.przegladsportowy.pl/pilka-nozna');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$pageHtml = curl_exec($curl);
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($pageHtml);
$xpath = new DOMXPath($doc);
$articles = $xpath->query('//div[@class="listItem listItemSolr itarticle"]');
var_dump($articles->length);
foreach($articles as $article){
    $divWithContent = PrzegladSportowyParser::getDivWithContent($article);
    $content = '';
    if($divWithContent != null){
        $content = $divWithContent->nodeValue;
    }
    
    $title = $article->getElementsByTagName('h3')[0]->nodeValue;
    require_once 'src\backend\baza.php';	
	$baza = new NormalDatabase();
	var_dump($baza->addNews([
            "tytul" => $title, 
            "obrazek" => "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png",
            "autor" => "Robot parsujacy",
            "tresc" => $content,
            "wybortresci" => 1,
        ]));
}





