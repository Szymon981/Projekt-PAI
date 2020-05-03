<?php

require_once "interfejs.php";
require_once __DIR__ . "\Aplikacja.php";

class NormalDatabase implements DatabaseFacade {

    private $conncection;

    public function __construct() {
        $this->connection = mysqli_connect("localhost", "root", "", "test");
    }

    public function getNews($type = 1, $page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $query = $this->connection->query("select id, tytul, obrazek, autor, tresc, typ from newsy where typ = $type limit $limit offset $offset");
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
    
    public function getAllNewsNumber(){
        $query = $this->connection->query("select count(*) as counter from newsy where typ = 1");
        return $query->fetch_array(MYSQLI_ASSOC)["counter"];
    }
    
    public function getMatch(){
        $query = $this->connection->query("select id, druzyna1, druzyna2, data, czas from mecze");
        $result = [];
        while($row = $query->fetch_array(MYSQLI_ASSOC)){
           $result[] = $row; 
        }
        return $result;
    }
    
    
    public function getCommentByNewsId($id){
        $query = $this->connection->query("select id, user_name, content, plusy, minusy, wynik, created from komentarze where news_id = $id");
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            $result[] = $row;
            
        }
        return $result;
    }
    
    public function updateCommentScoreById($id, $akcja){
        if($akcja === 1){
            $query = $this->connection->query("update komentarze set plusy = plusy + 1 where id = $id");   
        }
        else if($akcja === -1){
            $query = $this->connection->query("update komentarze set minusy = minusy - 1 where id = $id");
        }
        else{
            throw new Exception("Coś poszło nie tak");
        }
        $query = $this->connection->query("select plusy, minusy from komentarze where id = $id");
        $result = 0;
        while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            $result =  (int)$row['plusy'] + (int)$row['minusy'];
            
        }
        
        $query = $this->connection->query("update komentarze set wynik = $result where id = $id");
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
    public function getUser(){
        $query = $this->connection->query("select id, imie, rola from uzytkownicy");
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            $result[] = $row;
            
        }
        return $result;
    }

        public function addNews($dane) {
        if (empty($dane['tytul']) || empty($dane['obrazek']) || empty($dane['autor']) || empty($dane['tresc'])) {
            return false;
        }
$queryAsString = "insert into newsy(tytul, obrazek, autor, tresc, typ) values('" . 
                $dane['tytul'] . "', '" . $dane['obrazek'] . "', '" . 
                $dane['autor'] . "', '" . $dane['tresc'] . "','" . $dane['wybortresci']."')";
        $query = $this->connection->query($queryAsString);
        return $query;
    }
    
        public function addMatch($dane){
            if(empty($dane['druzyna1']) || empty($dane['druzyna2']) || empty($dane['data']) || empty($dane['czas'])){
                return false;
            }
            $queryAsString = "insert into mecze(druzyna1, druzyna2, data, czas) values('".
                $dane['druzyna1'] . "', '" . $dane['druzyna2'] . "', '" . 
                $dane['data'] . "', '" . $dane['czas'] ."')";
            $query = $this->connection->query($queryAsString);
            return $query;
            
        }

    public function addUser($dane) {
        if (empty($dane['imie']) || empty($dane['nazwisko']) || empty($dane['login']) || empty($dane['haslo'])) {
            throw new Exception('Wypelnij wszystkie pola');
        }
        
        if(!$this->validatePasswordStrenght($dane['haslo'])){
            throw new Exception('Zbyt słabe hasło. Minimum 5 znaków, 1 cyfra, 1 duża litera.');
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
        Aplikacja::setFlashMessage("Udana rejestracja");
        return $query;
    }
    
    public function updateUser($userId, $login, $role,$oldPassword, $newPassword, $newPassword2){
        
        if(!$this->validatePasswordStrenght($newPassword)){
            throw new Exception('Zbyt słabe hasło. Minimum 5 znaków, 1 cyfra, 1 duża litera.');
        }
        
        if ($newPassword !== $newPassword2) {
            throw new Exception('Hasla nie sa takie same');
        }
        $epassword = Aplikacja::encodePassword($newPassword);
        
        
        if(!Aplikacja::verifyPassword($userId, $oldPassword)){
        
            throw new Exception("Podane haslo nie jest prawidlowe");
        
        }
        var_dump($this->connection->query("update uzytkownicy set login = '$login', rola = $role, haslo = '$epassword' where id = $userId"));
    }
   
    
    private function validatePasswordStrenght($password){
        if(strlen($password) < 4){
            return false;
        }
        if($password === strtolower($password)){
            return false;
        }
        
        if(preg_match('/\d/', $password) === 0){
            return false;
        }
        return true;
    }

    public function getUserByLoginandPassword($login, $password) {

        $query = $this->connection->query("SELECT * FROM `uzytkownicy` WHERE login='$login' and haslo='$password'");
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            return $row;
        }
    }
    
    public function getUserByIdandPassword($id, $password) {

        $query = $this->connection->query("SELECT * FROM `uzytkownicy` WHERE id=$id and haslo='$password'");
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            return $row;
        }
    }

    private static function getFirstResult($query) {
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
            return $row;
        }
    }
    
    public function addComment($idNewsa, $dane){
         
        if(Aplikacja::isLogged()){
            $dane['autor'] = Aplikacja::getUsername();
        }
        
        if(empty($dane['tresc'] || empty($dane['autor']))){
            return false;
        }
        
        $queryAsString = 'insert into komentarze(content, user_name, news_id) values("' .
                $dane['tresc'] . '", "'. $dane['autor']. '" , "'.$idNewsa.'")';
        $query = $this->connection->query($queryAsString);
           
        return $query;
    }
    
    public function getMaxCommentId() {
        $queryAsString = 'select max(id) as maxId from komentarze';
        return $this->connection->query($queryAsString)->fetch_array(MYSQLI_ASSOC)['maxId'];
    }
    
    public function getCommentById($id){
        $query = $this->connection->query("select id, user_name, content, plusy, minusy, wynik, created from komentarze where id = $id");
        return $query->fetch_array(MYSQLI_ASSOC);
    }
    
    public function addFavourite($matchId, $userId){
        $this->connection->query("insert into ulubione (id_uzytkownika, id_meczu) values($userId, $matchId)");
    }
    
    public function deleteUser($userId){
        $this->connection->query("delete from uzytkownicy where id = $userId");
    }
    
    public function createQuiz($name, $structure, $description, $level, $questionNumber){
            
        $this->connection->query("insert into quiz (name, structure, description, level, questions_number) values('$name', '$structure','$description', $level, $questionNumber)");
    }
    
    public function getQuiz(){
        $this->conncection->query("select * from 'quiz'");
    }
    
    public function getQuizes(){
        $query = $this->connection->query("select id, name, level, questions_number from quiz");
        
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            $result[] = $row;
            
        }
        return $result;
    
    }
    
    public function getQuizById($id){
        $query = $this->connection->query("select name, structure from quiz where id = $id");
       
        while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            return $row;
        }
        throw new Exception("Nie ma takiego quizu");
    }
    
    public function getQuizByName($name){
        $query = $this->connection->query("select id, structure from quiz where name = '$name'");
        
         while ($row = $query->fetch_array(MYSQLI_ASSOC)){
            return $row;
        }
        throw new Exception("Nie ma takiego quizu");
    }
    
    public function saveQuizScore($quizId, $userId, $score){
        if($userId == null){
            $userId = "NULL";
        }
        $query = $this->connection->query("insert into wynik_quizu (quiz_id, user_id, score) values ($quizId, $userId, $score)");
        
    }

}
?>