<?php
	//$mins = $_REQUEST["interval"];
	$Text=file('tokens.txt');
	echo count($Text).'<br>';

	/*$consumerKey = $Text[0];
	//$consumerKey= 'f9iLv2YwAtAs7nlfkzldrjs31';
	$consumerSecret = $Text[1];
	//$consumerSecret = 'dbXvKs6oK5pkgVkJpz5K49JY2RwsbHu33KHtUava5M2adGbZ0e';
	$accessToken = $Text[2];
	//$accessToken = "884320356630228993-8xp43SZseryyphMhQloUmbVGCwscnJ1";
	$accessTokenSecret = $Text[3];
	//$accessTokenSecret =  "F0EKzvrwWMFfehl0jlippWcqdCRRFqDRQDfKw6VxmQK5D";*/
    $conn = new mysqli("127.0.0.1", "bbd", "password","escape", 3306);

	/*while (true){
	for ($i = 1; $i <= 5; $i++){
        	//$sql = "SELECT COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 AND TIME > (NOW() - interval 10 minute)  ORDER BY TIME DESC";
              $sql = "SELECT COMMENTID, COMMENT, HANDLE FROM COMMENTS LEFT JOIN PRESENTER ON PRESENTER = PRESENTERID WHERE TWEETED = 0 ORDER BY TIME DESC";
        	$result = $conn->query($sql);
	        $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
	        }
			//echo $output[0];
	        $handle = $output[0]["HANDLE"];
			echo $handle."<br/>";
		    $comment = $output[0]["COMMENT"];
			echo $comment;
			
	    echo sizeof($output) ."<br/>";
		$myfile = fopen("name.txt", "r");
        	$track = fread($myfile, filesize("name.txt"));
			echo $track;
	        fclose($myfile);

	        require_once('/codebird-php-develop/src/codebird.php');

        	 \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
	        $cb = \Codebird\Codebird::getInstance();
	        $cb->setToken("$accessToken", "$accessTokenSecret");
		$cb->setConnectionTimeout(10000);
		$cb->setTimeout(15000);

		if (sizeof($output) == 0) {$stat = "$track #BBDEscape";}
	        else {$stat = " h $handle $track - $comment #BBDEscape";}

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
	}*/
?>
