<?php
require_once 'C:\\xampp\htdocs\projekt\src\views\layout.php';
require_once 'C:\\xampp\htdocs\projekt\src\views\footer.php';
require_once 'src\backend\Aplikacja.php';
require_once 'Parser.php';
?>
<script>
function parsing(){
    window.location.href = ' http://localhost/projekt/paneladmina.php';
}
</script>


<input type="submit" onclick="parsing()" value="Parsuj"></input>


