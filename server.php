<?php
require('password.php');
session_start();

// initializing variables
$username = "";
$password = "";

$errors = array();

// connect to the database
$db = mysqli_connect('127.0.0.1', 'root', 'password', 'mydb');
if (!$db) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['pass']);
  $password_2 = mysqli_real_escape_string($db,$_POST['cpass']);
  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $middleName = mysqli_real_escape_string($db, $_POST['middleName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
  $dateOfBirth = mysqli_real_escape_string($db, $_POST['dateOfBirth']);
  $dobConversion=date("Y-m-d",strtotime($dateOfBirth));
  $hashToStoreInDb = password_hash($password_1, PASSWORD_DEFAULT);



  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($firstName)) { array_push($errors, "First Name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($lastName)) { array_push($errors, "Last Name is required"); }
  if (empty($dateOfBirth)) { array_push($errors, "Date of Birth is required"); }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    // the path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    // Get all the submitted data from the form
    $image = $_FILES['image']['name'];
    // Insert user inputs into user table
  	$insertUser = "INSERT INTO users (username, firstName, middleName, lastName, dateOfBirth, image, password)
  			           VALUES ('$username', '$firstName', '$middleName', '$lastName', '$dobConversion', '$image', '$hashToStoreInDb')";
      mysqli_query($db, $insertUser);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "image uploaded";
      } else {
        $msg = "there was a problem";
      }

    // Now authenticate to make sure the insertion was successful
  	if (password_verify($password_1, $hashToStoreInDb)) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['firstName'] = $row['firstName'];
			$_SESSION['middleName'] = $row['middleName'];
			$_SESSION['lastName'] = $row['lastName'];
			$_SESSION['dateOfBirth'] = $row['dateOfBirth'];
			$_SESSION['image'] = $row['image'];
  		$_SESSION['success'] = "You are now logged in";
  		header('location: login.php?createaccount=success');
			echo "You have successfully created your account! Login to jump right into Hobby!";
  } else {
    array_push($errors, "Insertion was not successful");
  }
} else {
  echo "You have made a grave mistake";
}
}

// LOGIN USER
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['lpass']);

	//Error handlers
	//Check if inputs are empty
	if (empty($username) || empty($password)) {
		header("location: login.php");
		echo "The Username and Password fields are required";
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username='$username'";
		$result = mysqli_query($db, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("location: login.php");
			echo "This username does not exist";
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPasswordCheck = password_verify($password, $row['password']);
				if ($hashedPasswordCheck == false) {
					header("location: login.php");
					echo "This password does not match our records";
					exit();
				} elseif ($hashedPasswordCheck == true) {
						//log in the user here
						$_SESSION['username'] = $row['username'];
						$_SESSION['firstName'] = $row['firstName'];
						$_SESSION['middleName'] = $row['middleName'];
						$_SESSION['lastName'] = $row['lastName'];
						$_SESSION['dateOfBirth'] = $row['dateOfBirth'];
						$_SESSION['image'] = $row['image'];
						header("location: index.php");
						exit();
				}
			}
		}
	}
}

 ?>
