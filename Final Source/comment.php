<?php
	if(isset($_POST['btnComment'])){
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); //change ip add
		$presenter = $_REQUEST["presenter"];
		$comment = $_REQUEST["comment"];
		$handle = $_REQUEST["handle"];
		echo "Presenter: ".$presenter;
		echo "Comment: ".$comment;
		
		if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER) VALUES ('$comment', '$presenter')")){
			echo "<br/>Comment added inserted";
		}
		else {
			echo "Error inserting";
		}
	}
	
?>
