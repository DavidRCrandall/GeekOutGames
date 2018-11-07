<?php

require 'inc/nav.php';
require'inc/blogObjects.php';
require 'inc/pictureObject.php';
require 'inc/blogAndPicDefinitions.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		if(isset($_POST['username']) && isset($_POST['password'])){
		    if(!empty($_POST['username']) && !empty($_POST['username'])){

		    	if(isset($_POST['page'])){

			    	$login = new User();
			        $username = $_POST['username'];
			        $password = $_POST['password'];
			        $login->login($username,$password);



			        header('Location: '.$_POST['page']);

			    }else{

			    	$login = new User();
			        $username = $_POST['username'];
			        $password = $_POST['password'];
			        $login->login($username,$password);



			        header('Location: index.php');

			    }
		    }
		}else if(isset($_POST['signout'])){

			if(isset($_POST['page'])){

				$login = new User();
			    $login->logout();

			    header('Location: '.$_POST['page']);

			}else{

				header('Location: index.php');

			}

		}

	}else{

		header('Location: index.php');

	}


?>