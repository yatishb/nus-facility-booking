<?php include("header.php"); ?>
<h2 class="nusblue">Remove Facility</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();

		$query = "SELECT count(*) FROM region;";
		$result = mysql_query($query);
		$countRegion = mysql_fetch_row($result);
		$countRegion = $countRegion[0];

		$regions = getAllRegions();

		$flag = "";	
		$idRegion = "base";
		$success = false;
		$name = NULL;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['showAll'])){
				$idRegion = $_POST['region'];
				if($idRegion == "base"){
					$flag = "*required";
				}
			}

			//Process the facility that has been chosen to be deleted
			if(isset($_POST['idFac'])){
				$idFac = $_POST['idFac'];
				$idRegion = $_POST['idRegion'];
				$query = "SELECT name 
						  FROM facility 
						  WHERE fac_id =".$idFac." AND reg_id =".$idRegion.";";
				$result = mysql_query($query);
				$name = mysql_fetch_row($result);
				$name = $name[0];

				$query = "DELETE FROM facility 
						  WHERE fac_id = ".intval($idFac)." AND reg_id = ".intval($idRegion).";";
				$success = mysql_query($query);

				if($success) {
					?>
					<div class="alert alert-success alert-dismissable">
		  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo "Facility ".$name." has been successfully deleted"; ?>
					</div>
					<?php
				} else {
					?>
					<div class="alert alert-danger alert-dismissable">
		  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo "Facility ".$name." could not deleted"; ?>
					</div>
					<?php
				}
			}
		}

?>

<form class="form-inline" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<div class="form-group">
	<select class="form-control" style="width:200px;" id="rem-region"  name = "region" >
		<option select value="base">Select Region</option>
		<?php
			foreach($regions as $eachregion) {
				echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
			}
		?>
	</select>
	</div>
	<button class="btn btn-primary" type="submit" name="showAll">Show All Facilities</button></br>
	<?php if($flag != "") 
		{?><div class="alert alert-danger alert-dismissable">
  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $flag; ?>
		</div><?php } ?>
</form>
</br></br>


<?php
		if($idRegion != "base") {
			foreach($regions as $eachregion) {
				if($eachregion['id'] == $idRegion)
					$regName = $eachregion['region'];
			}

			$countFac = getNumberFacilitiesInRegion($idRegion);
			//If there are any facilities in the selected region, display them in a table format to delete
			if($countFac == 0) {
				if($name == NULL)
					echo "Sorry there is no facility in the region ".$regName;
			} else {
				//Display all the facilities present in the region and allow deletion
				$facilities = getFacilityInRegion($idRegion);
				?>

				<!-- Display table -->
				<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
				<table class="table" style="width:300px">
				<?php
					foreach($facilities as $eachFac) {
						?><tr>
							<td> <h4><span class='label label-default'><?php echo $eachFac['facility']; ?></span></h4> </td>
							<td style="padding-top:18px"> <button class="btn btn-danger btn-xs" type="submit" name="idFac" value="<?php echo $eachFac['id']; ?>">Delete</button></td>
						</tr><?php	
					}
				?>	
				</table>
				<input type="hidden" name="idRegion" value=<?php echo $idRegion ?> />
				</form>
				<?php
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