<style>

	body.logo{
		width: 50px;
	}
	.success {
		background: green;
		color:white;
		padding: 15px;
		font-size: 18px;
	}


</style>
<?php
require_once 'layout.php';
require_once 'footer.php';
if (isset($_GET['id']))
{	
	require_once 'baza.php';
	$baza = new NormalDatabase();
	$post = $baza->getNewsById($_GET['id']);
//echo "<div class='success'>Został dodany news</div>";
}
else{
	
	throw new Exception("Nieprawaidłowe żądanie, brakuje id newsa");
}

?>

<!-- I sposob-->
<p>
<?php
echo "<h1>ą$post[1]</h1>";
echo '<br>';
echo "<img src = '$post[2]'>";
echo '<br>';
echo "<p>$post[3]</p>";
echo '<br>';
echo "<p>$post[4]</p>";
echo '<br>';

?>
</p>

<!-- II sposob-->
<?php
/*

echo "<img src = '$post[1]'>";
echo '<img src = "'.$post[1]."\">";*/
?>
