<?php 

require_once 'loginObject.php';
require_once 'nav.php';
require_once 'blogAndPicDefinitions.php';

function testInput($value){
        //Sanitizes strings with trim, strip slashes, and htmlspecial chars.
     
        $MOOSE = $value;
     
        $MOOSE = trim($MOOSE);
        $MOOSE = stripslashes($MOOSE);
        $MOOSE = htmlspecialchars($MOOSE);
        return $MOOSE;
     
    }

$login = new user();

//$login->signUp('test4', "password",'111-111-1111', 'emailhere@email.com', 'tester', 'test', 'what is one plus one', 'two', 1);

//Delete vanilla user account
if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_SESSION['USER'])){

		if(isset($_SESSION['LOGIN'])){

			if(isset($_POST['userName']) && isset($_POST['password'])){

				$userName = testInput($_POST['userName']);

				$password = $_POST['password'];

				$loggedInUser = array();
				$deleteUser = array();

				array_push($loggedInUser, $login->fetchSingle($_SESSION['USER']));

				if($login->login($userName, $password)){

					array_push($deleteUser, $login->fetchSingle($_SESSION['USER']));

					foreach($deleteUser as $thing){

						$userID = $thing[0]['userID'];

					}

					foreach($loggedInUser as $thing){

						$loggedPerm = $thing[0]['userPermissions'];

						$loggedID = $thing[0]['userID'];

					}

					if($userID == $loggedID){

						if($loggedPerm == 3){

							$_SESSION['error'] = "You cannot delete that account.";

						}else{

							$login->deleteUser($loggedID);

							session_destroy();

							header('Location: ../index.php');

							die();

						}

					}

				}else{

					$_SESSION['error'] = $_SESSION['error']."Please enter the correct credentials";

					header('Location: ../profile.php');

					die();

				}


			}else if($_POST['adminChoice']){

				if($_SESSION['LOGIN'] == 3){

					$userName = testInput($_POST['adminChoice']);

					$login->deleteUserByName($userName);

					header('Location: userDelete.php');

					die();

				}else{

					header('Location: ../index.php');

					die();

				}


			}else{

				$_SESSION['error'] = $_SESSION['error']."Please enter a username and password whenever you wish to delete your account.";

				header('Location: ../profile.php');

				die();

			}

		}else{

			header('Location: ../index.php');
			die();

		}

	}else{

		header('Location: ../index.php');
		die();

	}

}else if(isset($_SESSION['LOGIN'])){

			if(isset($_SESSION['USER'])){

				if($_SESSION['LOGIN'] == 3){

					$adminPopulate = TRUE;

				}else{

					$adminPopulate = FALSE;

					$userID = $_SESSION['USER'];

				}		

			}else{

				$_SESSION['error'] = $_SESSION['error']."Please Login :)";

				$login->logout();

				    header('Location ../index.php');
				    die();

			}



		}else{


		$_SESSION['error'] = $_SESSION['error']."Please Login :)";

		$login->logout();

	    header('Location ../index.php');
	    die();


		}

	


?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Geek Out Games</title>

    <script src="../js/jquery.js"></script>

    <!-- Summernote JS -->
    <script src="../js\summernote\dist\summernote.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/modern-business.css" type="text/css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="../js/bootstrap.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="../images/GOG_Logo_BWG.jpg">
</head>
<body>

<?php
	
	if($adminPopulate){


		echo'<div class="container bg-default">
				<div class="alert alert-danger">
					
					<h1>ATTENTION:</h1><strong>If you Delete an account all of its information will be lost.</strong>

				</div>

				<div class="well text-center">
					
				<p>In order to delete a user account, all you have to do is click the name.</p>

				</div>

				<div class="form-group">';

				$users = array();

				$users = $login->fetchAll();

				foreach($users as $thing){

					echo'<form action="userDelete.php" method="post">

						<input type="submit" name="adminChoice" class="form-control btn-danger" value="'.$thing['userName'].'">

					</form><hr>';

				}

				echo'</div>

				<a class="btn btn-block btn-primary" href="../profile.php">Back to the Profile Page</a>

			</div>';


	}else{

		echo'<div class="container bg-default">
				<div class="alert alert-danger">
					
					<h1>ATTENTION:</h1><strong>If you Delete your account all of your information will be lost.</strong>

				</div>

				<div class="well text-center">
					
				<p>If you are 100% sure that you would like to delete your account, then enter your login information below and press the delete account button.</p>

				</div>

				<div class="form-group">

					<form action="userDelete.php" method="post">
					
						<input type="text" name="userName" class="form-control" placeholder="User Name"><br>

						<input type="password" name="password" class="form-control" placeholder="password"><br>

						<input type="submit" class="form-control btn-danger" value="DELETE">

					</form>

				</div>

				<a class="btn btn-block btn-primary" href="../profile.php">Back to the Profile Page</a>

			</div>';

		}

	?>



</body>
</html>