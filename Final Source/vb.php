<?php
	$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	$sql = "SELECT * FROM PRESENTER";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		echo $row['PRESENTERID']." ".$row['HANDLE']." ".$row['TOPIC']." ".$row['START']." ".$row['END']."<br/>";
	}
	echo "James";
	

?>