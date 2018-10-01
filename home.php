<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hobby Exploration Technologies</title>
  <link rel="stylesheet" type="text/css" href="homestyle.css">

</head>
<body>

  <div class="container">
      <center><h1><img src='hobby_logo_h_only.png'></h1></center>
      <center><p>Find Your Hobby. Find Your Friends.</p></center>

  </div>
  <div class="row">

      <button id="createAccount" type="button">Create Account</button>
      <button id="login" type="button">Login</button>

  </div>

  <div id="maps" style="width:625px;height:400px;">
    <script>
        function myMap() {
        var mapOptions = {
            center: new google.maps.LatLng(29.883, 97.9414),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.HYBRID
        }
        var map = new google.maps.Map(document.getElementById("maps"), mapOptions);
        }
    </script>
  </div>

  <div id="liveLandingFeed" style="width:625px;height:400px;">

    <!--event table -->
    <table id="feed">
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
          </table>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tmBrLtSdrzhWnz6yiCKpvtFcMSKNMQU&callback=myMap"></script>
<script src="home.js"></script>
</body>
</html>
