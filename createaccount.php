<?php include('server.php');
      require('password.php');
 ?>

<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="createaccountstyle.css">
</head>

<!-- multistep form -->
<form method="post" action="createaccount.php" id="msform" enctype="multipart/form-data">
  <?php include('errors.php'); ?>
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Create your account</h2>
    <h3 class="fs-subtitle">Join the Hobby Family</h3>
    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" />
    <input type="password" name="pass" placeholder="Password" />
    <input type="password" name="cpass" placeholder="Confirm Password" />
    <button type="button" name="next" class="next action-button">Next</button>
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell this</h3>
    <input type="text" name="firstName" placeholder="First Name" />
    <input type="text" name="middleName" placeholder="Middle Name or Initial" />
    <input type="text" name="lastName" placeholder="Last Name" />
    <p>Date of Birth</p>
    <input type="date" name="dateOfBirth" />
    <button type="button" name="previous" class="previous action-button">Previous</button>
    <button type="button" name="next" class="next action-button">Next</button>
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Add a Profile Picture!</h2>
    <h3 class="fs-subtitle">Put the Cherry on Top of your Profile</h3>
    <input type="file" name="image">
    <button type="button" name="previous" class="previous action-button">Previous</button>
    <button type="submit" name="register" class="submit action-button">Submit</button>
  </fieldset>
</form>
<center><div class="fs-title">
  <p>Already Have an Account?</p>
  <p><a href="login.php">Login</a></p>
</div></center>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="createaccount.js"></script>

</html>
