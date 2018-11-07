<?php 

require_once 'loginObject.php';
require_once 'blogAndPicDefinitions.php';

$login = new user();

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['oldPass']) && isset($_POST['newPass1']) && isset($_POST['newPass2'])){

		if(isset($_SESSION['USER'])){

			$user = array();

			$user = $login->fetchSingle($_SESSION['USER']);

			foreach($user as $thing){

				$userName = $thing['userName'];

			}

			if($login->login($userName, $_POST['oldPass'])){

				if($_POST['newPass1'] == $_POST['newPass2']){


					$login->updatePassword($_POST['newPass2'], $_SESSION['USER']);

					header('Location: ../profile.php');
					die();

				}else{


					$_SESSION['error'] = "Your new passwords did not match.";

					header('Location: ../profile.php');

					die();

				}

			}else{

				$_SESSION['error'] = "Your old password was inccorect.";

				header('Location: ../profile.php');
				die();

			}

		}

	}

}

?>