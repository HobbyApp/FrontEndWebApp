<?php require('password.php');
      include('server.php');
 ?>

<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="createaccountstyle.css">
</head>
<div>
<!-- multistep form -->
<form method="post" action="login.php" id="msform" enctype="application/x-www-form-urlencoded">
  <?php include('errors.php'); ?>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Login to Your Account</h2>
    <input type="text" name="username" placeholder="Username" />
    <input type="password" name="lpass" placeholder="Password" />
    <button type="submit" name="login" class="login action-button">Login</button><br><br>
  </fieldset>
</form>
<center><div class="fs-title">
<p>
  		Not yet a member?<br><a href="createaccount.php">Sign up</a>
  	</p>
</div></center>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript" src="createaccount.js"></script>


</html>
