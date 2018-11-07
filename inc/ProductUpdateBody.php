<?php 
require_once 'productObject.php';

$product = new product();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['jsonData'])){

		$product = new product();

		$json = $_POST['jsonData'];


		$dataPHP = json_decode($json, true);

		$id = $dataPHP['id'];
		$body = htmlspecialchars($dataPHP['body'], ENT_QUOTES);
		
		$product->updateDescription($body, $id);	


	}

}else{

	header('Location: ../products.php');
	die();

}


?>