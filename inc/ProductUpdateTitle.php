<?php 
require_once 'productObject.php';

$product = new product();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['jsonData'])){

		$product = new product();

		$json = $_POST['jsonData'];


		$dataPHP = json_decode($json, true);

		$id = $dataPHP['id'];
		$title = htmlspecialchars($dataPHP['title'], ENT_QUOTES);
		
		$product->updateName($title, $id);	


	}

}else{

	header('Location: ../products.php');
	die();

}


?>