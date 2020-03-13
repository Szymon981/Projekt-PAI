<?php
$pageTitle = 'Zarejestruj się w serwisie.';
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once "src\backend\Aplikacja.php";
$imie = '';
$nazwisko = '';
$login = '';
$haslo = '';
$phaslo = '';

if (!empty($_POST)) {
    require_once "src\backend\baza.php";
    $baza = new NormalDatabase();
    try {
        $baza->addUser($_POST);
//        echo "<div class='success'>Udana rejestracja</div>";
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
            <h1 id = "h1">Zarejestruj się</h1>
            <input placeholder="Imie" id='imie' name='imie' type='text' value="<?php echo $imie ?>" placeholder = 'Imię'></input><br>
            <input id='nazwisko' name='nazwisko' type='text' value="<?php echo $nazwisko ?>" placeholder = 'Nazwisko'></input><br>
            <input id='login' name='login' type='text' value="<?php echo $login ?>" placeholder = 'Login'></input><br>
            <input id='haslo' name='haslo' type='password' value='<?php echo $haslo ?>' placeholder = 'Hasło'></input><br>
            <input id='phaslo' name='phaslo' type='password' value='<?php echo $phaslo ?>' placeholder = 'Powtórz hasło'></input><br>
            Wybór roli<select id="rola" name="rola">
                <option value=="1">Użytkownik</option>
                <option value="2">Redaktor</option>
                <option value="3">Admin</option>

            </select>
            <br>
            <input type='submit' value='Dodaj'></input>
        </div>
    </form>
</div>