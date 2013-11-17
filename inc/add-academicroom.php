<?php include("header.php"); ?>
<h2 class="nusblue">Add New Facility</h2><br>

<?php
	include("admin-functions.php");
	$conn = setup_db();

	$regions = getAllRegions();


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
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time, name, type) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."','".$fac."','academic');";
					$success1 = mysql_query($insertQuery1);
				} else {
					$insertQuery1 = "INSERT INTO facility(fac_id, reg_id, open_time, close_time, capacity, name, type) 
						VALUES(".$fac_id.",".$reg_id.", '".$open."', '".$close."',".$capacity.",'".$fac."','academic');";
					$success1 = mysql_query($insertQuery1);
				}
				$insertQuery2 = "INSERT INTO academic(fac_id, reg_id, whiteboard, audio_system, projector) 
					VALUES(".$fac_id.",".$reg_id.", ".$whiteboard.", ".$audio.",".$proj.");";
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




<form class="form-horizontal" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
 
	<div class="form-group">
	<label for="region" class="col-sm-2 control-label">Region : </label>
	<div class="col-sm-6">
	<select class="form-control" id="region" name = "region">
		<?php
		foreach($regions as $eachregion) {
			echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
		}
		?>
	</select>
	</div>
	</div>
	
	<div class="form-group">
	<label for="facility" class="col-sm-2 control-label">New Facility : </label>
	<div class="col-sm-6">
	<input class="form-control" id="facility"  type="text" name="facility" placeholder="new facility name" />
		<?php echo $err_fac; ?>
	</div>
	</div>
	
	<div class="form-group">
	<label for="optime" class="col-sm-2 control-label">Opening Time : </label>
	<div class="col-sm-6">
	<input class="form-control" style="width:200px;" id="optime" type="text" name="opening"/>
		<?php echo $err_open; ?>
	</div>
	</div>
	
	<div class="form-group">
	<label for="cltime" class="col-sm-2 control-label">Closing Time : </label>
	<div class="col-sm-6">
	<input class="form-control" style="width:200px;" id="cltime" type="text" name="closing"/>
		<?php echo $err_close; ?>
	</div>
	</div>
	
	<div class="form-group">
	<label for="capacity" class="col-sm-2 control-label">Capacity: </label>
	<div class="col-sm-6">
	<input class="form-control" style="width:200px;" id="capacity" type="text" style="width:200px" name="capacity" placeholder="capacity of the facility" />
	</div>
	</div>
	
<hr>
	
	<div style="margin-left:75px;">
	<label>Whiteboard : </label>
	<input type="radio" name="whiteboard" value="yes"> Yes
	<input type="radio" name="whiteboard" value="no"> No
		<?php echo $err_white; ?>
	</div></br>
	<div style="margin-left:75px;">
	<label>Audio System : </label>
	<input type="radio" name="audio" value="yes"> Yes
	<input type="radio" name="audio" value="no"> No
		<?php echo $err_audio; ?>
	</div></br>
	<div style="margin-left:75px;">
	<label>Projector : </label>
	<input type="radio" name="projector" value="yes"> Yes
	<input type="radio" name="projector" value="no"> No
		<?php echo $err_proj; ?>
	</div></br>
	<div class="form-group">
	<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary" name="create">Create New Facility</button>
	</div>
	</div>
</form>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($success1 && $success2 && isset($_POST["create"])) {
		echo "The Academic room ".$fac." has been successfully created";
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
	<button style="margin-left:165px;" type="submit" class="btn btn-default" name="back">BACK</button>
</form>
<?php include("footer.php"); ?>