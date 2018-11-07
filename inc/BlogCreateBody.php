<?php 
require_once('../inc/var.php');
require_once('../inc/blogObjects.php');
require_once('../inc/blogAndPicDefinitions.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['jsonData'])){

		$blogUp = new blog();

		$json = $_POST['jsonData'];


		$dataPHP = json_decode($json, true);

		$title = htmlspecialchars($dataPHP['title'], ENT_QUOTES);
		$body = htmlspecialchars($dataPHP['body'], ENT_QUOTES);
		
		$blogUp->create($title, $body, Blog);	


	}

}


?>