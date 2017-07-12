<?php
	$cookieExists = $_REQUEST["cookie"];
	$rating = $_REQUEST["rating"];
	$timeslot = $_REQUEST["timeslot"];
	$tweet = $_REQUEST["comment"];

	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); 

	if (!$cookieExists){
		$result = $conn->query("INSERT INTO VOTES(RATING, TIMESLOT) VALUES ($rating, $timeslot)");
	}

	if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER, TIME) VALUES('$tweet', $timeslot, NOW())")){
		echo "New comment captured!";
	} else {echo "Error capturing comment";}
?>
