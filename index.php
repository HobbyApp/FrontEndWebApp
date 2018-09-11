<?php
$db_host = '127.0.0.1'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'password'; // Password
$db_name = 'mydb'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = 'SELECT *
		FROM mytable';

$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>

<html>
<head>
    <title>Hobby Inc.</title>
  <link rel="stylesheet" type="text/css" href="webApp.css">
</head>


  <!--Top of the page will contain add new event, user profile button, and page title.-->
  <header>
    <div class="container">
        <center><h1>Hobby Inc.</h1></center>
        <center><p>Find Your Hobby</p></center>
        <img src="https://placeimg.com/60/60/people" class="ribbon"/>
        <button id="newEventButton" type="button" onclick="newEvent()">+</button>
        <button id="filterButton" type="button" onclick="openFilter()">Filter</button>
    </div>
  </header>

  <body>

  <!--New event form, popup onClick-->

  <center><form style="display:none;" id="createNewEventForm" action='insert.php' method='post'>
    <fieldset>
        Event Name:<br>
      <input name="newEventName" type="text"><br>
      Description:<br>
      <input name="newEventDescription" type="text">
      <br>
			Event Date:<br>
      <input name="newEventDate" type="date"><br>
      Location:<br>
      <input name ="newEventLocation" type="text"><br>
      <input type="submit"><br>
    </fieldset>
  </form></center>

 <!--Filter Perameters -->
<form style="display:none;" id="filterForm">
  <fieldset>
  Hobby:<br>
  <span id="hobbyFilter">
    <input type="checkbox" id="jetSki" name="hobby">
    <label for="jetSki">Jet Ski</label>

    <input type="checkbox" id="cycling" name="hobby">
    <label for="cycling">Cycling</label>

    <input type="checkbox" id="running" name="hobby">
    <label for="running">Running</label>

    <input type="checkbox" id="basketball" name="hobby">
    <label for="basketball">Basketball</label>
  </span><br>
  Distance:<br>
  <select id="distanceFilter">
    <option>20 miles</option>
    <option>30 miles</option>
    <option>40 miles</option>
    <option>50 miles</option>
  </select><br>
  <input type="submit" value="Apply"><br>
</fieldset></form>

  <!--event table -->
  <center><table id="feed">
      <thead style="color: white;">
          <tr>
							<th>Event Name</th>
							<th>Description</th>
              <th>Event Date</th>
              <th>Event Location</th>
              <th>RSVP</th>
          </tr>
      </thead>
      <tbody style="color: white;">
        <?php
        $no 	= 1;
        while ($row = mysqli_fetch_array($query))
        {
          $rsvp  = $row['rsvp'] == 0 ? '' : number_format($row["rsvp"]);
          echo '<tr>
        			<td>'.$row['eventName'].'</td>
							<td>'.$row['description'].'</td>
              <td>'. date('F d, Y', strtotime($row['eventDate'])) . '</td>
              <td>'.$row['location'].'</td>
              <td>'.$rsvp.'</td>
            </tr>';
          $no++;
        }?>
      </tbody>
  </table></center>
</body>
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
		<a href="#" class="jobs">Jobs</a>
  </div>
</footer>

</html>
