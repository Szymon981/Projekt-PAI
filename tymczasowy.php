<?php
require_once 'bazaplikowa.php';

$baza = new FileDatabase();
//var_dump($baza->getNews());
$connection = mysqli_connect("localhost", "root", "", "test");
$query = $connection->query("insert into newsy(tytul, obrazek, autor, tresc) values('asd', 'https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x.png', 'Adam Kowalski', 'afhafhafiusaufiahfsfiuhassiufhaufiufhsauihffsufshufasiuf')");
var_dump($query);
