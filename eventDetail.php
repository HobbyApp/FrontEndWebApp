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
<div id="eventContainer">
  <div id="pictureBanner">
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

  </div>
  <div id="detailBox">
    <div id="eventName">
      <?php
        foreach ($items as $item) {
          echo $item['eventName'];
        }
      ?>
    </div>
    <div id="description">
      <?php
        foreach ($items as $item) {
          echo $item['description'];
        }
      ?>
    </div>
    <div id="eventDate">
      <?php
        foreach ($items as $item) {
          echo $item['eventDate'];
        }
      ?>
    </div>
    <div id="location">
      <?php
        foreach ($items as $item) {
          echo $item['location'];
        }
      ?>
    </div>
    <div id="rsvpList">
      <?php
        foreach ($items as $item) {
          echo $item['rsvp'];
        }
      ?>
    </div>
    <div id="hobbyType">
      <?php
        foreach ($items as $item) {
          echo $item['hobby'];
        }
      ?>
    </div>
  </div>
</div>


</body>
</html>
