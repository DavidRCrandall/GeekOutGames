<?php
require'blogObjects.php';
require 'pictureObject.php';
require 'blogAndPicDefinitions.php';

session_start();

	if(isset($_SESSION['adminFull'])){

		if($_SESSION['adminFull'] == true){

			if($_SERVER['REQUEST_METHOD'] === 'POST'){

					$targetDir = 'images/';

					$targetFile = $targetDir.basename($_FILES['blogSidePicImg']['name']);

					$uploadOk = 1;

					$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

					$check = getimagesize($_FILES['blogSidePicImg']["tmp_name"]);

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

					if ($_FILES["blogSidePicImg"]["size"] > 750000) {

					    echo "Sorry, your file is too large. Maximum size 750mb";

					    $uploadOk = 0;

					}

					

					// Check if $uploadOk is set to 0 by an error

					if ($uploadOk == 0) {

					    echo "Sorry, your file was not uploaded.";

					// if everything is ok, try to upload file

					} else {

						    $picUpload = new picture();

						    $picDelete = $picUpload->fetchByPage(BlogSideBarPic);

						    foreach($picDelete as $thing){

						    	$picUpload->deletePicture($thing['pictureID']);

						    }

						        $picUpload->createPic(
						        	$_FILES['blogSidePicImg']['tmp_name'], 
						        	$_FILES['blogSidePicImg']['name'], 
						        	$imageFileType, "", BlogSideBarPic);

						        	header("location: ../blog-home-1.php");	
						
					}



			}else{

				echo'error3';

			}

		}else{

			echo'error2';

		}

	}else{

		echo'error1';

	}

 ?>