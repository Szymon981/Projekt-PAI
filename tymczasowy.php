<?php
require_once 'bazaplikowa.php';

$baza = new FileDatabase();
//var_dump($baza->getNews());
$connection = mysqli_connect("localhost", "root", "", "test");
$query = $connection->query("select * from newsy");
var_dump($query->fetch_array(MYSQLI_NUM)); 
