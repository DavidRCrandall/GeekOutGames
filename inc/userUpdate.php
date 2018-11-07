<?php 

require_once 'loginObject.php';
require_once 'blogAndPicDefinitions.php';

function testInput($value){
        //Sanitizes strings with trim, strip slashes, and htmlspecial chars.
     
        $MOOSE = $value;
     
        $MOOSE = trim($MOOSE);
        $MOOSE = stripslashes($MOOSE);
        $MOOSE = htmlspecialchars($MOOSE);
        return $MOOSE;
     
    }

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_SESSION['LOGIN'])){

		if(isset($_SESSION['USER'])){

			$userID = $_SESSION['USER'];

				if(isset($_POST['userFirst']) && isset($_POST['userLast']) && isset($_POST['userPhone']) && isset($_POST['userEmail'])){


					$first = testInput($_POST['userFirst']);

					$last = testInput($_POST['userLast']);

					 $phoneRegex = '/^1?[\s-]?\(?(\d{3})\)?[\s-]?\d{3}[\s-]?\d{4}$/';

					 $emailRegex = '/^[a-zA-Z0-9]+\@{1}[a-zA-Z]+\.[a-z]{2,4}\.?[a-z]{0,4}$/';

					 $update = TRUE;

			    	if(isset($_POST['page'])){


			    		if(preg_match($phoneRegex, $_POST['userPhone'])){

			    			$phone = $_POST['userPhone'];

			    		}else{

			    			$_SESSION['error'] = $_SESSION['error']."The Phone number that you provided was in the wrong format. Use the following 123-456-7890";

			    			$update = false;

			    			header('Location: ../profile.php');

			    			die();

			    		}

			    		if(preg_match($emailRegex, $_POST['userEmail'])){

			    			$email = $_POST['userEmail'];

			    		}else{

			    			$_SESSION['error'] = $_SESSION['error']."The Email that you provided was in the wrong format. Use the following youremailhere@email.com";

			    			$update = false;

			    			header('Location: ../profile.php');

			    			die();

			    		}

			    		if($update){

				    		$user = new user();

				    		$user->updateFirst($first, $userID);

				    		$user->updateLast($last, $userID);

				    		$user->updatePhone($phone, $userID);

				    		$user->updateEmail($email, $userID);



				    		header('Location: '.$_POST['page']);

				    		die();

				    	}


			    	}else{


			    		if(preg_match($phoneRegex, $_POST['userPhone'])){

			    			$phone = $_POST['userPhone'];

			    		}else{

			    			$_SESSION['error'] = $_SESSION['error']."The Phone number that you provided was in the wrong format. Use the following 123-456-7890";

			    			$update = false;

			    			header('Location: ../profile.php');

			    			die();

			    		}

			    		if(preg_match($emailRegex, $_POST['userEmail'])){

			    			$email = $_POST['userEmail'];

			    		}else{

			    			$_SESSION['error'] = $_SESSION['error']."The Email that you provided was in the wrong format. Use the following youremailhere@email.com";

			    			$update = false;

			    			header('Location: ../profile.php');

			    			die();

			    		}

			    		if($update){

				    		$user = new user();

				    		$user->updateFirst($first, $userID);

				    		$user->updateLast($last, $userID);

				    		$user->updatePhone($phone, $userID);

				    		$user->updateEmail($email, $userID);

				    		header('Location: ../profile.php');

				    		die();

				    	}

			    	}

			    }else{

			    	$_SESSION['error'] = $_SESSION['error']."One of your fields was blank.";

			    	header('Location ../profile.php');

			    	die();

			    }

			}else{

				$_SESSION['error'] = $_SESSION['error']."Please Login :)";

			    	header('Location ../index.php');

			    	die();

			}

		}else{

			$_SESSION['error'] = $_SESSION['error']."Please Login :)";

			    	header('Location ../index.php');

			    	die();

		}


	}else{

			    	header('Location ../index.php');

			    	die();

	}

?>