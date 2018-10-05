<html>
<head>
    <title>Hobby Inc.</title>
  <link rel="stylesheet" type="text/css" href="webApp.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>


  <!--Top of the page will contain add new event, user profile button, and page title.-->
  <header>
    <div class="container">
        <center><h1><img src='hobby_logo_h_only.png'></h1></center>
        <center><p>Find Your Hobby. Find Your Friends.</p></center>
        <img src="https://placeimg.com/60/60/people" class="ribbon"/>
        <button id="newEventButton" type="button" onclick="newEvent()">+</button>
        <button id="filterButton" type="button" onclick="openFilter()">Filter</button>
    </div>
  </header>


    <body>
    <?php

    $db_host = '127.0.0.1'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = 'password'; // Password
    $db_name = 'mydb'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
    	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

$str = $_GET['str']; // collect the row id

$queryRow = ("SELECT id, eventName, image, description, eventDate, location, rsvp, hobby FROM mytable WHERE id='$str'"); // SQL Statement

$result = mysqli_query($conn, $queryRow); // Execute SQL Query

$items = array(); // Create an array and store in a variable called $items

// Statement below fetches the row that was clicked and stores the data in the array $items
if (mysqli_num_rows($result) > 0) {

      while($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
      }
}

mysqli_close($conn);
?>
<br>
<div id="eventContainer">
  <div id="pictureBanner" class="fill">
    <?php
      $db_host = '127.0.0.1'; // Server Name
      $db_user = 'root'; // Username
      $db_pass = 'password'; // Password
      $db_name = 'mydb'; // Database Name

      $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      if (!$conn) {
      	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
      }

      $str = $_GET['str'];

      $sql = ("SELECT image FROM mytable WHERE id='$str'");
      $imgResult = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($imgResult)) {
        echo "<div id='imgDiv'>";
            echo "<img src='images/".$row['image']."' >";
        echo "</div>";
      }

?>
  <div id="eventName" class="bottom-left">
    <h1>
      <?php
        foreach ($items as $item) {
          echo $item['eventName'];
        }
      ?>
    </h1>
  </div>
</div>
  <div id="detailBox">
    <div id="hobbyType">
      <?php
        foreach ($items as $item) {
          echo $item['hobby'];
        }
      ?>
    </div>
    <div id="eventDate">
      <h2>
      <?php

        foreach ($items as $item) {
          $sqlDate = date('F d, Y', strtotime($item[eventDate]));
          echo $sqlDate;
        }
      ?>
      </h2>
    </div>
    <div id="description">
      <?php
        foreach ($items as $item) {
          echo $item['description'];
        }
      ?>
    </div>
    <div id="location">
      <h3>Where is it?</h3>
      <?php
        foreach ($items as $item) {
          echo "Address: ";
          echo $item['location'];
        }
      ?>
    </div><br>
    <div id="maps" style="width:625px;height:400px;">
      <script>
        function myMap() {
          var mapOptions = {
              center: new google.maps.LatLng(30.2672, 97.7431),
              zoom: 10,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          var map = new google.maps.Map(document.getElementById("maps"), mapOptions);
        }
      </script>
    </div>
    <div id="rsvpList">
      <h3>Who's Going?</h3>
      <?php
        foreach ($items as $item) {
          echo $item['rsvp'];
        }
      ?>
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tmBrLtSdrzhWnz6yiCKpvtFcMSKNMQU&callback=myMap"></script>
</body>
</html>
