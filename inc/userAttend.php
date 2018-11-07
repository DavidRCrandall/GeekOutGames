<?php 

require_once 'loginObject.php';
require_once 'fourmsObject.php';
$fourm = new fourm;
if(isset($_SESSION['USER']) && isset($_POST['id'])){
	if($fourm->userCreate($_SESSION['USER'], 1, $_POST['id'])){
		$_SESSION['ATTEND']  = "You are now attending the event";
		header('Location: ..\\events.php');
		}else{
		$_SESSION['ATTEND']  = "You are already attending this event";
		header('Location: ..\\events.php');
		}
	}
else{
	$_SESSION['ATTEND']  = "There was a problem signing up please try agaian";
	header('Location: ..\\events.php');
}


?>