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
		$body = htmlspecialchars($dataPHP['body'], ENT_QUOTES);
		
		$blogUp->updateBody($body, $id);	


	}

}


?>