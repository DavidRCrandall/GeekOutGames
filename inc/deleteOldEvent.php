<?php
	$IP = "localhost";
	$USERNAME = "root";
	$PASSWORD = "";
	$DB = "geek_out";
	$ended = array();

	$conn = mysql_connect()($IP,$USERNAME,$PASSWORD, $DB);
	$query ="SELECT * FROM event";
	$results = mysql_query($query);
	$returns = mysql_fetch_assoc($result);

	foreach($returns as $return){
		$end = strtotime($return['eventEnd']);
		$current =  time();
		if($end < $current){
			array_push($ended, $return['eventID']);
		}
	}

	foreach($ended as $event){
		$query ="DELETE FROM event where eventID = $event";
		$results = mysql_query($query);
		$query ="DELETE FROM fourms where fourmEvent = $event";
		$results = mysql_query($query);

	}
	$conn->close();



?>