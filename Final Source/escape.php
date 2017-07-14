<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<head runat="server">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href='css/escapecss.css' rel='stylesheet' type='text/css'>
    <script src="js/bootstrap.js"></script>
	function postPicture(){
		window.open('tweetPic.php', "_self");
	}
	
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
	<style>
 body {
        background-image: url("pics/imgMain.jpg");
		-webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
         background-size: cover;
 } 
 
 div {
  position: relative;
  width: auto;
  min-width: 90%;
}
 </style>
</head>
<body>
	<div clear="both" align="center">
		<img src="pics/BBD-SoftwareDevelopment-White.png" style="width:165px;height:75px;" align = "centre" clear="both"> <br>
    <font size="6" color="white" style="text-align:$align; padding:30px 0px 0px 0px; font:32px Oswald; text-shadow:#000 0px 1px 5px;">
		BBD Escape 2017
	</font>  
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
				echo '<button type="submit" name="btnVote" style="width:85%;
			  padding:15px;
			  border-radius:5px;
			  @include disable;
			  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#28D2DE), to(#1A878F));
			  background-image: -webkit-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -moz-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -o-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: linear-gradient(#28D2DE 0%, #1A878F 100%);
			  font:14px Oswald;
			  color:#FFF;
			  text-transform:uppercase;
			  text-shadow:#000 0px 1px 5px;
			  border:1px solid #000;
			  opacity:0.7;
				-webkit-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  -moz-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
				box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  border-top:1px solid rgba(255,255,255,0.8)!important;
			  -webkit-box-reflect: below 0px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(50%, transparent), to(rgba(255,255,255,0.2)));"> Vote </button>';
			}
		}else{
			echo "no result";
		}	      		
	        	
	?>                
        <div class="form-group" align="center">
            <textarea id="exampleTextarea" name="comment" type="text" placeholder="Enter your comment." rows="3"></textarea>
        </div>
		<div class="input-group" align="center">
			<span class="input-group-addon" id="basic-addon1" style="
				border-radius:5px;
				box-shadow:inset 4px 6px 10px -4px rgba( 241, 148, 138 ,0.3), 0 1px 1px -1px rgba(255,255,255,0.3);
				background:rgba(0,0,0,0.2);
				@include disable;
				border:1px solid rgba(0,0,0,1);
				color:#d0d3d4;
				text-shadow:#000 0px 1px 5px;">@</span>
			<input type="text" name = "handle" class="form-control" placeholder="Enter your twittter handle." aria-describedby="basic-addon1" 
			style="width:98%;
				border-radius:5px;
				box-shadow:inset 4px 6px 10px -4px rgba( 241, 148, 138 ,0.3), 0 1px 1px -1px rgba(255,255,255,0.3);
				background:rgba(0,0,0,0.2);
				border:1px solid rgba(0,0,0,1);
				color:#d0d3d4;
				text-shadow:#000 0px 1px 5px;" align="center">
		</div> <br> <br>
		<div class="form-group" align="center">
			<button type="submit" name="btnComment" class="btn btn-primary btn-block" 
			style="width:85%;
			  padding:15px;
			  border-radius:5px;
			  @include disable;
			  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#28D2DE), to(#1A878F));
			  background-image: -webkit-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -moz-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -o-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: linear-gradient(#28D2DE 0%, #1A878F 100%);
			  font:14px Oswald;
			  color:#FFF;
			  text-transform:uppercase;
			  text-shadow:#000 0px 1px 5px;
			  border:1px solid #000;
			  opacity:0.7;
				-webkit-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  -moz-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
				box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  border-top:1px solid rgba(255,255,255,0.8)!important;
			  -webkit-box-reflect: below 0px -webkit-gradient(linear, left top, left bottom, from(transparent), 
			  color-stop(50%, transparent), to(rgba(255,255,255,0.2)));"> Comment </button> <br> <br>
			  <input id="post" type="button" class="button" onclick="postPicture()" value="Take and Post Picture" style="width:85%;
			  padding:15px;
			  border-radius:5px;
			  @include disable;
			  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#28D2DE), to(#1A878F));
			  background-image: -webkit-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -moz-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: -o-linear-gradient(#28D2DE 0%, #1A878F 100%);
			  background-image: linear-gradient(#28D2DE 0%, #1A878F 100%);
			  font:14px Oswald;
			  color:#FFF;
			  text-transform:uppercase;
			  text-shadow:#000 0px 1px 5px;
			  border:1px solid #000;
			  opacity:0.7;
				-webkit-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  -moz-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
				box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
			  border-top:1px solid rgba(255,255,255,0.8)!important;
			  -webkit-box-reflect: below 0px -webkit-gradient(linear, left top, left bottom, from(transparent), 
			  color-stop(50%, transparent), to(rgba(255,255,255,0.2)));"> <br> <br>
			  <a align="center" height="500px" width="90%" class="twitter-timeline" href="https://twitter.com/RasbPi3">Tweets by RasbPi3</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" ></script>
		</div>
		
    </form>
</body>
</html>
