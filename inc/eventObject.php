<?php 


class json{
function eventToJSON(){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);

			$return_arr = array();

			$query = "SELECT * FROM event"; 
			$results = $conn->query($query);

			foreach($results as $result) {
		   		 $row_array['id'] = $result['eventID'];
		   		 $string =$result['eventStart'];
		   		 $string[strpos($string, " ")] = 'T';
		   		 $row_array['start'] = $string;
		   		 $string =$result['eventEnd'];
		   		 $string[strpos($string, " ")] = 'T';
		    	 $row_array['end'] = $string;
		    	 $row_array['color'] = $result['eventColor'];
		    	 $row_array['title'] = $result['eventName'];

		    	 array_push($return_arr,$row_array);
			}

			$jsonFile = json_encode($return_arr);
			$myfile = fopen("events.json", "w") or die("Unable to open file!");
			fwrite($myfile, $jsonFile);
			fclose($myfile);
	}
}

class event {

	
	function sendMail($id){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
			if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$query ="SELECT * FROM event WHERE eventID = $id";
			$results = $conn->query($query);
			$returns = $results->fetch_all(MYSQLI_ASSOC);
			foreach($returns as $return){
				$query2 = "SELECT * FROM fourms WHERE fourmEvent = return['eventID']";
				$results2 = $conn->query($query);
				$returns2 = $results->fetch_all(MYSQLI_ASSOC);
				foreach($returns2 as $return2){
					mail($return2['fourmEmail'], 'Upcoming Event', $return['evenMessage']);
				}

			}

	}

	function createEvent($name, $start, $end, $description, $product, $color, $message = "You are signed up for an upcoming event"){
		include "var.php";
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("INSERT INTO event (eventName, eventDescription, eventStart, eventEnd, eventProduct, eventColor, eventMessage) VALUES (?,?,?,?,?,?,?)");
			$stmt->bind_param("sssssss", $newName, $newDescription, $newStart, $newEnd, $newProduct, $eventColor, $newMessage);

			rawurlencode ($name);
			rawurlencode ($description);
			$newName = mysqli_real_escape_string($conn, $name);
			$newDescription =mysqli_real_escape_string($conn, $description);
			$newStart = mysqli_real_escape_string($conn, $start);
			$newEnd = mysqli_real_escape_string($conn, $end);
			$newProduct = mysqli_real_escape_string($conn, $product);
			$eventColor = mysqli_real_escape_string($conn, $color);
			$newMessage = mysqli_real_escape_string($conn, $message);



			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}

	function deleteEvent($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query = "DELETE FROM event WHERE eventID='$id'";
			if($results = $conn->query($query)){
			} else {
				$conn->close();
				return false;
		}
	}
	function updateEvent($name, $description, $start, $end, $product, $color, $message, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventName=?, eventDescription=?, eventStart=?, eventEnd=?, eventProduct=?, eventColor=?, eventMessage=? WHERE eventID=?");
			$stmt->bind_param("ssssssi", $newName, $newDescription, $newStart, $newEnd, $newProduct, $newColor, $newMessage, $id);

			
			rawurlencode ($name);
			rawurlencode ($description);
			$newName = mysqli_real_escape_string($conn, $name);
			$newDescription =mysqli_real_escape_string($conn, $description);
			$newStart = mysqli_real_escape_string($conn, $start);
			$newEnd = mysqli_real_escape_string($conn, $end);
			$newProduct = mysqli_real_escape_string($conn, $product);
			$newColor = mysqli_real_escape_string($conn, $color);
			$newMessage = mysqli_real_escape_string($conn, $message);


			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventName($name, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventName=? WHERE eventID=$id");
			$stmt->bind_param("s", $newName);

			rawurlencode ($name);
			$newName = mysqli_real_escape_string($conn, $name);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventDescription($description, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventDescription=? WHERE eventID=$id");
			$stmt->bind_param("s",$newDescription);

			rawurlencode ($description);
			$newDescription =mysqli_real_escape_string($conn, $description);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventStart($start,$id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventStart=? WHERE eventID=$id");
			$stmt->bind_param("s", $newStart);

			$newStart = mysqli_real_escape_string($conn, $start);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventProduct($product, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		if(!$product == 0){
			if (filter_var($product, FILTER_VALIDATE_INT) == false){
	    		return "product must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventProduct=? WHERE eventID=$id");
			$stmt->bind_param("i", $newProduct);

			$newProduct = mysqli_real_escape_string($conn, $product);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventEnd($end, $id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventEnd=? WHERE eventID=$id");
			$stmt->bind_param("S", $newEnd);

			$newEnd = mysqli_real_escape_string($conn, $end);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventColor($color,$id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventColor=? WHERE eventID=$id");
			$stmt->bind_param("s", $newColor);

			$newStart = mysqli_real_escape_string($conn, $color);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function updateEventMessage($message,$id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$stmt =$conn->prepare("UPDATE event SET eventMessage=? WHERE eventID=$id");
			$stmt->bind_param("s", $newMessage);

			$newMessage = mysqli_real_escape_string($conn, $message);

			if($stmt->execute()){
			$stmt->close();
			$conn->close();
			$json = new json;
			$json->eventToJSON();
			return true;
		}else{
			$stmt->close();
			$conn->close();
			return false;
		}
	}
	function fetchEvent($id){
		include "var.php";
		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM event WHERE eventID = $id";
			if($results = $conn->query($query)){
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}else{
			$conn->close();
			return false;
		}
	}
	function fetchAll(){
		include "var.php";
		
			$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	
			$query ="SELECT * FROM event";
			if($results = $conn->query($query)){
			$return = $results->fetch_all(MYSQLI_ASSOC);
			$conn->close();
			return $return;
		}else{
			$conn->close();
			return false;
		}
	}
	function getProduct($id){
		include "var.php";

		if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}
		$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
		$query ="SELECT eventProduct FROM event WHERE eventID = $id";
		$results = $conn->query($query);
		$return= $results->fetch_all(MYSQLI_ASSOC);
		$product = $return[0]['eventProduct'];

		$query ="SELECT * FROM product Where productID = $product";
		if($results = $conn->query($query)){
		$return = $results->fetch_all(MYSQLI_ASSOC);
		$conn->close();
		return $return;
		}else{
			$conn->close();
			return fales;
		}

	}
	
function countFourms($id){
	include "var.php";
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}

	$query = "SELECT * FROM fourms WHERE fourmEvent = $id"; 

	$count = 0;

	if($results = $conn->query($query)){
		foreach($results as $result){
			$count++;
		}
		$conn->close();
		return $count;
	}else{
		$conn->close();
		return false;
	}

}
function fetchFourms($id){
	include "var.php";
	$conn = new mysqli($IP,$USERNAME,$PASSWORD, $DB);
	if(!$id == 0){
			if (filter_var($id, FILTER_VALIDATE_INT) == false){
	    		return "id must be a valid integer";
			}
		}

	$query = "SELECT * FROM fourms WHERE fourmEvent = $id"; 
	if($results = $conn->query($query)){
		$retunn = $results->fetch_all(MYSQLI_ASSOC);
		$conn->close();
		return $count;
	}else{
		$conn->close();
		return false;
	}	


}
}




?>