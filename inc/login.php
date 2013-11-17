<?php include("header.php"); ?>

<script>
document.getElementById("mastlink-login").className = "active";
</script>

<?php
if(isset($_GET['bookstart']))
{
	$bookstart = $_GET['bookstart'];
	$bookend = $_GET['bookend'];
	$bookfac = $_GET['bookfac'];
	$bookreg = $_GET['bookreg'];
}
?>

<?php
if(isset($_POST['bookstart']))
{
	$bookstart = $_POST['bookstart'];
	$bookend = $_POST['bookend'];
	$bookfac = $_POST['bookfac'];
	$bookreg = $_POST['bookreg'];
}
?>

<?php
if(isset($_POST['username-login']))
{
	$username_login = $_POST['username-login'];
	$pass_login = md5($_POST['pass-login']);
	$con= setup_db();
	$email = mysql_real_escape_string($username_login);

	$query = mysql_query("SELECT * FROM user WHERE user_id='$username_login'");
	$count = mysql_num_rows($query);
	if($count==1)
	{
		while($row = mysql_fetch_array($query))
		{
			if($row['password']==$pass_login)
			{
				$_SESSION['username'] = $row['user_id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['admin'] = $row['is_admin'];
			}
			else
			{
				echo("<p>Password doesn't match. Try again! </p>");
				unset($_SESSION['username']);
				unset($_SESSION['name']);
				unset($_SESSION['admin']);
			}
		}
	}
	else{
		echo("<p>User email does not exist. Please register a new account. </p>");
	}
	close_db($con);
}
?>

<?php

if(isset($_POST['username-register']))
{
	$name_register = $_POST['name-register'];
	$username_register = $_POST['username-register'];
	$pass1 = md5($_POST['pass1-register']);
	$pass2 = md5($_POST['pass2-register']);
	$con= setup_db();
	$name = mysql_real_escape_string($name_register);
	$email = mysql_real_escape_string($username_register);
	

	$query = mysql_query("SELECT user_id FROM user WHERE user_id='$username_register'");
	$count = mysql_num_rows($query);
	if($pass1 == $pass2){
		if($count)
		{
			echo("<div style='color:#3379f0;'>User email already exists!</div><br>");
		}
		else{
			mysql_query("INSERT INTO user(user_id, name, password, is_admin) VALUES ('$username_register', '$name_register', '$pass1', 0)");
			echo("<div style='color:#3379f0;'>Successfully Registered! Proceed to login -></div><br>");
		}
	} else {
		echo("<div style='color:#3379f0;'>Passwords don't match!</div><br>");
	}
	close_db($con);
}
?>


<div class = "row center">
<div class = "col-md-10 center">
<div class = "row center">
	<div class = "col-md-4 col-md-offset-2 border-right">
	  <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading nusblue">Login</h2>
        <input type="text" name = "username-login" class="form-control" placeholder="Matric number">
        <input type="password" name = "pass-login" class="form-control" placeholder="Password">
        <input type="hidden" name = "bookstart" value = <?php echo $bookstart ?>>
        <input type="hidden" name = "bookend" value = <?php echo $bookend ?>>
        <input type="hidden" name = "bookfac" value = <?php echo $bookfac ?>>
        <input type="hidden" name = "bookreg" value = <?php echo $bookreg ?>>
        <br>
        <button class="btn btn-warning" type="submit">Login</button>
      </form>
	</div>
	<div class = "col-md-4">
	  <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading nusblue">Register</h2>
        <input type="text" name = "name-register" class="form-control" placeholder="Name">
        <input type="text" name = "username-register" class="form-control" placeholder="Matric No">
        <input type="password" name = "pass1-register" class="form-control" placeholder="Password">
        <input type="password" name = "pass2-register" class="form-control" placeholder="Confirm Password"><br>
        <button class="btn btn-warning" type="submit">Sign Up</button>
      </form>
	</div>
</div>
</div>
</div>

<?php if (isset($_SESSION['username']) && !isset($_POST['bookstart'])) { ?>
<script>window.location.href = "/cs2102/index.php"; </script>
<?php } else if (isset($_SESSION['username']) && isset($_POST['bookstart'])) { ?>
<script>window.location.href = "/cs2102/inc/book-facility.php?bookstart=<?php echo $bookstart; ?>&bookend=<?php echo $bookend; ?>&bookfac=<?php echo $bookfac; ?>&bookreg=<?php echo $bookreg; ?>"; </script>
<?php } ?>

<?php include("footer.php"); ?>