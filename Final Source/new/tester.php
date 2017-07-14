<?php            
	function getHeader(){				
		$conn = new mysqli("127.0.0.1", "bbd", "password","escape", 3306);
		$sql = "SELECT VENUE FROM PRESENTER";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		$output = $row['VENUE'];
		echo $output;
	}
    echo getHeader();
?>