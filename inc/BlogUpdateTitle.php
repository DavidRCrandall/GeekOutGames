<?php 

require_once"blogObjects.php";
require_once"pictureObject.php";
require_once"var.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['jsonData'])){

		$blogUp = new blog();

		$json = $_POST['jsonData'];


		$dataPHP = json_decode($json, true);

		$id = $dataPHP['id'];
		$title = htmlspecialchars($dataPHP['title'], ENT_QUOTES);
		
		$blogUp->updateTitle($title, $id);	

		echo"ID:".$id."     Title:".$title;


	}

}


?>