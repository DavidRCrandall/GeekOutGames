<?php
require'blogObjects.php';
require 'pictureObject.php';

session_start();

	if(isset($_SESSION['adminFull'])){

		if($_SESSION['adminFull']){

			if($_SERVER['REQUEST_METHOD'] === 'POST'){

					$targetDir = 'images/';

					$targetFile = $targetDir.basename($_FILES["newCarImg"]['name']);

					$uploadOk = 1;

					$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

					$check = getimagesize($_FILES["newCarImg"]["tmp_name"]);

					if($check !== false){

						echo "File is an image - ". $check['mime'] . ".";
						$uploadOk = 1;

					}else{

						echo "File is not an image";
						$uploadOk = 0;

					}

					if(file_exists($targetFile)){

						echo "Sorry, That file already exists";
						$uploadOk = 0;

					}

					// Check file size

					if ($_FILES["fileToUpload"]["size"] > 750000) {

					    echo "Sorry, your file is too large. Maximum size 750mb";

					    $uploadOk = 0;

					}

					// Allow certain file formats

					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

					&& $imageFileType != "gif" ) {

					    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

					    $uploadOk = 0;

					}

					// Check if $uploadOk is set to 0 by an error

					if ($uploadOk == 0) {

					    echo "Sorry, your file was not uploaded.";

					// if everything is ok, try to upload file

					} else {

						    $picUpload = new picture();

						        $picUpload->createPic(
						        	$_FILES['newCarImg']['tmp_name'], 
						        	$_FILES["newCarImg"]['name'], 
						        	$imageFileType, "", 2);

						        	header("location: ../index.php");	
						
					}



			}

		}

	}

 ?>