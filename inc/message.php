<?php 

session_start();

$nameRegex = '/^[A-Za-z]{3,16}$/';

$phoneRegex = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';

$emailRegex = '/^[a-zA-Z0-9]+\@{1}[a-zA-Z]+\.[a-z]{2,4}$/';

function testInput($value){
        //Sanitizes strings with trim, strip slashes, and htmlspecial chars.
     
        $MOOSE = $value;
     
        $MOOSE = trim($MOOSE);
        $MOOSE = stripslashes($MOOSE);
        $MOOSE = htmlspecialchars($MOOSE);
        return $MOOSE;
     
    }

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['message'])){

			$sendEmail = TRUE;

			if(preg_match($nameRegex, $_POST['name'])){

				$name = $_POST['name'];

			}else{

				$_SESSION['errormsg'] = "The name you entered was invalid.";

				$sendEmail = false;

			}

			if(preg_match($phoneRegex, $_POST['phone'])){

				$phone = $_POST['phone'];

			}else{

				$_SESSION['errormsg'] = "The phone you entered was invalid.";

				$sendEmail = false;

			}

			if(preg_match($emailRegex, $_POST['email'])){

				$email = $_POST['email'];

			}else{

				$_SESSION['errormsg'] = "The email you entered was invalid.";

				$sendEmail = false;

			}

			$message = testInput($_POST['message']);

			if($sendEmail){

				mail("nelsontrainman946@gmail.com", "You have an email from ".$name, $message." ".$phone);

				header('Location: ../contact.php');

			}else{

				$_SESSION['errormsg']="There was an error with the data you provided.";

				header('Location: ../contact.php');

			}


		}else{

			$_SESSION['errormsg'] = "One of the fields was not filled in.";

			header('Location: ../contact.php');

		}

	}else{

		header('Location: ../contact.php');

	}

?>