<?php include("header.php"); ?>
<h2 class="nusblue">Add New Admin</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();

		$flagId = $flagName = $flagPass1 = $flagPass2 = "";
		$id = $name = $pass1 = $pass2 = "";

		if(isset($_POST['createAdmin'])) {
			if(empty($_POST['id'])) {
				$flagId = "*required";
			} else {
				$id = $_POST['id'];
			}
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
					$flagPass2 = "passwords don't match";
				}
			}
		}
?>

<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
	User Id: <input type="text" name="id" placeholder="must be 8 characters" value="<?php echo $id; ?>" /><?php echo $flagId; ?></br>
	Name: <input type="text" name="name" value="<?php echo $name; ?>" /><?php echo $flagName; ?></br>
	Password: <input type="password" name="password1" value="<?php echo $pass1; ?>" /><?php echo $flagPass1; ?></br>
	Confirm Password: <input type="password" name="password2" value="<?php echo $pass2; ?>" /><?php echo $flagPass2; ?></br>
	<button type="submit" name="createAdmin">Create New Admin</button>
</form>




<?php
		if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['password1']) && $pass1 == $pass2 && $pass1 != "") {
			$query = "SELECT count(*) FROM user u 
					  WHERE u.user_id = '".$id."';";
			$result = mysql_query($query);
			$countUser = mysql_fetch_row($result);
			$countUser = $countUser[0];

			if($countUser == 0) {
				$query = "INSERT INTO user(user_id, name, password, is_admin) 
						  VALUES('".$id."','".$name."','".md5($pass1)."',1);";
				$resultQuery = mysql_query($query);
			} else {
				$query = "UPDATE user u SET u.is_admin = 1 
						  WHERE u.user_id = '".$id."' ;";
				$resultQuery = mysql_query($query);
			}

			if($resultQuery) {
				echo $name." has been successfully added as an admin";
			} else {
				echo $name." could not be added as an admin";
			}
		}
		close_db($conn);
	} else {
		header("Location: /cs2102/inc/login.php");
	}
?>

</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:165px;" type="submit" class="btn btn-default btn-sm" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>