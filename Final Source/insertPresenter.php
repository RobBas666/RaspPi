<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); //change ip add
	$handle = $_REQUEST["handle"];
	$name = $_REQUEST["name"];
	$venue = $_REQUEST["venue"];
	$topic = $_REQUEST["topic"];
	$start = $_REQUEST["start"];
	$end = $_REQUEST["end"];

	$start = $start.":00";
	$start = str_replace('T', ' ', $start);
	$end = $end.":00";
	$end = str_replace('T', ' ', $end);


	$result = $conn->query("INSERT INTO PRESENTER(HANDLE, NAME, TOPIC, START, END) VALUES ('$handle', '$name', '$topic', '$start', '$end')");
	if ($result == '1'){
		echo "<br/>Presenter ".$name." <br/>with handle ".$handle." <br/>has been inserted";
        
	}
	else {
		echo "<br/>Error inserting";
	}

    echo "<br/><br/><br/>You will be automatically redirected back to the Insert Presenter screen.";

?>

   
<?php
  
    header('refresh:5;url=info.php');    

?>
