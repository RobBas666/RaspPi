<?php
	//$mins = $_REQUEST["interval"];

        $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
		$sql = "SELECT * FROM TOKENS";
		 $result = $conn->query($sql);
		  $output = array();
                echo $result->num_rows;
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
	        }
              echo $output->num_rows;
	      $consumerKey = $output[0]["tKey"];
	      echo $consumerKey."<br/>";
	     $consumerSecret = $output[1]["tKey"];
	     echo $consumerSecret."<br/>";
             $accessToken = $output[2]["tKey"];
	    echo $accessToken."<br/>";
            $accessTokenSecret =$output[3]["tKey"];
            echo $accessTokenSecret."<br/>";
		 
		

	while (true){
	for ($i = 1; $i <= 5; $i++){
       // $sql = "SELECT COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 AND TIME > (NOW() - interval 10 minute)  ORDER BY TIME DESC";
            $sql = "SELECT COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 ORDER BY TIME DESC";
        	$result = $conn->query($sql);
	        $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
	        }
	        $handle = $output[0]["HANDLE"];
			echo $handle."<br/>";
		$comment = $output[0]["COMMENT"];
		echo $comment."<br/>";
	       echo sizeof($output);
		$myfile = fopen("name.txt", "r");
        	$track = fread($myfile, filesize("name.txt"));
	        fclose($myfile);
                echo $track."<br/>";

	        require_once('/var/www/html/scripts/codebird-php-develop/src/codebird.php');

        	 \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
	        $cb = \Codebird\Codebird::getInstance();
	        $cb->setToken("$accessToken", "$accessTokenSecret");
		$cb->setConnectionTimeout(10000);
		$cb->setTimeout(15000);

		if (sizeof($output) == 0) {$stat = "$track #BBDEscape";}
	        else {$stat = ".$handle $track - $comment #BBDEscape";}

		if ($i == 1){
			echo shell_exec('sh /var/www/cgi-bin/camera.sh');
        		$reply = $cb->media_upload(array(
        			'media' => '/home/pi/Desktop/image.jpg'
        		));

	       		$mediaID = $reply->media_id_string;
			$params = array('status' => $stat,'media_ids' => $mediaID);
		}
		else {$params = array('status' => $stat);}
		$reply = $cb->statuses_update($params);

	        $status = $reply->httpstatus;
        	echo "HTTP Response Code: $status";

		$id = $output[0]["COMMENTID"];
		if ($status == "200") {
			$sql = "UPDATE COMMENTS SET TWEETED = 1 WHERE COMMENTID = $id";
	        	$result = $conn->query($sql);
		}
	}
	sleep(300);
	}
?>
