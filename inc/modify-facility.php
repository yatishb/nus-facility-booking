<?php include("header.php"); ?>
<h2 class="nusblue">Modify Facility</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();
		$regions = getAllRegions(); 

?>

<form class="form-inline" role="form" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<label for="editReg">Select Region:</label>
	<select class="form-control" style="width:200px;" id="editReg" name="editReg">
		<option select value="base">Select Region</option>
	<?php
		foreach ($regions as $row) {
			echo '<option value="', $row['id'], '">', $row['region'], '</option>';
		}
	?>
	</select>
	
	<label for="editFac">&nbsp&nbspSelect Facility:</label>
	<select class="form-control" style="width:200px;" id="editFac" name="editFac">
		<option>Select Facility</option>
	</select>
<button class="btn btn-primary" type="submit" value="Edit Facility">Edit Facility</button>
</form>


<script>
$("#editReg").change(function() {
var temp = (document.getElementById("editReg").value);
console.log(temp);
$("#editFac").load("getter-view-facility-details.php?choice=" +  temp);
});
</script>





<?php
		//******************************************************
		//This facility is to modify the facility according to the given values
		//******************************************************
		if(isset($_POST['modify'])) {
			$id = $_POST['idFac'];
			$type = $_POST['type'];
			$name = $_POST['newName'];
			$open = $_POST['newOpen'];
			$close = $_POST['newClose'];
			$capacity = $_POST['newCapacity'];

			$query = "UPDATE facility f SET f.name = '".$name."', 
					  f.open_time = '".$open."', f.close_time = '".$close."', f.capacity = ".$capacity." 
					  WHERE f.fac_id = ".$id.";";
			$result1 = mysql_query($query);

			if($type == 'academic') {

				$whiteboard = $_POST['newWhiteboard'];
				$audio = $_POST['newAudio'];
				$projector = $_POST['newProjector'];

				$query = "UPDATE academic a SET a.whiteboard = ".$whiteboard.", 
						  a.audio_system = ".$audio.", a.projector = ".$projector." 
						  WHERE a.fac_id = ".$id.";";
				$result2 = mysql_query($query);

			} else if($type == 'sports') {
				$scoreboard = $_POST['newScoreboard'];
				$spectator = $_POST['newSpectator'];

				$query = "UPDATE sports s SET s.scoreboard = ".$scoreboard.", 
						  s.spectator_area = ".$spectator."
						  WHERE s.fac_id = ".$id.";";
				$result2 = mysql_query($query);

			}

			if($result1 && $result2) {
				?>
				</br><div class="alert alert-success alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The facility has been successfully modified to ".$name." and the new features have been added"; ?>
				</div>
				<?php				
			} else {
				?>
				</br><div class="alert alert-danger alert-dismissable">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The facility ".$name." could not be modified"; ?>
				</div>
				<?php
			}
			$_POST['editFac'] = $id;
			$_POST['editReg'] = $_POST['idRegion'];
		}

		//******************************************************
		//This block is to generate the filled input boxes for the user to modify the features in the facility
		//******************************************************
		if(isset($_POST['editFac'])){
			$idFac = $_POST['editFac'];
			$idRegion = $_POST['editReg'];
			$facility = getAllDetailsFacility($idFac, $idRegion);

			?>

		</br></br><h5 class='warningred'>Modify the following fields to change the features present in the facility:</h5></br>
		<form class="form-inline" role="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
			<label class="col-sm-2 control-label" for="newName">Facility Name</label>
			<input class="form-control" style="width:200px;" id="newName" type = "text" name = "newName" value = "<?php echo $facility['name']?>" /></br>
			</br>

			<label class="col-sm-2 control-label" for="newOpen">Opening Time</label> 
			<input class="form-control" style="width:200px;" id="newOpen" type = "time" name = "newOpen" value = "<?php echo $facility['open']; ?>" /></br>
			</br>

			<label class="col-sm-2 control-label" for="newClose">Closing Time</label>
			<input class="form-control" style="width:200px;" id="newClose" type = "time" name = "newClose" value = "<?php echo $facility['close']; ?>" /></br>
			</br>

			<label class="col-sm-2 control-label" for="newCapacity">Capacity</label>
			<input class="form-control" style="width:200px;" id="newCapacity" type = "text" name = "newCapacity" value = "<?php echo $facility['capacity']; ?>" /></br>
			</br>

			<div style="margin-left:45px; margin-top:-45px;">
			<table>
			<?php
				if($facility['type'] == 'academic') {
					?>
					<tr>
					<td><label>Whiteboard &nbsp&nbsp&nbsp</label></td>
					<td><input type = "radio" name = "newWhiteboard" value = 1 <?php echo ($facility['whiteboard']==1)?'checked':'' ?>>Yes &nbsp&nbsp&nbsp</td>
					<td><input type = "radio" name = "newWhiteboard" value = 0 <?php echo ($facility['whiteboard']==0)?'checked':'' ?>>No &nbsp&nbsp&nbsp</td>
					</br></tr>

					<tr>
					<td><label>Audio System &nbsp&nbsp&nbsp</label></td>
					<td><input type = "radio" name = "newAudio" value = 1 <?php echo ($facility['audio']==1)?'checked':'' ?>>Yes &nbsp&nbsp&nbsp</td>
					<td><input type = "radio" name = "newAudio" value = 0 <?php echo ($facility['audio']==0)?'checked':'' ?>>No &nbsp&nbsp&nbsp</td>
					</br></tr>

					<tr>
					<td><label>Projector &nbsp&nbsp&nbsp</label></td>
					<td><input type = "radio" name = "newProjector" value = 1 <?php echo ($facility['projector']==1)?'checked':'' ?>>Yes &nbsp&nbsp&nbsp</td>
					<td><input type = "radio" name = "newProjector" value = 0 <?php echo ($facility['projector']==0)?'checked':'' ?>>No &nbsp&nbsp&nbsp</td>
					</br></tr>
					<?php
				} else if($facility['type'] == 'sports') {
					?>
					<tr>
					<td><label>Scoreboard &nbsp&nbsp&nbsp</label></td>
					<td><input type = "radio" name = "newScoreboard" value = 1 <?php echo ($facility['scoreboard']==1)?'checked':'' ?>>Yes &nbsp&nbsp&nbsp</td>
					<td><input type = "radio" name = "newScoreboard" value = 0 <?php echo ($facility['scoreboard']==0)?'checked':'' ?>>No &nbsp&nbsp&nbsp</td>
					</br></tr>

					<tr>
					<td><label>Spectator Area &nbsp&nbsp&nbsp</label></td>
					<td><input type = "radio" name = "newSpectator" value = 1 <?php echo ($facility['spectator']==1)?'checked':'' ?>>Yes &nbsp&nbsp&nbsp</td>
					<td><input type = "radio" name = "newSpectator" value = 0 <?php echo ($facility['spectator']==0)?'checked':'' ?>>No &nbsp&nbsp&nbsp</td>
					</br></tr>
					<?php
				}
			?>
			</table>
			</div>
			<input type="hidden" name="idFac" value=<?php echo $facility['id']; ?> />
			<input type="hidden" name="type" value=<?php echo $facility['type']; ?> />
			<input type="hidden" name="idRegion" value=<?php echo $facility['reg_id']; ?> />
			</br></br><button class="btn btn-danger"  type="submit" name="modify">Modify Facility</button>
		</form>

		<?php
		}

?>


<?php
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