<html>
<head>
    <title>Hobby Inc.</title>
  <link rel="stylesheet" type="text/css" href="webApp.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

$queryRow = ("SELECT id, eventName, description FROM mytable WHERE id='$str'"); // SQL Statement

$result = mysqli_query($conn, $queryRow); // Execute SQL Query
$items = array(); // Create an array and store in a variable called $items
// Statement below fetches the row that was clicked and stores the data in the array $items
if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
      }
}

// Statement below separates each item in the array and converts it to a string and stores in variable named $item
foreach ($items as $item) {
  echo $item['id'];
  echo $item['eventName'];
  echo $item['description'];
}
mysqli_close($conn);
?>

</body>
</html>
