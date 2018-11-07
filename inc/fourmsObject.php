<?php

class fourm {

	function createfourm($firstname, $lastname, $email, $phone, $push, $event, $user){
		include "var.php";
		if(!$event == 0){
			if (filter_var($event, FILTER_VALIDATE_INT) == false){
	    		return "event must be a valid integer";
			}
		}
		if(!$push == 0){
			if (filter_var($push, FILTER_VALIDATE_INT) == false){
	    		return "push must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("INSERT INTO fourms (fourmFirstName, fourmLastName, fourmEmail, fourmPhone, fourmPush, fourmEvent, fourmUser) VALUES (?,?,?,?,?,?, ?)");
			$stmt->bind_param("ssssiiI", $newFirstName, $newLastName, $newEmail, $newPhone, $newPush, $newEvent, $newUSer);

			$newFirstName = mysqli_real_escape_string($conn, $firstname);
			$newLastName =mysqli_real_escape_string($conn, $lastname);
			$newEmail = mysqli_real_escape_string($conn, $email);
			$newPhone = mysqli_real_escape_string($conn, $phone);
			$newPush = mysqli_real_escape_string($conn, $push);
			$newEvent = mysqli_real_escape_string($conn, $event);
			$newUser = mysqli_real_escape_string($conn, $user);




			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}

	function deleteFourm($id){
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "DELETE FROM fourms WHERE fourmID='$id'";
			if($results = $conn->query($query)){
				$conn->close();
				return true;
			}else{
				$conn->close();
				return false;
			}
	}
	function updateFourm($firstname, $lastname, $email, $phone, $push, $id){
		include "var.php";
		if(!$push == 0){
			if (filter_var($push, FILTER_VALIDATE_INT) == false){
	    		return "push must be a valid integer";
			}
		}
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmFirstName=?, fourmLastName=?, fourmEmail=?, fourmPhone=?, fourmPush=? WHERE fourmID=$id");
			$stmt->bind_param("ssssi", $newFirstName, $newLastName, $newEmail, $newPhone, $newPush);

			$newFirstName = mysqli_real_escape_string($conn, $firstname);
			$newLastName =mysqli_real_escape_string($conn, $lastname);
			$newEmail = mysqli_real_escape_string($conn, $email);
			$newPhone = mysqli_real_escape_string($conn, $phone);
			$newPush = mysqli_real_escape_string($conn, $push);



			if($stmt->execute()){
				$stmt->close();
				$conn->close();
				return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function updateFourmFirst($firstname, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmFirstName=? WHERE fourmID=$id");
			$stmt->bind_param("s", $newFirstName);

			$newFirstName = mysqli_real_escape_string($conn, $firstname);
			
			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function updateFourmLast($lastname, $id){
		include "var.php";
		
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmLastName=? WHERE fourmID=$id");
			$stmt->bind_param("s", $newLastName);

			$newLastName =mysqli_real_escape_string($conn, $lastname);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function updateFourmEmail($email, $id){
		include "var.php";
		
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmEmail=? WHERE fourmID=$id");
			$stmt->bind_param("s", $newEmail);

			$newEmail = mysqli_real_escape_string($conn, $email);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function updateFourmPhone($phone, $id){
		include "var.php";
		
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmPhone=? WHERE fourmID=$id");
			$stmt->bind_param("s", $newPhone);

			$newPhone = mysqli_real_escape_string($conn, $phone);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function updateFourmPush($push, $id){
		include "var.php";
		if(!$push == 0){
			if (filter_var($push, FILTER_VALIDATE_INT) == false){
	    		return "push must be a valid integer";
			}
		}
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE fourms SET fourmPush=? WHERE fourmID=$id");
			$stmt->bind_param("i", $newPush);

			$newPush = mysqli_real_escape_string($conn, $push);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
			}else{
				$stmt->close();
				$conn->close();
				return false;
			}
	}
	function fetchFourm($id){
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM fourms WHERE fourmID = $id";
			if($results = $conn->query($query)){
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}else{
			$conn->close();
			return false;
		}
	}
	function fetchAllFourm(){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM fourms";
			if($results = $conn->query($query)){
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}else{
			$conn->close();
			return false;
		}
	}
	function fetchFourmByEvent($event){
		if(!$event == 0){
			if (filter_var($event, FILTER_VALIDATE_INT) == false){
	    		return "event must be a valid integer";
			}
		}
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM fourms WHERE fourmEvent = $event";
			if($results = $conn->query($query)){
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}else{
			$conn->close();
			return false;
		}
	}

	function UserCreate($id, $push, $event){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		if(!$event == 0){
			if (filter_var($event, FILTER_VALIDATE_INT) == false){
	    		return "event must be a valid integer";
			}
		}
		if(!$push == 0){
			if (filter_var($push, FILTER_VALIDATE_INT) == false){
	    		return "push must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);

			$query ="SELECT * FROM fourms WHERE fourmEvent = $event AND fourmUser =$id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			if(sizeof($return) > 0){
				$conn->close();
				return false;
			}else{

			$query="SELECT * FROM user WHERE userID = $id";
			$return = $conn->query($query);
			$results = $return->fetch_all(MYSQLI_ASSOC);
			$firstname = $results[0]['userFirst'];
			$lastname = $results[0]['userLast'];
			$email = $results[0]['userEmail'];
			$phone = $results[0]['userPhone'];

			$stmt =$conn->prepare("INSERT INTO fourms (fourmFirstName, fourmLastName, fourmEmail, fourmPhone, fourmPush, fourmEvent, fourmUser) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param("ssssiii", $newFirstName, $newLastName, $newEmail, $newPhone, $newPush, $newEvent, $newUser);

			$newFirstName = mysqli_real_escape_string($conn, $firstname);
			$newLastName =mysqli_real_escape_string($conn, $lastname);
			$newEmail = mysqli_real_escape_string($conn, $email);
			$newPhone = mysqli_real_escape_string($conn, $phone);
			$newPush = mysqli_real_escape_string($conn, $push);
			$newEvent = mysqli_real_escape_string($conn, $event);
			$newUser = mysqli_real_escape_string($conn, $id);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			return true;
		}else{
			return false;
		}
	}
	}




}




?>