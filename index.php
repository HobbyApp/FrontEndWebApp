<?php

$db_host = '127.0.0.1'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'password'; // Password
$db_name = 'mydb'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Escape user inputs for security
$eventName = mysqli_real_escape_string($conn, $_POST['newEventName']);
$description = mysqli_real_escape_string($conn, $_POST['newEventDescription']);
// Capturing Date input from user
$newEventDate= mysqli_real_escape_string($conn, $_POST['newEventDate']);
// Converting date to MySQL readable format - you must use the $date variable, not the one above or MySQL will throw an error
$date=date("Y-m-d",strtotime($newEventDate));
$location = mysqli_real_escape_string($conn, $_POST['newEventLocation']);



if (isset($_POST['upload'])) {

  // the path to store the uploaded image
  $target = "images/".basename($_FILES['image']['name']);

  // Get all the submitted data from the form
  $image = $_FILES['image']['name'];

	$hobbyTarget = $_POST['hobbySelector'];

  // Attempt insert query execution
  $sql = "INSERT INTO mytable (eventName, description, eventDate, location, image, hobby)
  				VALUES ('$eventName', '$description', '$date', '$location', '$image', '$hobbyTarget')";



  mysqli_query($conn, $sql); //stores the submitted data into the database table

  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $msg = "image uploaded";
  } else {
    $msg = "there was a problem";
  }
}

// Close connection
mysqli_close($conn);
?>


<html>
<head>
    <title>Hobby Inc.</title>
  <link rel="stylesheet" type="text/css" href="webApp.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>


  <!--Top of the page will contain add new event, user profile button, and page title.-->
  <header>
    <div>
        <center><h1><a href="index.php"><img id='logo' src='hobby_logo_h_only.png'></a></h1></center>

        <img src="https://placeimg.com/60/60/people" class="ribbon"/>
        <button id="newEventButton" type="button" onclick="newEvent()">+</button>
        <button id="filterButton" type="button" onclick="openFilter()">Filter</button>
    </div>
  </header>

  <body>

  <!--New event form, popup onClick-->

  <center><form style="display:none;" id="createNewEventForm" action='index.php' method='post' enctype='multipart/form-data'>
    <fieldset>
        Event Name:<br>
				<input name="newEventName" type="text"><br>
		    hobby:<br>
					<?php
					$db_host = '127.0.0.1'; // Server Name
					$db_user = 'root'; // Username
					$db_pass = 'password'; // Password
					$db_name = 'mydb'; // Database Name

					$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
					if (!$conn) {
						die ('Failed to connect to MySQL: ' . mysqli_connect_error());
					}

						$hobbyQuery = "SELECT hobby FROM hobbies";
						$hobbyResult = mysqli_query($conn, $hobbyQuery);

						echo '<select name="hobbySelector" id="hobbySelector">';

						while ($row = mysqli_fetch_array($hobbyResult)) {
							echo '<option value="'.$row['hobby'].'">'.$row['hobby'].'</option>';
						}
						echo '</select>';

					 ?>
		    <br>
		    Location:<br>
		    <input name="newEventLocation" type="text"><br>
				Event Description:<br>
				<input name="newEventDescription" type="text"><br>
		    Event Date:<br>
		    <input type="date" name="newEventDate"><br><br>
        <input type="file" name="image"><br><br>
		    <input type="submit" name="upload"><br>
    </fieldset>
  </form></center>

 <!--Filter Perameters -->
<form style="display:none;" id="filterForm">
	<fieldset>
  <!--will filter based on selectable hobbies(unlimited hobbies) searchable, span date filter -->
    <label for="hobbyFilter">Filter by: </label>
    <div class="dropdown">
      <button type="button" id="hobbyFilter" onclick="openHobbyFilter()" class="dropbtn">Hobbies</button>
      <div id="myDropdown" class="dropdown-content">
        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
        <a href="#skiing">Skiing</a>
        <a href="#cycling">Cycling</a>
        <a href="#running">Running</a>
        <a href="#crossfit">Cross Fit</a>
        <a href="#bmx">BMX</a>
        <a href="#shooting">Shooting</a>
        <a href="#basketweaving">Basket Weaving</a>
      </div>
    </div><br>
  <!--date selector for filter perameter -->
    <div >
        <label for="endDate">Filter From Today To: </label>
        <input type="date" id="endDate" name="trip"
               value="2018-07-29"
               min="2018-01-01" max="2018-12-31"/ >
    </div><br>
</fieldset></form>

  <!--event table -->
  <center><table id="feed" class="feed">
      <thead>
          <tr class='rowData'>
							<th>Event Name</th>
							<th>Description</th>
              <th>Event Date</th>
              <th>Event Location</th>
              <th>RSVP</th>
          </tr>
      </thead>
      <tbody>
				<?php
				require 'config.php'; // Database connection

				$sql = 'SELECT *
						FROM mytable';

        foreach ($dbo->query($sql) as $row) {

          $sqlDate = date('F d, Y', strtotime($row[eventDate]));

          echo "<tr>
              <td><a value=$row[id] class='clickDetail'>$row[eventName]</a></td>
              <td><a value=$row[id] class='clickDetail'>$row[description]</a></td>
              <td><a value=$row[id] class='clickDetail'>$sqlDate</a></td>
              <td><a value=$row[id] class='clickDetail'>$row[location]</a></td>
              <td>$rsvp</td>
            </a></tr>";
        }
        ?>
				</tbody>
				</table></center>

				<script>
				$(document).ready(function onClickRow() {

				$('.clickDetail').click(function(){
				var str=$(this).attr('value'); // Find out which button is clicked, stores its value in variable 'str'

				//$(".my_dtl").hide();  // Hide all the event details already displayed.
				//$("#"+str+"").html("wait ... ");
				//$("#"+str+"").show();
				//alert('eventDetail.php?str='+str);
				$(window.location = 'eventDetail.php?str='+str).load('eventDetail.php?str='+'/'+str); // To collect data from database
				//$("#"+str+"").load('eventDetail.php?str='+str); // to Collect data from array

				})
				})
				</script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="webApp.js"></script>
<footer>
  <div class="copyright">
    <p>&copy 2018 - Hobby Inc.</p>
  </div>
  <div class="social">
    <a href="#" class="support">Contact Us</a>
    <a href="#" class="face">f</a>
    <a href="#" class="tweet">t</a>
    <a href="#" class="linked">in</a>
		<a href="#" class="legal">Legal</a>
		<a href="#" class="privacy">Privacy Policy</a>
  </div>
</footer>

</html>
