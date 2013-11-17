<?php include("header.php"); ?>
<h2>Add New Region</h2>

<?php
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
	New Region Name : <input type="text" style="width:200px" name="newregion" placeholder="new region" />
		<?php echo $regionErr; ?></br>
	Location : <input type="text" style="width:200px" name="location" placeholder="location of the new region" />
		<?php echo $locationErr; ?></br></br>
	<button type="submit" name="create">Create New Region</button>
</form>


<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:165px;" type="submit" class="btn btn-default btn-sm" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>