<?php include("header.php"); ?>
<h2 class="nusblue">Add New Region</h2></br>

<?php
	if($_SESSION['admin']) {
	// define variables and set to empty values
		$newRegion = $location = "";
		$regionErr = $locationErr = "";
		$regionFlag = $locationFlag = FALSE;
		$sucess = 0;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["create"])) {
				if (empty($_POST["newregion"])) {
					$regionErr = "Region name is required";
					$regionFlag = $locationFlag = FALSE;
				} else {
					$newRegion= $_POST["newregion"];
					$regionErr = "";
					$regionFlag = TRUE;
				}

				if (empty($_POST["location"])) {
					$locationErr = "Region location is required";
					$regionFlag = $locationFlag = FALSE;
				} else {
					$location = $_POST["location"];
					$locationErr = "";
					$locationFlag = TRUE;
				}

			
				if($regionFlag && $locationFlag) {
					$conn = setup_db();

					$query = "SELECT max(reg_id) FROM region;";
					$result = mysql_query($query);
					$rows = mysql_fetch_row($result);

					$reg_id = $rows[0]+1;

					$insertQuery = "INSERT INTO region(reg_id, name, location) 
						VALUES(".$reg_id.", '".mysql_real_escape_string($newRegion)."', '".mysql_real_escape_string($location)."');";
					$sucess = mysql_query($insertQuery);

					close_db($conn);
				}
			}
		}

		if($sucess) {
			?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo "New Region ".$newRegion." has been added"; ?>
			</div>
			<?php
		}

		?>


<form class="form-horizontal" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	<div class="form-group">
		<label for="regionname" class="col-sm-2 control-label">New Region Name : </label>
		<div class="col-sm-6">
		<input class="form-control" type="text" style="width:200px" id="regionname" name="newregion" placeholder="new region" />
			<?php echo $regionErr; ?>
		</div>
	</div>
	<div class="form-group">
		<label for="location" class="col-sm-2 control-label">Address : </label>
		<div class="col-sm-6">
		<input class="form-control" type="text" style="width:200px" id="location" name="location" placeholder="address of the new region" />
			<?php echo $locationErr; ?>
		</div>
	</div></br>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
		<button type="submit" class="btn btn-primary btn-lg" name="create">Create New Region</button>
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


<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:168px;" type="submit" class="btn btn-warning btn-xs" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>