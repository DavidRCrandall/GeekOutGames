<?php

class product {

	function createProduct($name, $description, $picName, $tmpName){
		include "var.php";
			$location = "..\\".$folder."\\".$picName;
			move_uploaded_file($tmpName, $location);
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			$query ="SELECT productName FROM product";
			$results = $conn->query($query);
			$rows = $results->fetch_all(MYSQLI_ASSOC);
				foreach($rows as $row){
					if($name == $row["productName"]){
						return "name already taken";
				}
			}
	
			$stmt =$conn->prepare("INSERT INTO product (productName, productDescription, productLogo, productFolder) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss", $newName, $newDescription, $newLogo, $newFolder);

			$newName = mysqli_real_escape_string($conn, $name);
			$newDescription =mysqli_real_escape_string($conn, $description);
			$newLogo =mysqli_real_escape_string($conn, $picName);
			$newFolder =mysqli_real_escape_string($conn, $folder);

			$stmt->execute();
			$stmt->close();
			$conn->close();
	}

	function deleteProduct($id){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "DELETE FROM product WHERE productID='$id'";
			$results = $conn->query($query);
			$conn->close();
	}
	function updateProduct($name, $description, $id){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			$query ="SELECT productName FROM product";
			$results = $conn->query($query);
			$rows = $results->fetch_all(MYSQLI_ASSOC);
				foreach($rows as $row){
					if($name == $row["productName"]){
						return "name already taken";
				}
			}
	
			$stmt =$conn->prepare("UPDATE product SET productName=?, productDescription=? WHERE productID=$id");
			$stmt->bind_param("ss", $newName, $newDescription);

			$newName = mysqli_real_escape_string($conn, $name);
			$newDescription =mysqli_real_escape_string($conn, $description);

			$stmt->execute();
			$stmt->close();
			$conn->close();
	}

	function updateLogo($name, $tmpName, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
		$location = "..\\".$folder."\\".$name;
		move_uploaded_file($tmpName, $location);
		$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
		$stmt =$conn->prepare("UPDATE product SET productLogo=?, productFolder=? WHERE productID=$id");
			$stmt->bind_param("ss", $newLogo, $newFolder);

			$newLogo = mysqli_real_escape_string($conn, $name);
			$newFolder =mysqli_real_escape_string($conn, $folder);

			$stmt->execute();
			$stmt->close();
			$conn->close();

	}
	function fetchAll(){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM product";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}
	function fetchSingle($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM product WHERE productID = $id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}
	function fetchPictures($id){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$query ="SELECT productName FROM product WHERE productID = $id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$productName = $return[0]['productName'];

	
			$query ="SELECT * FROM picture WHERE pictureDescription ='$productName'";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}
	function fetchEvents($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			$query ="SELECT * FROM event WHERE eventProduct = $id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			return $return;

	}









}




?>