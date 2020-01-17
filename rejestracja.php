<?php
$pageTitle = 'Zarejestruj się w serwisie.';
require_once 'layout.php';
$imie = '';
$nazwisko = '';
$login = '';
$haslo = '';
$phaslo = '';
require_once "Aplikacja.php";

if (!empty($_POST)) {
    require_once 'baza.php'; //includuje baza.php
    $baza = new NormalDatabase();
    try {
        $baza->addUser($_POST);
        echo "<div class='success'>Udana rejestracja</div>";
    } catch (Exception $e) {

        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $phaslo = $_POST['phaslo'];
        echo "<div class='error'>" . $e->getMessage() . "</div>";
    }
}
?>

<div id="main-container">
    <form method = 'post'> 
        <div class='news'>
            <h1>Zarejestruj się</h1>
            Imię<input placeholder="Imie" id='imie' name='imie' type='text' value="<?php echo $imie ?>"></input><br>
            Nazwisko<input id='nazwisko' name='nazwisko' type='text' value="<?php echo $nazwisko ?>"></input><br>
            Login<input id='login' name='login' type='text' value="<?php echo $login ?>"></input><br>
            Hasło<input id='haslo' name='haslo' type='password' value='<?php echo $haslo ?>'></input><br>
            Powtórz hasło<input id='phaslo' name='phaslo' type='password' value='<?php echo $phaslo ?>'></input><br>
            Wybór roli<select id="wyborroli" name="wyborroli">
                <option value=="1">Użytkownik</option>
                <option value="2">Redaktor</option>
                <option value="3">Admin</option>

            </select>
            <br>
            <input type='submit' value='Dodaj'></input>
        </div>
    </form>
</div>