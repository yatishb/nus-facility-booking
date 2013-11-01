<?php include("header.php"); ?>

<script>
document.getElementById("mastlink-login").className = "active";
</script>

<?php
if (!isset($_SESSION['username'])) {
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
			}
			else
			{
				echo("<p>Password doesn't match. Try again! </p>");
				unset($_SESSION['username']);
				unset($_SESSION['name']);
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
<div class = "span10 center">
<div class = "row center">
	<div class = "span4 offset2 border-right">
	  <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" name = "username-login" class="input-block-level" placeholder="Matric number">
        <input type="password" name = "pass-login" class="input-block-level" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Login</button>
      </form>
	</div>
	<div class = "span4">
	  <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Register</h2>
        <input type="text" name = "name-register" class="input-block-level" placeholder="Name">
        <input type="text" name = "username-register" class="input-block-level" placeholder="Matric No">
        <input type="password" name = "pass1-register" class="input-block-level" placeholder="Password">
        <input type="password" name = "pass2-register" class="input-block-level" placeholder="Confirm Password">
        <label class="checkbox">
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign Up</button>
      </form>
	</div>
</div>
</div>
</div>

<?php } else{ ?>
<script>window.location.href = "/cs2102/index.php"; </script>
<?php	 } ?>


<?php include("footer.php"); ?>