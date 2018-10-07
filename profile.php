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
      <var id="lastName">Steward</var><br>
    <label for="userHobbies">Your Hobbies:</label>
      <ul id="userHobbies">
      <li>Hobby</li>
      <li>Hobby</li>
      <li>Hobby</li>
      <li>Hobby</li>
      </ul>
<!-- Opens to allow user to edit their personal information-->
</div></center>
  <form style="display:none;" id="userInfoForm">
    <fieldset>
    <center><p>Edit User Information</p></center>
    <input type="text" value="First Name"><br>
    <input type="text" value="Last Name"><br>
    <input type="text" value="Add Hobby Here">
          <input list="readFormHobbyList" name="readFormHobbyList">
        <?php
            $db_host = '127.0.0.1'; // Server Name
            $db_user = 'root'; // Username
            $db_pass = 'password'; // Password
            $db_name = 'mydb'; // Database Name

            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if (!$conn) {
              die ('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            $hobbyQuery = "SELECT hobby FROM hobbies";
            $hobbyResult = mysqli_query($conn, $hobbyQuery);

            echo '<datalist name="readFormHobbyList" id="readFormHobbyList">';

            while ($row = mysqli_fetch_array($hobbyResult)) {
              echo '<option value="'.$row['hobby'].'">'.$row['hobby'].'</option>';
            }
            echo '</datalist>';
        ?>
      </input>

    <input list="writeFormHobbyList" name="writeFormHobbyList">
    <?php
    /*
        $db_host = '127.0.0.1'; // Server Name
        $db_user = 'root'; // Username
        $db_pass = 'password'; // Password
        $db_name = 'mydb'; // Database Name

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
          die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        $writeSQL = "UPDATE hobby SET hobbies";
        $writeResult = mysqli_query($conn, $writeSQL);

        echo '<datalist name="writeFormHobbyList" id="writeFormHobbyList">';

        while ($row = mysqli_fetch_array($hobbyResult)) {
          echo '<option value="'.$row['hobby'].'">'.$row['hobby'].'</option>';
        }
        echo '</datalist>'; */
    ?>
  </input>
    <label for="inputBirthday">What is your date of birth?</label><br>
    <input type="date" id="inputBirthday"></input><br>
    <center><input type="submit"></center>
  </fieldset></form>
</body>


<footer>

</footer>
<script src="profile.js"></script>
</html>
