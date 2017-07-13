<html>
    <link href='css/infocss.css' rel='stylesheet' type='text/css'>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
 <head>
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  
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

 div [type="main"]{
  position: relative;
  width: auto;
  min-width: 80%;
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
 <div class="wrapper" align="center" type="main">
  <img src="pics/BBD-SoftwareDevelopment-White.png" style="width:250px;height:100px;">
  <h1 style="font:52px Oswald; color:white; font-family:cambria;">Presenters Info</h1>
  <p>Please enter each presenter's info. Press submit after each person.</p>
  <form class="form" method="post" action="insertPresenter.php">
    <input name="name" id="pName" type="text" class="name" placeholder="Name" required>
	<div>
      <p class="name-help">Please enter the presenter's  name.</p>
    </div>
	<input name="handle" id="pHandle" type="text" class="handle" placeholder="Handle" required>
	<div>
      <p class="handle-help">Please enter the presenter's twitter handle. (Do not add the '@'.)</p>
    </div>
	<input name="topic" id="pTopic" type="text" class="topic" placeholder="Topic" required>
	<div>
      <p class="topic-help">Please enter the presenter's topic of speaking.</p>
    </div>
	<input name="venue" id="venue" type="text" class="venue" placeholder="Venue" required>
	<div>
      <p class="venue-help">Please enter the same venue name for the three presentors.</p>
    </div>
	<label for="start">Start Time: </label>
	<input name="start" id="startT" type="datetime-local" class="sTime" value="2017-07-13T08:30" required>
	<div>
      <p class="sTime-help">Enter the time at which the presenter starts speaking.</p>
    </div>
	<label for="end">End Time: </label>
	<input name="end" id="endT" type="datetime-local" class="eTime" value="2017-07-13T08:30" required>
	<div>
      <p class="eTime-help">Enter the time at which the presenter ends speaking.<p>
    </div>
    <!--<div>
      <p class="password-help">Please enter the password.</p>
    </div>-->
    <input type="submit" class="submit" onclick="Enter()" value="Submit">
    </div>
    <br><br>
    <div class="panel panel-default"  type="table">
    <!-- Default panel contents -->
    <div class="panel-heading" style="font:52px Oswald; color:#28D2DE; background:rgba(0,0,0,0.2); font-family:Cambria;">Presenters</div>

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
   <div type="main">
  </form>
  <img src="pics/Escape-White.png" style="width:230px;height:100px;">
</div> 
</div>
<script src="js/bootstrap.js"></script>
  <script src='css/jquery-3.2.1.min.js'></script>
  <script src='css/infojs.js'></script>
 </body>
</html>