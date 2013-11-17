<?php include("header.php"); ?>
<h2 class="nusblue">View All Facilities in Region</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();

		$regions = getAllRegions();

		$flag = "";
		$idRegion = "base";
		$name = NULL;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['showAll'])){
				$idRegion = $_POST['region'];
				if($idRegion == "base"){
					$flag = "*required";
				}
			}

			if(isset($_POST['delFac'])) {
				$idFac = $_POST['delFac'];
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
			}

			if(isset($_POST['viewFac'])) {

			}
		}

?>


<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	<label> Select a region : </label>
	<select name = "region" >
		<option select value="base">Please Select</option>
		<?php
			foreach($regions as $eachregion) {
				echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
			}
		?>
	</select><?php echo $flag; ?></br>
	<button type="submit" name="showAll">Show All Facilities</button>
</form>




<?php
		if($idRegion != "base") {
			foreach($regions as $eachregion) {
				if($eachregion['id'] == $idRegion)
					$regName = $eachregion['region'];
			}

			$countFac = getNumberFacilitiesInRegion($idRegion);
			//If there are any facilities in the selected region, list them in a table format
			if($countFac == 0) {
				echo "Sorry there is no facility in the region ".$regName;
			} else {
				echo "Facilities in ".$regName." :";
				//Display all the facilities present in the region and allow deletion
				$facilities = array();
				$facilities = getAllAcademicFacilitiesInRegion($idRegion, $facilities);
				$facilities = getAllSportsFacilitiesInRegion($idRegion, $facilities);
				?>

				<!-- Display table --></br>
				<table>
				<tr>
					<th style='padding:5px 10px 5px 5px'>Name</th>
					<th style='padding:5px 10px 5px 5px'>Opening Time</th>
					<th style='padding:5px 10px 5px 5px'>Closing Time</th>
					<th style='padding:5px 10px 5px 5px'>Capacity</th>
					<th style='padding:5px 10px 5px 5px'>Whiteboard</th>
					<th style='padding:5px 10px 5px 5px'>Audio System</th>
					<th style='padding:5px 10px 5px 5px'>Projector</th>
					<th style='padding:5px 10px 5px 5px'>Scoreboard</th>
					<th style='padding:5px 10px 5px 5px'>Spectator Area</th>
				</tr>
				<?php
					foreach($facilities as $eachFac) {
						?><tr>
							<td style='padding:5px 10px 5px 5px'> <?php echo $eachFac['name']; ?> </td>
							<td style='padding:5px 10px 5px 5px'> <?php echo $eachFac['open']; ?> </td>
							<td style='padding:5px 10px 5px 5px'> <?php echo $eachFac['close']; ?> </td>
							<td style='padding:5px 10px 5px 5px'> <?php echo $eachFac['capacity']; ?> </td>
							<?php
								if($eachFac['whiteboard'] == 1)
								{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10004;</td>
								<?php }else{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10008;</td>
								<?php }
							?>
							<?php
								if($eachFac['audio'] == 1)
								{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10004;</td>
								<?php }else{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10008;</td>
								<?php }
							?>
							<?php
								if($eachFac['projector'] == 1)
								{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10004;</td>
								<?php }else{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10008;</td>
								<?php }
							?>
							<?php
								if($eachFac['scoreboard'] == 1)
								{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10004;</td>
								<?php }else{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10008;</td>
								<?php }
							?>
							<?php
								if($eachFac['spectator'] == 1)
								{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10004;</td>
								<?php }else{ ?>
									<td style='padding:5px 10px 5px 5px'>&#10008;</td>
								<?php }
							?>
							<td> <form action="view-facility-details.php" method="POST">
								<button type="submit" name="facility" value="<?php echo $eachFac['id']; ?>">View Details</button>
								<input type="hidden" name="region" value=<?php echo $idRegion ?> />
								</form></td>
							<td> <form action="modify-facility.php" method="POST">
								<button type="submit" name="editFac" value="<?php echo $eachFac['id']; ?>">Edit</button>
								<input type="hidden" name="editReg" value=<?php echo $idRegion ?> />
								</form></td>
							<td> <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
								<button type="submit" name="delFac" value="<?php echo $eachFac['id']; ?>">Delete</button>
								<input type="hidden" name="idRegion" value=<?php echo $idRegion ?> />
								</form></td>
						</tr><?php	
					}
				?>	
				</table>
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
	<button style="margin-left:167px;" type="submit" class="btn btn-warning btn-xs" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>