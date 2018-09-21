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
		    hobby:<br>
		    <select name="hobbies">
		      <option value="bikes">Bikes</option>
		      <option value="jetSki">Jet Ski</option>
		      <option value="flying">Flying</option>
		      <option value="basketWeaving">Basket Weaving</option>
		    </select><br>
		    Location:<br>
		    <input name ="newEventLocation" type="text"><br>
		    Event Date:<br>
		    <input type="date" name="newEventDate"><br>
		    <input type="submit"><br>
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
  <center><table id="feed">
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
				// this php code loops through the database to display the data in the proper row.

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

				// Ignore this stuff for now but leave it here
				//	$no.
				//	$queryDetails = mysqli_query($conn, $sqlDetails)
				//	$sqlDetails = 'SELECT * FROM mytable WHERE id=$x';

				//	if ($row = mysqli_fetch_array())

        }?>
      </tbody>
  </table></center>
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
