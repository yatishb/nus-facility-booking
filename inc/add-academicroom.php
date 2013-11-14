<h2>Add New Facility</h2>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	$conn = setup_db();

	$query = "SELECT `reg_id`, name FROM `region`;";
	$result = mysql_query($query);
	$regions = array();
	while($rows = mysql_fetch_array($result)) {
		$eachregion = array(
						'id' => $rows[0],
						'region' => $rows[1]
						);
		array_push($regions, $eachregion);
	}


	$query = "SELECT max(fac_id) FROM facility;";
	$result = mysql_query($query);
	$rows = mysql_fetch_row($result);
	$fac_id = $rows[0]+1;

	$err_fac = $err_open = $err_close = $err_white = $err_audio = $err_proj = "";
	$fac = $open = $close = $capacity = $whiteboard = $proj = $audio = "";
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
			if(empty($_POST["whiteboard"])) {
				$err_white = "*required";
				$flag = false;
			} else {
				$whiteboard = decodeBoolean($_POST["whiteboard"]);
				$flag = true;
			}
			if(empty($_POST["projector"])) {
				$err_proj = "*required";
				$flag = false;
			} else {
				$proj = decodeBoolean($_POST["projector"]);
				$flag = true;
			}
			if(empty($_POST["audio"])) {
				$err_audio = "*required";
				$flag = false;
			} else {
				$audio = decodeBoolean($_POST["audio"]);
				$flag = true;
			}

			if($flag) {
				$reg_id = $_POST["region"];
				if($capacity == NULL) {
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."');";
					$success1 = mysql_query($insertQuery1);
				} else {
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time, capacity) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."',".$capacity.");";
					$success1 = mysql_query($insertQuery1);
				}
				$insertQuery2 = "INSERT INTO academic(fac_id, reg_id, whiteboard, audio_system, projector, type) 
					VALUES(".$fac_id.",".$reg_id.", ".$whiteboard.", ".$audio.",".$proj.",'".$fac."');";
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
	<input type="text" name="opening"/>
		<?php echo $err_open; ?></br>
	<label>Closing Time : </label>
	<input type="text" name="closing"/>
		<?php echo $err_close; ?></br>
	<label>Capacity: </label>
	<input type="text" style="width:200px" name="capacity" placeholder="capacity of the facility" />
		</br>
	<label>Whiteboard : </label>
	<input type="radio" name="whiteboard" value="yes">Yes
	<input type="radio" name="whiteboard" value="no">No
		<?php echo $err_white; ?></br>
	<label>Audio System : </label>
	<input type="radio" name="audio" value="yes">Yes
	<input type="radio" name="audio" value="no">No
		<?php echo $err_audio; ?></br>
	<label>Projector : </label>
	<input type="radio" name="projector" value="yes">Yes
	<input type="radio" name="projector" value="no">No
		<?php echo $err_proj; ?></br></br>
	<button type="submit" name="create">Create New Facility</button>
</form>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($success1 && $success2 && isset($_POST["create"])) {
		echo "The Academic room has been successfully created";
	} else {
		echo "Could not create the room";
		if($success1 == 1) {
			$query = "DELETE FROM facility WHERE fac_id = ".$fac_id;
			mysql_query($query);
		} else {
			$query = "DELETE FROM academic WHERE fac_id = ".$fac_id;
			mysql_query($query);
		}
	}

	if(isset($_POST["back"])){
		close_db($conn);
		header('Location: /cs2102/inc/admin-panel.php');
	}
}
?>




</br>
<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>