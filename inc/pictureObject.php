<?php
class picture{

//This function creates a new picture row in the database and stores the picture on the server
function createPic($tmpName, $name, $type, $description, $page){
	include "var.php";
	if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "page must be a valid integer";
			}
		}

	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	$location = "..\\".$folder."\\".$name;
	move_uploaded_file($tmpName, $location);

	$name1 = mysqli_real_escape_string($conn, $name);
	$location1 = mysqli_real_escape_string($conn, $folder); 
	$decription1 = mysqli_real_escape_string($conn, $description);
	$page1 = mysqli_real_escape_string($conn, $page);
	
			$query = "INSERT INTO picture(pictureTitle,pictureLocation,pictureDescription,picturePage)VALUES('$name1','$location1','$decription1',$page1)";
			$results = $conn->query($query);

			/*
			$stmt=$conn->prepare("INSERT INTO picture(pictureTitle,pictureLocation,pictureDescription,picturePage)VALUES(?,?,?,0)");
			$stmt->bind_param( "sss", $newTitle, $newLocation, $newDescription);
			$newTitle = $name;
			$newLocation = $folder;
			$newDecription = $description;
			$newPage = $page;
			$stmt->execute();
			$stmt->close();
			$conn->close();
			*/
			$conn->close();
}

//This fuction changes the page association of a picture
function setPage($page, $id){
	include "var.php";
	if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
	if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	$stmt =$conn->prepare("UPDATE picture SET picturePage=? WHERE pictureID=$id");
	$stmt->bind_param("i", $newPage);

	$newPage = mysqli_real_escape_string($conn, $page);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

//This function deltes a picture and removes from the server
function deletePicture($id){
	include "var.php";
	if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);

	$query = "SELECT * FROM picture WHERE pictureID=$id";
	$results = $conn->query($query);

	$rows = $results->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $row){
		$remove = "..\\".$row['pictureLocation']."\\".$row['pictureTitle'];
		unlink($remove);
	}

	$query = "DELETE FROM picture WHERE pictureID='$id'";
	$results = $conn->query($query);
	$conn->close();
}

//This function updates the photo description
function updateDescription($description, $id){
	
	include "var.php";
	if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);

	$stmt =$conn->prepare("UPDATE picture SET pictureDescription=? WHERE pictureID=$id");
	$stmt->bind_param("s", $newDescription);

	$newDescription = mysqli_real_escape_string($conn, $description);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}

//This function will return an associtative array contianing all of the infromation about about a picture on a certian page
function fetchByPage($page){
	include "var.php";
	if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
	$query ="SELECT * FROM picture WHERE picturePage=$page";
	$results = $conn->query($query);
	$return = $results->fetch_all(MYSQLI_ASSOC);
	$conn->close();
	return $return;			
}

//This function will return an associtative array contianing all of the infromation about about all pictures in the table
function fetchAll(){
	include "var.php";
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
	$query ="SELECT * FROM picture";
	$results = $conn->query($query);
	$return = $results->fetch_all(MYSQLI_ASSOC);
	$conn->close();
	return $return;
}

//This function returns an array storing only a pictures location for all pictures in the table
function fetchAllLocation(){
	include "var.php";
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	$num = 0;
	$return = array();
	
	$query ="SELECT * FROM picture";
	$results = $conn->query($query);
	$rows = $results->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $row){
		$return[$num] = $row['pictureLocation']."\\".$row['pictureTitle'];
		$num++;
	}
	return $return;

}

//This function returns an array storing only a pictures location for all pictures associated with a certian page
function fetchByPageLocation($page){
	include "var.php";
	if(!$page == 0){
			if (filter_var($page, FILTER_VALIDATE_INT) == false){
	    		return "Page must be a valid integer";
			}
		}
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	$num = 0;
	$return = array();
	
	$query ="SELECT * FROM picture WHERE picturePage=$page";
	$results = $conn->query($query);
	$rows = $results->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $row){
		$return[$num] = $row['pictureLocation']."/".$row['pictureTitle'];
		$num++;
	}
	return $return;
}
}

?>