<?php include("header.php"); ?>
<h2 class="nusblue">Remove Region</h2></br>

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
		$id = "base";
		$name = "Please select";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['delete'])){
				$id = $_POST['region'];
				if($id == "base"){
					$flag = "*required";
				}
				foreach($regions as $eachregion) {
					if($eachregion['id'] == $id)
						$name = $eachregion['region'];
				}
			}
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['confirm'])){
				$idDelete = $_POST['id2'];
				if($idDelete != "base") {
					$query = "DELETE FROM region 
							  WHERE reg_id = ".intval($idDelete).";";
					$result = mysql_query($query);
					foreach($regions as $eachregion) {
						if($eachregion['id'] == $idDelete)
							$name = $eachregion['region'];
					}
					if($result) {
						?>
						<div class="alert alert-success alert-dismissable">
			  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $name." has been successfully deleted"; ?>
						</div>
						<?php
						$regions = getAllRegions();
					} else {
						?>
						<div class="alert alert-danger alert-dismissable">
			  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $name." could not be deleted"; ?>
						</div>
						<?php
					}
				}
			}
		}

?>


<form class="form-inline" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<div class="form-group"> 
	<label class="sr-only" for="rem-region"> Select Region to be deleted : </label>
	<select class="form-control" style="width:200px;" id="rem-region"  name = "region" >
		<option select value="base">Please Select</option>
		<?php
			foreach($regions as $eachregion) {
				echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
			}
		?>
	</select><?php echo $flag; ?>
	</div>
	<button class="btn btn-primary" type="submit" name="delete">Delete</button>
</form>
<br><br>

<?php
		if($id != "base"){
			$countFac = getNumberFacilitiesInRegion($id);
			if($countFac > 0) {
				$facility = getFacilityInRegion($id);

				echo "<h5 class='warningred'>The following facilities will also be removed upon removing the region ".$name." </h5>";
				echo "<ul>";
				foreach ($facility as $eachfac) {
					echo "<li><span class='label label-default'>".$eachfac['facility']."</span></br>";
				}
				echo "</ul></br>";
			} else {
				echo "<h4>There are no other facilities in this region ".$name."</h4>";
			}
		}

		close_db($conn);
		if($id != "base") {
			?>
			<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
				<button type="submit" class="btn btn-danger btn-lg" name="confirm">Confirm</button>
				<input type="hidden" name="id2" value=<?php echo $id ?> />
			</form><br>
			<?php
		}
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