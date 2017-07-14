<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.js"></script>
    <style>
        body {
            background-image: url("pics/imgMain.jpg");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>    
    <?php        
	function getMac(){
		$ip = $_SERVER['REMOTE_ADDR'];
		$mac = false;			
		$arp = 'arp -a $ip';			
		$lines = explode("\n", $arp);
		foreach($lines as $line)
		{
		   $cols = preg_split('/\s+/', trim($line));
		   return $cols[1];
		   if ($cols[0] == $ip){
			   return $cols[1];
		   }
		}
		return $mac;
	}

    ?>
	<?php
	if(isset($_POST['btnComment'])){
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); //change ip add
		$presenter = $_POST["presenter"];
		$comment = $_POST["comment"];
		$handle = $_POST["handle"];
		echo "Presenter: ".$presenter;
		echo "Comment: ".$comment;
		
		if ($result = $conn->query("INSERT INTO COMMENTS(COMMENT, PRESENTER) VALUES ('$comment', '$presenter')")){
			echo "<br/>Comment added inserted";
			setCookie("voted","true",time()+86400);
		}
		else {
			echo "Error inserting";
		}
	}
	if(isset($_POST['btnVote'])){
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
		$presenter = $_POST["presenter"];
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if ($result = $conn->query("INSERT INTO VOTES(PRESENTER, MAC) VALUES ('$presenter', '$ip')")){
			echo "<br/>Comment added inserted";
			setCookie("voted","true",time()+86400);
		}
		else {
			echo "Error voting";
		}
	}

       
?>	
	<link rel="icon" href="pics/BBD-SoftwareDevelopment-Black.png">
	<title> BBD Escape 2017 </title>
</head>
<body>
	<div clear="both" align="left">
		<img src="pics/BBD-SoftwareDevelopment-White.png" style="width:110px;height:50px;" align = "center">   
	</div>
    <p align="center" clear="both" style="font-family:cambria; size:18; color:white;">
	<?php 
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
            	$sql = "SELECT * FROM PRESENTER";
            	$result = mysqli_query($conn, $sql);
            	$row = mysqli_fetch_array($result);
            	echo $row['VENUE'];
	?>
    </p>		 
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class="custom-controls-stacked">
            <?php
            $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
            $sql = "SELECT * FROM PRESENTER";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                $id = $row['PRESENTERID'];
                $presenter = $row['NAME'];
                $handle = $row['HANDLE'];
                $topic = $row['TOPIC'];
                $start = $row['START'];
                $end = $row['END'];
                echo '<div class="form-check">';
                echo '<label class="custom-control custom-radio">';
                echo '<input id="'.$id.'" value="'.$id.'" name="presenter" type="radio" class="custom-control-input">';
                echo '<span class="custom-control-indicator"></span>';
                echo '<span class="custom-control-description"><font color="white"> '.$presenter.' : '.$topic.' (Start: '.$start.' End: '.$end.')</font></span>';
                echo '</label>';
                echo '</div>';
        }
        ?>
        </div>
	<?php
		$ip = $_SERVER['REMOTE_ADDR'];
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
	        $sql = "SELECT * FROM VOTES WHERE MAC = ".$ip;
	        $result = mysqli_query($conn, $sql);
		echo "Size: ".$result->num_rows === 0;
		$ip = $_SERVER['REMOTE_ADDR'];
		$conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
		$sql = "SELECT * FROM VOTES WHERE MAC = '$ip'";
		if($result = mysqli_query($conn, $sql)){
			//if cookie not found
			if(($result->num_rows>0)||(isset($_COOKIE['voted']))){
				echo "Already voted: ".$result->num_rows;
			}else{
				echo '<button type="submit" name="btnVote" class="btn btn-primary btn-block"> Vote </button>';
			}
		}else{
			echo "no result";
		}	      		
	        	
	?>                
        <div class="form-group">
            <label for="exampleTextarea"></label>
            <textarea class="form-control" name="comment" placeholder="Comment (could be tweeted)" id="exampleTextarea" rows="3"></textarea>
        </div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">@</span>
			<input type="text" name = "handle" class="form-control" placeholder="handle" aria-describedby="basic-addon1">
		</div>
		<div class="form-group">
			<label for="vote"></label>
			<button type="submit" name="btnComment" class="btn btn-primary btn-block"> Comment </button>
		</div>
    </form>
</body>
</html>
