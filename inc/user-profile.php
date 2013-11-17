<?php include("header.php"); ?>
<h2 class="nusblue">User Profile</h2></br>

<?php
	if($_SESSION['username']) {
		$conn = setup_db();

		$flagId = $flagName = $flagPass1 = $flagPass2 = "";
		$pass1 = $pass2 = "";
		$id = $_SESSION['username'];
		$name = $_SESSION['name'];

		if(isset($_POST['updateUser'])) {
			if(empty($_POST['name'])) {
				$flagName = "*required";
			} else {
				$name = $_POST['name'];
			}
			if(empty($_POST['password1'])) {
				$flagPass1 = "*required";
			} else {
				$pass1 = $_POST['password1'];
			}
			if(empty($_POST['password2'])) {
				$flagPass2 = "*required";
			} else {
				$pass2 = $_POST['password2'];
				if($pass1 != $pass2 && isset($_POST['password1'])) {
					?>
					<div class="alert alert-danger alert-dismissable">
		  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo "Passwords don't match"; ?>
					</div>
					<?php
				}
			}
		}

		if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['password1']) && $pass1 == $pass2 && $pass1 != "") {
			$query = "SELECT count(*) FROM user u 
					  WHERE u.user_id = '".$id."';";
			$result = mysql_query($query);
			$countUser = mysql_fetch_row($result);
			$countUser = $countUser[0];

			if($countUser != 0) {
				$query = "UPDATE user u SET u.is_admin = 0,
						  u.password = '".md5($pass1)."', 
						  u.name = '".$name."'  
						  WHERE u.user_id = '".$id."' ;";
				$resultQuery = mysql_query($query);
			}

			if($resultQuery) {
				?>
				<div class="alert alert-success alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo $name.", your profile has been successfully updated"; ?>
				</div>
				<?php
				$_SESSION['name'] = $name;
			} else {
				?>
				<div class="alert alert-danger alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "Sorry ".$name.", we could not update your profile"; ?>
				</div>
				<?php
			}
		}
		close_db($conn);
?>

<form class="form-horizontal" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Change Name: </label>
		<input class="form-control" style="width:200px" type="text" name="name" value="<?php echo $name; ?>" />
		<h5 class='warningred'><?php echo $flagName; ?></h5>
	</div>
	<div class="form-group">
		<label for="password1" class="col-sm-2 control-label">Password: </label>
		<input class="form-control" style="width:200px" type="password" name="password1" value="<?php echo $pass1; ?>" />
		<h5 class='warningred'><?php echo $flagPass1; ?></h5>
	</div>
	<div class="form-group">
		<label for="password2" class="col-sm-2 control-label">Confirm Password: </label>
		<input class="form-control" style="width:200px" type="password" name="password2" value="<?php echo $pass2; ?>" />
		<h5 class='warningred'><?php echo $flagPass2; ?></h5>
	</div>
	<input class="form-control" style="width:200px" type="hidden" name="id" value="<?php echo $_SESSION['username']; ?>" />
	<button style="margin-left:165px;" type="submit" class="btn btn-primary btn-lg" name="updateUser">Update Profile</button>
</form>




<?php
	} else {
		?>
		<script>window.location.href = "/cs2102/inc/login.php"; </script>
		<?php
	}
?>

<?php include("footer.php"); ?>