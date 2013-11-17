<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>NUS Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NUS Bookings">
    <meta name="author" content="@shekhar/anirup/yatish">

    <!--Style -->
    <link href="/cs2102/css/bootstrap.css" rel="stylesheet">
    <link href="/cs2102/css/style.css" rel="stylesheet">

    <!--Favicon -->
    <link rel="shortcut icon" href="">
    <script src="/cs2102/js/imagemapster.js"></script>
  </head>

  <body>
  	  <script src="https://code.jquery.com/jquery.js"></script>
	  <script src="/cs2102/js/bootstrap.js"></script>
	  <?php
	  	date_default_timezone_set('Singapore');
	  ?>
      <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li id="mastlink-home"><a href="/cs2102/index.php">Home</a></li>
          <?php
	          if (isset($_SESSION['username'])) {
	      ?>
	        <li class="dropdown">
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			      Hi <?php echo $_SESSION['name']; ?>! <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
			      <?php
			          if (($_SESSION['admin'])) {
			      ?>
			      <li><a href="/cs2102/inc/admin-panel.php">Admin Panel</a></li>
			      <?php } ?>
			      <li><a href="/cs2102/inc/user-bookings.php">Bookings</a></li>
			      <li><a href="/cs2102/inc/user-profile.php">Profile</a></li>
			      <li class="divider"></li>
			      <li><a href="/cs2102/inc/logout.php">Logout</a></li>
			    </ul>
			</li>
	      <?php } else{ ?>
	      	<li id="mastlink-login"><a href="/cs2102/inc/login.php">Login</a></li>
	      <?php	 } ?>
        </ul>
        <a id="logo" class="nodec" href="/cs2102/index.php"><img src = "/cs2102/img/logo.png" height="52" width="240"></a>
      </div>
      <?php include("db-conn.php"); ?>
      <hr>
