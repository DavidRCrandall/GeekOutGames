<?php 

require("blogObjects.php");
require("pictureObject.php");
require("var.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['jsonData'])){

		$blogUp = new blog();

		$json = $_POST['jsonData'];


		$dataPHP = json_decode($json, true);

		$id = $dataPHP['id'];
		
		
		$blogUp->deleteByID($id);	

		echo"Blog:".$id." Deleted";
	}

}


?>