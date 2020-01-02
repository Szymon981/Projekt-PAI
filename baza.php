<?php 
require_once "interfejs.php";
class NormalDatabase implements DatabaseFacade{
	public function getNews()
	{
		$connection = mysqli_connect("localhost", "root", "", "test");
	$query = $connection->query("select * from newsy");
	$result = [];
	while ($row = $query->fetch_array(MYSQLI_NUM)){
		$result[] = $row;
	}

	return $result;
}
	
	
	public function addNews($dane){}
	
	public function getNewsById($id){}
	
}



?>