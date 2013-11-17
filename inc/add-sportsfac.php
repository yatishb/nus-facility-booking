<?php include("header.php"); ?>
<h2 class="nusblue">Add New Facility</h2></br>

<?php
	if($_SESSION['admin']) {
		include("admin-functions.php");
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

		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
			if($success1 && $success2 && isset($_POST["create"])) {
				?>
				<div class="alert alert-success alert-dismissable">
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo "The Sports Facility ".$fac." has been successfully created"; ?>
				</div>
				<?php
			} else {
				?>
				<div class="alert alert-danger alert-dismissable">
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo "Could not create the sports facility"; ?>
				</div>
				<?php
				if($success1 == 1) {
					$query = "DELETE FROM facility WHERE fac_id = ".$fac_id;
					mysql_query($query);
				} else {
					$query = "DELETE FROM sports WHERE fac_id = ".$fac_id;
					mysql_query($query);
				}
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
        <input class="form-control" id="facility" type="text" name="facility" placeholder="new facility name" />
                <?php echo $err_fac; ?>
        </div>
        </div>
        
        <div class="form-group">
        <label for="optime" class="col-sm-2 control-label">Opening Time : </label>
        <div class="col-sm-6">
        <input class="form-control" style="width:200px;" id="optime" type="time" name="opening"/>
                <?php echo $err_open; ?>
        </div>
        </div>
        
        <div class="form-group">
        <label for="cltime" class="col-sm-2 control-label">Closing Time : </label>
        <div class="col-sm-6">
        <input class="form-control" style="width:200px;" id="cltime" type="time" name="closing"/>
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

    <div style="margin-left:75px; margin-top:-40px;"> 
    <table>
    	<tr>   
		<td><label>Scoreboard : &nbsp&nbsp&nbsp</label></td>
		<td><input type="radio" name="scoreboard" value="yes"> Yes &nbsp&nbsp&nbsp</td>
		<td><input type="radio" name="scoreboard" value="no"> No</td>
			<?php echo $err_score; ?>
		</tr></br>
		<tr>
		<td><label>Spectator Area : &nbsp&nbsp&nbsp</label></td>
		<td><input type="radio" name="spec" value="yes"> Yes &nbsp&nbsp&nbsp</td>
		<td><input type="radio" name="spec" value="no"> No</td>
			<?php echo $err_spec; ?>
		</tr></br>
	</table>
	</div><br>
	<div class="form-group">
	<div class="col-sm-offset-2 col-sm-6">
	<button type="submit" class="btn btn-primary btn-lg" name="create">Create New Facility</button>
	</div>
	</div>
</form>

<?php
	} else {
		?>
		<script>window.location.href = "/cs2102/inc/login.php"; </script>
		<?php
	}
?>

</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:165px;" type="submit" class="btn btn-default btn-sm" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>