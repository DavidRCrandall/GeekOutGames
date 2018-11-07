<?php 

require'blogObjects.php';
require 'pictureObject.php';

session_start();

	if(isset($_SESSION['adminFull'])){

		if($_SESSION['adminFull']){


			if($_SERVER['REQUEST_METHOD'] === 'POST'){

				if(isset($_POST['ImageID'])){

					$id = $_POST['ImageID'];

					$picReaper = new picture();

					$picReaper->deletePicture($id);

					header('Location: ../index.php');

				}else{

					echo'id was not passed in';

				}


			}else{

				echo'Method was not correct';

			}
		}
	}

?>