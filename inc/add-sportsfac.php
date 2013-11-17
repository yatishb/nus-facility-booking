<h2>Add New Facility</h2>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	include $root.'/cs2102/inc/admin-functions.php';
	$conn = setup_db();

	$regions = getAllRegions();


	$query = "SELECT max(fac_id) FROM facility;";
	$result = mysql_query($query);
	$rows = mysql_fetch_row($result);
	$fac_id = $rows[0]+1;

	$err_fac = $err_open = $err_close = $err_score = $err_spec = "";
	$fac = $open = $close = $capacity = $scoreboard = $spec = "";
	$flag = false;
	$success1 = $success2 = 0;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["create"])){
			if(empty($_POST["facility"])) {
				$err_fac = "*required";
				$flag = false;
			} else {
				$fac = $_POST["facility"];
				$flag = true;
			}
			if(empty($_POST["opening"])) {
				$err_open = "*required";
				$flag = false;
			} else {
				$open = $_POST["opening"];
				$flag = true;
			}
			if(empty($_POST["closing"])) {
				$err_close = "*required";
				$flag = false;
			} else {
				$close = $_POST["closing"];
				$flag = true;
			}
			if(empty($_POST["capacity"])) {
				$capacity = NULL;
			} else {
				$capacity = $_POST["capacity"];
				$flag = true;
			}
			if(empty($_POST["scoreboard"])) {
				$err_score = "*required";
				$flag = false;
			} else {
				$scoreboard = decodeBoolean($_POST["scoreboard"]);
				$flag = true;
			}
			if(empty($_POST["spec"])) {
				$err_spec = "*required";
				$flag = false;
			} else {
				$spec = decodeBoolean($_POST["spec"]);
				$flag = true;
			}

			if($flag) {
				$reg_id = $_POST["region"];
				if($capacity == NULL) {
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time, name, type) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."','".$fac."','sports');";
					$success1 = mysql_query($insertQuery1);
				} else {
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time, capacity, name, type) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."',".$capacity.",'".$fac."','sports');";
					$success1 = mysql_query($insertQuery1);
				}
				$insertQuery2 = "INSERT INTO sports(fac_id, reg_id, scoreboard, spectator_area) 
					VALUES(".$fac_id.",".$reg_id.", ".$scoreboard.", ".$spec.");";
				$success2 = mysql_query($insertQuery2);
			}
		}
	}


	function decodeBoolean($str) {
		if($str == "yes") {
			return 1;
		} else {
			return 0;
		}
	}

?>




<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	<label>Region : </label>
	<select name = "region">
		<?php
		foreach($regions as $eachregion) {
			echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
		}
		?>
		</select></br>
	<label>New Facility : </label>
	<input type="text" style="width:200px" name="facility" placeholder="new facility name" />
		<?php echo $err_fac; ?></br>
	<label>Opening Time : </label>
	<input type="time" name="opening"/>
		<?php echo $err_open; ?></br>
	<label>Closing Time : </label>
	<input type="time" name="closing"/>
		<?php echo $err_close; ?></br>
	<label>Capacity: </label>
	<input type="text" style="width:200px" name="capacity" placeholder="capacity of the facility" />
		</br>
	<label>Scoreboard : </label>
	<input type="radio" name="scoreboard" value="yes">Yes
	<input type="radio" name="scoreboard" value="no">No
		<?php echo $err_score; ?></br>
	<label>Spectator Area : </label>
	<input type="radio" name="spec" value="yes">Yes
	<input type="radio" name="spec" value="no">No
		<?php echo $err_spec; ?></br></br>
	<button type="submit" name="create">Create New Facility</button>
</form>



<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
		if($success1 && $success2 && isset($_POST["create"])) {
			echo "The Sports Facility ".$fac." has been successfully created";
		} else {
			echo "Could not create the sports facility";
			if($success1 == 1) {
				$query = "DELETE FROM facility WHERE fac_id = ".$fac_id;
				mysql_query($query);
			} else {
				$query = "DELETE FROM sports WHERE fac_id = ".$fac_id;
				mysql_query($query);
			}
		}

	}

	if(isset($_POST["back"])){
		close_db($conn);
		header('Location: /cs2102/inc/admin-panel.php');
	}
?>




</br>
<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>