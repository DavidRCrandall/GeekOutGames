<?php
session_start();
class user {


	//this function handles the sign up of new users it will check to make sure usernames are unique
		function signUp($username, $password, $premission, $phone, $email, $security, $first, $last, $answer){
		include "var.php";
		if(!$premission == 0){
			if (filter_var($premission, FILTER_VALIDATE_INT) == false){
	    		return "premission must be a valid integer";
			}
		}
		$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);

		$query ="SELECT userName FROM user";
		$results = $conn->query($query);
		$rows = $results->fetch_all(MYSQLI_ASSOC);
		foreach($rows as $row){
			if($username == $row["userName"]){
				return "Username already taken";
			}
		}
		$stmt =$conn->prepare("INSERT INTO user(userName, userPassword, userPremission, userPhone, userEmail, userQuestion, userFirst, userLast, userAnswer)
		 VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssissssss", $newUsername, $newPassword, $newPremission, $newPhone, $newEmail, $newSecurity, $newFirst, $newLast, $newAnswer);

			$newUsername = mysqli_real_escape_string($conn, $username);
			$newPassword =password_hash($password, PASSWORD_DEFAULT);
			$newPremission = mysqli_real_escape_string($conn, $premission);
			$newPhone =mysqli_real_escape_string($conn, $phone);
			$newEmail =mysqli_real_escape_string($conn, $email);
			$newFirst =mysqli_real_escape_string($conn, $firstname);
			$newLast =mysqli_real_escape_string($conn, $lastname);
			$newSecurity =mysqli_real_escape_string($conn, $security);
			$newAnswer =password_hash($answer, PASSWORD_DEFAULT);
			$stmt->execute();

		$stmt->close();
		$conn->close();
	}

	//This function will login in a users and set the LASTUSE, LOGIN, and USER session variables
	function login($username, $password){
		include "var.php";
		$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
		$query ="SELECT * FROM user WHERE userName = '$username'";
		$results = $conn->query($query);
		$rows = $results->fetch_all(MYSQLI_ASSOC);
		if(password_verify($password,$rows[0]["userPassword"])){
			$_SESSION['LOGIN'] = $rows[0]["userPremission"];
			$_SESSION['USER'] = $rows[0]["userID"];
			$_SESSION['LASTUSE'] = time();
		}
	}

	//This function will check and test inactivity and will unset session variables if required should be called at the start of each page
	function checkTime(){
		if(time()-$_SESSION['LASTUSE'] > 900 ){
			session_unset($_SESSION['LOGIN']);
			session_unset($_SESSION['USER']);
			return 1;
		}
		else{
			$_SESSION['LASTUSE'] = time();
			return 0;
		}
	}

	//This function updates a users password 
	function updatePassword($password, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userPassword=? WHERE userID=$id");
			$stmt->bind_param("s", $newPassword);

			$newPassword =password_hash($password, PASSWORD_DEFAULT);
			$stmt->execute();
			$stmt->close();
			$conn->close();
	}

	//This function updates a users phone number
	function updatePhone($phone, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userPhone=? WHERE userID=$id");
			$stmt->bind_param("s", $newPhone);

			$newPhone = mysqli_real_escape_string($conn, $phone);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users email address
	function updateEmail($email,  $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userEmail=? WHERE userID=$id");
			$stmt->bind_param("s", $newEmail);

			$newEmail = mysqli_real_escape_string($conn, $email);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users first name
	function updateFirst($first,$id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userFirst=? WHERE userID=$id");
			$stmt->bind_param("s", $newFirst);

			$newFirst = mysqli_real_escape_string($conn, $first);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users last name
	function updateLast($last, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userLast=? WHERE userID=$id");
			$stmt->bind_param("s", $newLast);

			$newLast = mysqli_real_escape_string($conn, $last);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users security question and answer
	function updateQuestionAnswer($question, $answer, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userQuestion=?, userAnswer=? WHERE userID=$id");
			$stmt->bind_param("ss", $newQuestion, $newAnswer);

			$newQuestion = mysqli_real_escape_string($conn, $question);
			$newAnswer = password_hash($answer, PASSWORD_DEFAULT);

			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

		//This function updates a users password bassed on there username
		function updatePasswordByName($password, $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userPassword=? WHERE userName='$username'");
			$stmt->bind_param("s", $newPassword);

			$newPassword = password_hash($password, PASSWORD_DEFAULT);
			$stmt->execute();
			$stmt->close();
			$conn->close();
	}

	//This function updates a users phone number based on there username
	function updatePhoneByName($phone, $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userPhone=? WHERE userName='$username'");
			$stmt->bind_param("s", $newPhone);

			$newPhone = mysqli_real_escape_string($conn, $phone);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users email based on there username
	function updateEmailByName($email,  $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userEmail=? WHERE userName='$username'");
			$stmt->bind_param("s", $newEmail);

			$newEmail = mysqli_real_escape_string($conn, $email);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}
	//This Function updates a users first name based on there username
	function updateFirstByName($first,$username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userFirst=? WHERE userName='$username'");
			$stmt->bind_param("s", $newFirst);

			$newFirst = mysqli_real_escape_string($conn, $first);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This Function updates a users last name based on there username
	function updateLastByName($last, $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userLast=? WHERE userName='$username'");
			$stmt->bind_param("s", $newLast);

			$newLast = mysqli_real_escape_string($conn, $last);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function updates a users security question and answer based on there user name
	function updateQuestionAnswerByName($question, $answer, $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userQuestion=?, userAnswer=? WHERE userName='$username'");
			$stmt->bind_param("ss", $newQuestion, $newAnswer);

			$newQuestion = mysqli_real_escape_string($conn, $question);
			$newAnswer =password_hash($answer, PASSWORD_DEFAULT);
			$stmt->execute();
			$stmt->close();
			$conn->close();

	}

	//This function deltes a user
	function deleteUser($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "DELETE FROM user WHERE userID='$id'";
			$results = $conn->query($query);
			$query = "DELETE FROM fourms WHERE fourmUser='$id'";
			$results = $conn->query($query);
			$conn->close();
		}

	//This function deletes a user based on username
	function deleteUserByName($username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "DELETE FROM user WHERE userName='$username'";
			$results = $conn->query($query);
			$conn->close();
		}

	//This fucntion fetches all user infromation from the database
	function fetchAll(){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM user";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}

	//This funtion fetches a single users infroamtion form the database
	function fetchSingle($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM user WHERE userID=$id";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}

	//This function fetches a single users infromation from the databae based on there username
	function fetchSingleByName($username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM user WHERE userName='$username'";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}
	function fetchQuestionByName($username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT userQuestion FROM user WHERE userName='$username'";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
	}

	//This fuction checks to see if a security question answer is correct if so it returns 1
	function checkAnswer($answer, $username){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT userAnswer FROM user WHERE userName = $username";
			$results = $conn->query($query);
			$return = $results->fetch_all(MYSQLI_ASSOC);
			password_verify($answer,$return[0]['userAnswer']);

			if(password_verify($answer,$return[0]['userAnswer'])){
				return 1;
			}
			else {
				return 0;
			}

	}

	//This function allows the users premission level to be changed
	function setPremission($premission, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "ID must be a valid integer";
			}
		}
		if(!$premission == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "Premission must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE user SET userPremission=? WHERE userID=$id");
			$stmt->bind_param("i", $newPremission);

			$newPremission = mysqli_real_escape_string($conn, $premission);
			$stmt->execute();
			$stmt->close();
			$conn->close();
	}
	//This function logs out a user
	function logout(){
		session_unset('LOGIN');
		session_unset('USER');
		session_unset('LASTUSE');
	}



}





?>