<html>
    <link href='css/infocss.css' rel='stylesheet' type='text/css'>
 <head>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <script src="js/bootstrap.js"></script>
  <script src='./jquery-3.2.1.min.js'></script>
  <script>
   var pName, pTopic,pHandle,venue,startT,endT;
   function Enter(){
    pName= document.getElementById("pName").value;
	pHandle = document.getElementById("pHandle").value;
	pTopic = document.getElementById("pTopic").value;
	venue = document.getElementById("venue").value;
	startT = document.getElementById("startT").value;
	endT = document.getElementById("endT").value;
    alert("The information has been set.");
   }
   </script>
   <!--<script>
   var dateControl = document.querySelector('input[type="datetime-local"]');
date.value = '2017-06-01T08:30';
</script>-->
  
 <link rel="icon" href="pics/BBD-SoftwareDevelopment-Black.png">
 <title> BBD Escape Admin </title>
<style>
 body {
        background-image: url("pics/adminWall.jpg");
		-webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
         background-size: cover;
 } 
 </style>
  <div align="center">
  <!--<div align="center">
  <font size="16" color ="white">
   Presenter
  </font>
  </div>-->
 </head>
 <body>
 <div class="wrapper" align="center">
  <img src="pics/BBD-SoftwareDevelopment-White.png" style="width:250px;height:100px;">
  <h1>Presenters Info</h1>
  <p>Please enter each presenter's info. Press submit after each person.</p>
  <form class="form" method="post" action="insertPresenter.php">
    <input id="pName" name="name" type="text" class="password" placeholder="Presenter Name" required>
	<input id="pHandle" name="handle" type="text" class="password" placeholder="Twitter Handle" required>
	<input id="pTopic" name="topic" type="text" class="password" placeholder="Topic" required>
	<input id="venue" name="venue" type="text" class="password" placeholder="Venue" required>
	<label for="start">Start Time: </label>
	<input id="startT" name="start" type="datetime-local" class="password" value="2017-07-12T08:30" required>
	<label for="end">End Time: </label>
	<input id="endT" name="end" type="datetime-local" class="password" value="2017-07-12T08:30" required>
    <!--<div>
      <p class="password-help">Please enter the password.</p>
    </div>-->
    <input type="submit" class="submit" onclick="Enter()" value="Submit">
    
    <br><br>
    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Presenters</div>

    <!-- Table -->
    <table class="table">
      <tr>
        <th>Name</th>
        <th>Handle</th> 
        <th>Topic</th>
      </tr>
        
        <?php
            $conn = new mysqli("127.0.0.1", "bbd", "password","Escape", 3306);
            $sql = "SELECT NAME, HANDLE, TOPIC FROM PRESENTER";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                $name = $row['NAME'];
                $handle = $row['HANDLE'];
                $topic = $row['TOPIC'];
                echo '<tr>';
                echo '<td>'.$name.'</td>';
                echo '<td>'.$handle.'</td>';
                echo '<td>'.$topic.'</td>';
                echo '</tr>';
        }
        ?>
        
  </table>
  <br>
</div>
    
  </form>
  <img src="pics/Escape-White.png" style="width:230px;height:100px;">
</div> 
</div>
 </body>
</html>