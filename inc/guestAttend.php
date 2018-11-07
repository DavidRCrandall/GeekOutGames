<?php 

require_once 'loginObject.php';
require_once 'fourmsObject.php';
$fourm = new fourm;
if(isset($_POST['Push'])){
	if($_POST['Push'] == 'true')
		{
			$push = 1;
		}
		else
		{
			$push = 0;
		}
}
else
{
	$push = 0;
}

if (isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Email'])){
	$fourm->createFourm($_POST['FirstName'], $_POST['LastName'], $_POST['Email'], $_POST['Phone'], $push, $_POST['id'], 0);
	$_SESSION['ATTEND']  = "You are now attending the event";
	header('Location: ..\\events.php');
}
else
{
	$_SESSION['ATTEND']  = "There was a problem signing up please try again";
	header('Location: ..\\events.php');
}


?>