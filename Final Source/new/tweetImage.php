<?php
	echo shell_exec('sh /var/www/cgi-bin/camera.sh'); //execute script to take picture

	$message = $_REQUEST["message"];
   $conn = new mysqli("127.0.0.1", "bbd","password","escape", 3306);
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


	require_once('/var/www/html/scripts/codebird-php-develop/src/codebird.php');

	 \Codebird\Codebird::setConsumerKey("$consumerKey", "$consumerSecret");
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken("$accessToken", "$accessTokenSecret");
	$cb->setConnectionTimeout(10000);
        $cb->setTimeout(15000);

	$reply = $cb->media_upload(array(
    	'media' => '/home/pi/Desktop/image.jpg'
	));

	$mediaID = $reply->media_id_string;

	$params = array(
    	'status' => "$message #BBDEscape",
    	'media_ids' => $mediaID
	);

	$reply = $cb->statuses_update($params);

	$status = $reply->httpstatus; 
	echo "HTTP Response Code: $status";
?>
