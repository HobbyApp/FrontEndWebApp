<html>
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

// Escape user inputs for security
$eventName = mysqli_real_escape_string($conn, $_POST['newEventName']);
$description = mysqli_real_escape_string($conn, $_POST['newEventDescription']);
// Capturing Date input from user
$newEventDate= mysqli_real_escape_string($conn, $_POST['newEventDate']);
// Converting date to MySQL readable format - you must use the $date variable, not the one above or MySQL will throw an error
$date=date("Y-m-d",strtotime($newEventDate));
$location = mysqli_real_escape_string($conn, $_POST['newEventLocation']);

// the path to store the uploaded image
$target = "images/".basename($_FILES['image']['name']);

// Get all the submitted data from the form
$image = $_FILES['image']['name'];

// Attempt insert query execution
$sql = "INSERT INTO mytable (eventName, description, eventDate, location, image)
				VALUES ('$eventName', '$description', '$date', '$location', '$image')";







// Close connection
mysqli_close($conn);
?>

</body>
</html>
