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

  <center><form style="display:none;" id="createNewEventForm">
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
              <th>ID</th>
              <th>Message</th>
              <th>Event Name</th>
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
          $RSVP  = $row['RSVP'] == 0 ? '' : number_format($row['RSVP']);
          echo '<tr>
              <td>'.$no.'</td>
              <td>'.$row['message'].'</td>
              <td>'.$row['Event Name'].'</td>
              <td>'. date('F d, Y', strtotime($row['Event Date'])) . '</td>
              <td>'.$Location.'</td>
              <td>'.$RSVP.'</td>
            </tr>';
          $no++;
        }?>
      </tbody>
  </table></center>
</body>
<script src="webApp.js"></script>
</html>
