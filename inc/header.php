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
  </head>

  <body>

      <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li id="mastlink-home"><a href="/cs2102/index.php">Home</a></li>
          <?php
	          if (isset($_SESSION['username'])) {
	      ?>
	        <li id="mastlink-login"><a href="">Hi <?php echo $_SESSION['name']; ?>!</a></li>
	      <?php } else{ ?>
	      	<li id="mastlink-login"><a href="/cs2102/inc/login.php">Login</a></li>
	      <?php	 } ?>
        </ul>
        <h3 class="muted">NUS Bookings</h3>
      </div>
      <?php include("db-conn.php"); ?>
      <hr>
