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
require_once 'menu.php';
if (isset($_GET['id']))
{	
	require_once 'bazaplikowa.php';
	$baza = new FileDatabase();
	$post = $baza->getNewsById($_GET['id']);
//echo "<div class='success'>Został dodany news</div>";
}


?>

<!-- I sposob-->
<p>
<?php
echo $post[2];
?>
</p>

<!-- II sposob-->
<?php
echo '<p>' . $post[2] . '</p>';
?>
