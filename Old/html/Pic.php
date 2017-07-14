<html>
    <link href='admincss.css' rel='stylesheet' type='text/css'>
 <head>
  <script src='./jquery-3.2.1.min.js'></script>
  <script src='./adminjs.js'></script>
 <link rel="icon" href="BBD-SoftwareDevelopment-Black.png" type="image/x-icon"/>
 <title> BBD Escape Admin </title>
<style>
 body {
        background-image: url("adminWall.jpg");
		-webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
         background-size: cover;
 } 
 </style>
  <div align="center">
  <!--<div align="center">
  <font size="16" color ="white">
   Admin Login
  </font>
  </div>-->
 </head>
 <body>
 <?php
  if (isset($_POST['Take'])) {
   echo shell_exec('sh camera.sh');
  }
 ?>
 
 <script>
  $(document).ready(function(){
    $("#pic").hide();
	$('#tw').hide();
  })
  
   function show(){
     document.getElementById("pic").src = "image.jpg"
     $("#pic").show();
	 $('#tw').show();   
    } 
 </script>
 <div class="wrapper" align="center">
   <div class="wrapper" align="center">
  <h1>Tweet Pic</h1>
  <p>Click below to take a picture</p>
  <form class="form" method="post" action="post">
  <input Name = "Take" type="button" class="button" onclick ="show()" value="Take Photo">
  </form>
   <img id = "pic" src="" height="142" width="142">
   <br><br>
  <form class = "form" method = "post" action = "tweetImage">
   <input Name = "tweet" id="tw" type="button" class="button" value="Tweet Photo">
  </form>
</div> 
</div>
 </body>
</html>