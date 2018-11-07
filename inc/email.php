<?php
	$IP = "db676480015.db.1and1.com";
	$USERNAME = "dbo676480015";
	$PASSWORD = "17SePtEmBeR!@";
	$DB = "db676480015";
	$SECPERDAY = 60*60*24;
	$upcoming = array();

	mysql_connect($IP,$USERNAME,$PASSWORD);
	mysql_select_db($DB);
	$query ="SELECT * FROM event";
	$result = mysql_query($query);
	$returns = mysql_fetch_assoc($result);

	foreach($returns as $return){
		$start = strtotime($return['eventStart']);
		$current =  time();
		$timeTillEvent = $start - $current;
		if($timeTillEvent < $SECPERDAY && $timeTillEvent > 0){
			array_push($upcoming, $return['eventID']);
		}
	}
	foreach($upcoming as $event){
		$users = array();
		$query ="SELECT * FROM event where eventID = $event";
		$result = mysql_query($query);
		$eventData = mysql_fetch_assoc($result);

		$query ="SELECT * FROM fourms where fourmEvent = $event";
		$result = mysql_query($query);
		$returns = mysql_fetch_assoc($result);
		$eventDate = date('jS \of F Y ',strtotime($eventData[0]['eventStart']));

		foreach($returns as $return){
			echo $msg = $return['fourmFirstName'].' '.$return['fourmLastName'].' '.'you are signed up for the event '.$eventData[0]['eventName'].' at geek out games coming up on the '.$eventDate;
			mail($return['fourmEmail'], "Upcoming Event",$msg);
		}

	}




?>