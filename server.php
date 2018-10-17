<?php
require('password.php');
session_start();

// initializing variables
//$username = "";
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
  $password_1 = ($_POST['pass']);
  $password_2 = ($_POST['cpass']);
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
    $auth = "SELECT * FROM users WHERE username='$username' AND password='$hashToStoreInDb'";
  	$results = mysqli_query($db, $auth);
  	if (password_verify($password_1, $hashToStoreInDb)) {
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  } else {
    array_push($errors, "Insertion was not successful");
  }
} else {
  echo "You have made a grave mistake";
}

// LOGIN USER
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $passwordLogin = $_POST['lpass'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($passwordLogin)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {

      	 $authLogin = "SELECT password FROM users WHERE username='$username' AND password='$passwordLogin'";
    	   $resultLogin = mysqli_query($db, $authLogin);
      	if (password_verify($passwordLogin, $resultLogin)) {
      	  $_SESSION['username'] = $username;
      	  $_SESSION['success'] = "You are now logged in";
      	  header('location: index.php');
      	} else {
  		array_push($errors, "Wrong username/password combination");
    	}
    }
  }
}

 ?>
