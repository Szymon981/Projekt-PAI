<?php

require_once "interfejs.php";
require_once "Aplikacja.php";

class NormalDatabase implements DatabaseFacade {

    private $conncection;

    public function __construct() {
        $this->connection = mysqli_connect("localhost", "root", "", "test");
    }

    public function getNews($type = 1) {
        $query = $this->connection->query("select id, tytul, obrazek, autor, tresc, typ from newsy where typ = $type");
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getNewsById($id) {
        $query = $this->connection->query("select * from newsy where id=$id");

        $news = self::getFirstResult($query);
        if (!$news) {
            throw new Exception("Nie znaleziono newsa");
        }
        
        return $news;
    }

    public function addNews($dane) {
        if (empty($dane['tytul']) || empty($dane['obrazek']) || empty($dane['autor']) || empty($dane['tresc'])) {
            return false;
        }

        $query = $this->connection->query("insert into newsy(tytul, obrazek, autor, tresc, typ) values('" . 
                $dane['tytul'] . "', '" . $dane['obrazek'] . "', '" . 
                $dane['autor'] . "', '" . $dane['tresc'] . "','" . $dane['wybortresci']."')");
        return $query;
    }

    public function addUser($dane) {
        if (empty($dane['imie']) || empty($dane['nazwisko']) || empty($dane['login']) || empty($dane['haslo'])) {
            throw new Exception('WYpelnij wszystkie pola');
        }
        if ($dane['haslo'] !== $dane['phaslo']) {
            throw new Exception('Hasla nie sa takie same');
        }
        $encPassword = Aplikacja::encodePassword($dane['haslo']);


        $query = $this->connection->query("insert into uzytkownicy(imie, nazwisko, login, haslo, rola) values('" .
                $dane['imie'] . "', '" .
                $dane['nazwisko'] . "', '" .
                $dane['login'] . "', '" .
                $encPassword . "', '" .
                $dane['rola']
                . "')");
        return $query;
    }

    public function getUserByLoginandPassword($login, $password) {

        $query = $this->connection->query("SELECT * FROM `uzytkownicy` WHERE login='$login' and haslo='$password'");
        return self::getFirstResult($query);
    }

    private static function getFirstResult($query) {
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
            return $row;
        }
    }

}

?>