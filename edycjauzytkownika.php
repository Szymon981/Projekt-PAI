<?php
require_once "src/backend/baza.php";
require_once "src/backend/Aplikacja.php";
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
$login = '';
$userId = $_GET['id'];
$haslo = '';
$nhaslo = '';
$phaslo = '';

if(!empty($_POST['login'])){
$baza = new NormalDatabase();
try{
$baza->updateUser($userId, $_POST['login'], $_POST['rola'],$_POST['haslo'], $_POST['nhaslo'], $_POST['phaslo']);
echo "<div class='success'>Udało się zmienić dane logowania.</div>";
} catch(Exception $e){
  $login = $_POST['login'];
$haslo = $_POST['haslo'];
$nhaslo = $_POST['nhaslo'];
$phaslo = $_POST['phaslo'];  
echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
}

}
?>

<div id="main-container">
    <form method = 'post'> 
        <div class='news'>
            <h1 id = "h1">Podaj dane do zmiany</h1>
            <input id='login' name='login' type='text' value="<?php echo $login ?>" placeholder = 'Login'></input><br>
             <input id='haslo' name='haslo' type='password' value='<?php echo $haslo ?>' placeholder = 'Hasło'></input><br>
             <input id='nhaslo' name='nhaslo' type='password' value='<?php echo $nhaslo ?>' placeholder = 'Nowe hasło'></input><br>
             <input id='phaslo' name='phaslo' type='password' value='<?php echo $phaslo ?>' placeholder = 'Powtórz hasło'></input><br>
            Wybór roli<select id="rola" name="rola">
                <option value="1">Użytkownik</option>
                <option value="2">Redaktor</option>
                <option value="3">Admin</option>

            </select>
            <br>
            <input type='submit' value='Zmień'></input>
        </div>
    </form>
</div>



