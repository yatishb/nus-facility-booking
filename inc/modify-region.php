<?php include("header.php"); ?>
<h2 class="nusblue">Modify Region</h2></br>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();

		$result = 0;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//Will enter when the details for the region to be modified to have been entered
			if(isset($_POST['modify'])) {
				$id = $_POST['id'];
				$name = $_POST['newName'];
				$location = $_POST['newLocation'];

				$query = "UPDATE region r
						  SET r.name = '".$name."', r.location = '".$location."' 
						  WHERE r.reg_id = ".$id.";";
				$result = mysql_query($query);

				$_POST['editReg'] = $id;
				$_POST['regionSelect'] = "value";
			}
		}

		$regions = getAllRegions(); 

		$flag = "";
		$idRegion = "base";
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['regionSelect'])){
				$idRegion = $_POST['editReg'];
				if($idRegion == "base"){
					$flag = "*required";
				}
			}
		}

		if(isset($_POST['modify'])) {
			if($result) {
				?>
				<div class="alert alert-success alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The region has been successfully modified to ".$name; ?>
				</div>
				<?php
			} else {
				?>
				<div class="alert alert-danger alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The region ".$name." could not be modified"; ?>
				</div>
				<?php
			}
		}

?>


<form class="form-inline" role="form" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<div class="form-group">
	<label class="sr-only" for="editReg">Select Region:</label>
	<select class="form-control" style="width:200px;" id="editReg" name="editReg">
		<option select value="base">Please Select</option>
	<?php
		foreach ($regions as $row) {
			echo '<option value="', $row['id'], '">', $row['region'], '</option>';
		}
	?>
	</select>
	</div>
	<button class="btn btn-primary" type = "submit" name="regionSelect">Edit Region</button>
</form>

<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			
			//will enter when the region to be modified has been selected
			if(isset($_POST['regionSelect'])){
				$idRegion = $_POST['editReg'];
				if($idRegion != "base"){
					$query = "SELECT r.name, r.location
							  FROM region r
							  WHERE r.reg_id = ".$idRegion.";";
					$result = mysql_query($query);
					$row = mysql_fetch_row($result);
					$region = array(
									'id' => $idRegion,
									'name' => $row[0],
									'location' => $row[1]
									);

					?><br><br>
					<form class="form-horizontal" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
						<div class="form-group">
						<label for="regionname" class="col-sm-2 control-label">Region Name</label>
						<div class="col-sm-6">
						<input class="form-control" style="width:200px" id="regionname" type = "text" name = "newName" value = "<?php echo $region['name']; ?>" />
						</div>
						</div>
						<div class="form-group">
						<label for="regionloc" class="col-sm-2 control-label">Region Location</label> 
						<div class="col-sm-6">
						<input class="form-control" style="width:200px" id="regionloc" type = "text" name = "newLocation" value = "<?php echo $region['location']; ?>" />
						</div>
						</div>
						<input type = "hidden" name = "id" value = "<?php echo $region['id']; ?>" />
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-6">
						<button class="btn btn-lg btn-danger" type = "submit" name = "modify">Modify Region</button>
						</div>
						</div>
					</form>
					<?php
				}
			}
		}

		close_db($conn);
	} else {
		?>
		<script>window.location.href = "/cs2102/inc/login.php"; </script>
		<?php
	}
?>

</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button type="submit" class="btn btn-warning btn-xs" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>