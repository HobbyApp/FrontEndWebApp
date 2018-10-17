<?php include('server.php') ?>

<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="createaccountstyle.css">
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="626007140443-0v0hs0t84c3gm9m7anlh2fl2l8o10j0n.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<div>
<!-- multistep form -->
<form method="post" action="login.php" id="msform" enctype="multipart/form-data">
  <?php include('errors.php'); ?>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Login to Your Account</h2>
    <input type="text" name="username" placeholder="Username" />
    <input type="password" name="lpass" placeholder="Password" />
    <button type="submit" name="login" class="login action-button">Login</button><br><br>

    <center><div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div></center>
    <script type="text/javascript">
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
       function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      };
    </script>

  </fieldset>


<!--  <fieldset>
    <h2 class="fs-title">Social Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset> -->
<!--  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>-->
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
