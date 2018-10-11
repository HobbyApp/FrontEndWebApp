<!DOCTYPE html>
<html lang="en">
<title>Hobby Profile</title>
<head>
  <link rel="stylesheet" type="text/css" href="profile.css">
</head>

<header>

</header>


<body>
  <div class="container">
    <img id="profilePic" src="https://placeimg.com/240/240/people/grayscale" class="ribbon">
    <button type="button" id="editButton" onclick="openEditInfoForm()"></button>

  </div>
  <!--User form that displays current user profile information -->
  <center><div id="userProfile">
    <label for="name">Hello! Welcome to your profile</label>
      <var id="firstName">Conor</var>
      <var id="middleName">Collin</var>
      <var id="lastName">Steward</var><br>
    <label for="userHobbies">Your Hobbies:</label>
    <?php
        $db_host = '127.0.0.1'; // Server Name
        $db_user = 'root'; // Username
        $db_pass = 'password'; // Password
        $db_name = 'mydb'; // Database Name

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
          die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        $hobbyQuery = "SELECT hobbies FROM hobbies";
        $hobbyResult = mysqli_query($conn, $hobbyQuery);
//a list of added hobbies
        echo '<ul id="userHobbies">';

        while ($row = mysqli_fetch_array($hobbyResult)) {
          echo '<li value="'.$row['hobbies'].'">'.$row['hobbies'].'</li>';
        }
        echo '</ul>';
    ?>
<!-- Opens to allow user to edit their personal information-->
</div></center>
  <form style="display:none;" id="userInfoForm">
    <fieldset>
    <center><p>Edit User Information</p></center>
    <input type="text" placeholder="Change First Name" name="firstName">
    <input type="text" placeholder="Change Middle Name" name="middleName">
    <input type="text" placeholder="Change Last Name" name="lastName"><br>
    <input type="text" placeholder="Change Username" name="username"><br>
    <input type="password" placeholder="Password" id="password">
    <input type="password" placeholder="Confirm Password" id="confirm_password"><br>
    <input list="readFormHobbyList" name="readFormHobbyList" placeholder="Add New Hobby">
        <?php
            $db_host = '127.0.0.1'; // Server Name
            $db_user = 'root'; // Username
            $db_pass = 'password'; // Password
            $db_name = 'mydb'; // Database Name

            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if (!$conn) {
              die ('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

            $hobbyQuery = "SELECT hobbies FROM hobbies";
            $hobbyResult = mysqli_query($conn, $hobbyQuery);

            echo '<datalist name="readFormHobbyList" id="readFormHobbyList">';

            while ($row = mysqli_fetch_array($hobbyResult)) {
              echo '<option value="'.$row['hobbies'].'">'.$row['hobbies'].'</option>';
            }
            echo '</datalist>';

            // updates users name, username and password
            $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
            $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
            $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            // Capturing dateOfBirth from the user
            $dateOfBirth= mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
            // Converting date to MySQL readable format - you must use the $date variable, not the one above or MySQL will throw an error
            $date=date("Y-m-d",strtotime($dateOfBirth));
            $newHobby = mysqli_real_escape_string($conn, $_POST['readFormHobbyList']);



            if (isset($_POST['updateUserInfo'])) {

              // the path to store the uploaded image
              $target = "images/".basename($_FILES['image']['name']);

              // Get all the submitted data from the form
              $image = $_FILES['image']['name'];

              $hobbyTarget = $_POST['hobbySelector'];

              // Attempt insert query execution
              $sql = "UPDATE users (firstName, middleName, lastName, dateOfBirth, profilePicture, username, password, hobbies)
                      VALUES ('$firstName', '$middleName', '$lastName', '$dateOfBirth', '$image', '$username', '$password', '$newHobby')";



              mysqli_query($conn, $sql); //stores the submitted data into the database table
            }
        ?>
      </input><br>

    <label for="inputBirthday">What is your date of birth?</label><br>
    <input type="date" id="inputBirthday"></input><br>
    <center><input type="submit" name="updateUserInfo"></center>
  </fieldset></form>
</body>


<footer>

</footer>
<script src="profile.js"></script>
</html>
