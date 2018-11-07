<?php 

require_once('productObject.php');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['product'])){

		if(isset($_SESSION['LOGIN'])){

			if($_SESSION['LOGIN'] == 3){


				$product = new product();

				if($product->deleteProduct($_POST['product']) == false){

					$_SESSION['error'] = 'There was an error making your deletion. Please refresh the page and confirm that the deletion happened.';

					header('Location: ../products.php');

					die();

					

				}else{

					$_SESSION['success'] = 'DELETION SUCCESS';

					header('Location: ../products.php');

					die();

					

				}


			}else{

				$_SESSION['error'] = "I'm sorry you do not have access to this function.";

				header('Location: ../products.php');

				die();

				

			}


		}else{

			$_SESSION['error'] = "Please login :)1";

			header("Location: ../products.php");

			die();

			

		}

			

	}else{

		$_SESSION['error'] = "I'm sorry please select the product that you would like to delete.";

		header('Location: ../products.php');

		die();

		

	}

}else{

	$_SESSION['error'] = "Please log in :)2";

	header('Location: ../products.php');

	die();

	


}

?>