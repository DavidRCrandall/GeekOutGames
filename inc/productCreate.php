<?php 
require_once('loginObject.php');
require_once('productObject.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == 3){

		if(isset($_POST['productName']) && isset($_POST['productDescription'])){

			$imageUploadErrors = '';

			$target_dir = "../images/";
			$target_file = $target_dir . basename($_FILES["newProductImage"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submitNewProduct"])) {
				$check = getimagesize($_FILES["newProductImage"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				 $imageUploadErrors = $imageUploadErrors."Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["newProductImage"]["size"] > 750000) {
				$imageUploadErrors = $imageUploadErrors."Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				$imageUploadErrors = $imageUploadErrors."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$imageUploadErrors = $imageUploadErrors."Sorry, your file was not uploaded.";

			$_SESSION['error'] = $imageUploadErrors;

			header('Location: ../products.php');

			die();
		// if everything is ok, try to upload file
		} else {

			$product = new product();

			if($product->createProduct($_POST['productName'], $_POST['productDescription'], $_FILES["newProductImage"]["name"], $_FILES["newProductImage"]["tmp_name"])){

				$_SESSION['success'] = 'Creation of product '. $_POST['productName'] . ' successful.';

				header('Location: ../products.php');

				die();


			}else{

				$_SESSION['error'] = 'Please make sure that your hosting service is not experiencing any interuptions.';

				header('Location: ../products.php');

				die();

			}


		}

	}else{

		$_SESSION['error'] = 'Please make sure you fill in all the fields and choose an image.';

		header('Location: ../products.php');

		die();

	}


}else{

	$_SESSION['error'] = 'Please login :)2';

	header("Location: ../products.php");

	die();



}


}else{

	$_SESSION['error'] = 'Please login :)1';

	header("Location: ../products.php");

	die();

}


?>