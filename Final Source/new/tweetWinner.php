<?php
        $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306); 
		 $sql = "SELECT * FROM TOKENS";
		 $result = $conn->query($sql);
		  $output = array();
       		while($row = $result->fetch_assoc()){
                	$output[]=$row;
	        }
			echo sizeof($output)."<br/>";
			$consumerKey = $output[0]["conKey"];
			echo $consumerKey."<br/>";
			 $consumerSecret = $output[0]["conSecret"];
			 echo $consumerSecret."<br/>";
             $accessToken = $output[0]["accTok"];
			 echo $accessToken."<br/>";
            $accessTokenSecret =$output[0]["accTokSecret"];
            echo $accessTokenSecret."<br/>";
	$sql = "SELECT MAX(AVERAGE) AS RATING, TIMESLOT,HANDLE, NAME, TOPIC FROM
                (SELECT AVG(RATING) AS AVERAGE,  TIMESLOT, HANDLE, NAME, TOPIC FROM VOTES LEFT JOIN PRESENTER ON PRESENTERID = TIMESLOT)
                AS MAXAVG";

 	$result = $conn->query($sql);
        $output = array();
        while($row = $result->fetch_assoc()){
                $output[]=$row;
        }
	$handle = $output[0]["HANDLE"];
	$topic = $output[0]["TOPIC"];
	$name = $output[0]["NAME"];

	$myfile = fopen("name.txt", "r");
	$track = fread($myfile, filesize("name.txt"));
	fclose($myfile);

        require_once('/var/www/html/scripts/codebird-php-develop/src/codebird.php'); 

        \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken("$accessToken", "$accessTokenSecret");
	$cb->setConnectionTimeout(10000);
	$cb->setTimeout(15000);

        $params = array(
                'status' => "The winner of $track is $name: $handle, with the topic $topic  #BBDEscape",
        );
        $reply = $cb->statuses_update($params);

        $status = $reply->httpstatus; 
  	echo "HTTP Response Code: $status";
?>
