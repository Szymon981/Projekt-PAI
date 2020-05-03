 <?php

interface DatabaseFacade {
	
	public function getNews();
	
	public function addNews($dane);
	
	public function getNewsById($id);
	
}

?>