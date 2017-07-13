<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/bootstrap.js"></script>
	<script>
	   var v;
	   window.onload = function (){
       if (document.cookie.length != 0){
                $("#r1").hide();
				$("#r2").hide();
				$("#r3").hide();
				$("#vote").hide();
			}
        }
	   
	   function vote(){
       if(v!=0){
       alert("thank you for voting");
	    document.cookie = "voted="+ voted+";expires=Thu, 13 Jul 2017 10:40:00 UTC;";
       } else { alert("Please select a presenter");}
      }
	  
	  $(document).ready(function(){
      $("#vote").click(function(){
	     if(v!=0){
           $("#r1").hide();
		   $("#r2").hide();
		   $("#r3").hide();
		   $("#vote").hide();
	    }
        });
	     $("#r1").click(function(){
	      v = 1;
	    });
	    $("#r2").click(function(){
	      v = 2;
      	});
     	$("#r3").click(function(){
	      v = 3;
	    });
        });
   </script> 
    <style>
        body {
            background-image: url("imgMain.jpg");
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
	<link rel="icon" href="BBD-SoftwareDevelopment-Black.png">
	<title> BBD Escape 2017 </title>
</head>
<body>
	<div clear="both" align="center">
		<img src="BBD-SoftwareDevelopment-White.png" style="width:220px;height:100px;" align = "center">   
	</div>
    <h2 align="center" style="font-family:cambria; color:white">
	(<?php 
		$conn = new mysqli("127.0.0.1", "bbd", "password","escape", 3306);
            	$sql = "SELECT VENUE FROM PRESENTER";
            	$result = mysqli_query($conn, $sql);
            	$row = mysqli_fetch_array($result);
            	echo $row['VENUE'];
	?>)
    </h2>		 
    <form>
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
                echo '<input id="'.$id.'" name="presenter" type="radio" class="custom-control-input">';
                echo '<span class="custom-control-indicator"></span>';
                echo '<span class="custom-control-description"><font color="white"> '.$presenter.' : '.$topic.' (Start: '.$start.' End: '.$end.')</font></span>';
                echo '</label>';
                echo '</div>';
        }
        ?>
        </div>
        <button type="button" class="btn btn-primary btn-block"> Vote </button>                
        <div class="form-group">
            <label for="exampleTextarea"></label>
            <textarea class="form-control" placeholder="Comment (could be tweeted)" id="exampleTextarea" rows="3"></textarea>
        </div>
		<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">@</span>
			<input type="text" class="form-control" placeholder="handle" aria-describedby="basic-addon1">
		</div>
		<div class="form-group">
			<label for="vote"></label>
			<button id="vote" type="button" class="btn btn-primary btn-block" onclick="vote()"> Comment </button>
		</div>
    </form>
</body>
</html>
