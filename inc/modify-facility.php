<?php include("header.php"); ?>
<h2 class="nusblue">Modify Facility Attributes</h2>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();
		$regions = getAllRegions(); 

?>

<form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<label for="editReg">Select Region:</label>
	<select id="editReg" name="editReg">
		<option select value="base">Please Select</option>
	<?php
		foreach ($regions as $row) {
			echo '<option value="', $row['id'], '">', $row['region'], '</option>';
		}
	?>
	</select>
	
	<label for="editFac">Select Facility:</label>
	<select id="editFac" name="editFac">
		<option>Please Select</option>
	</select>
<input type="submit" value="Edit Facility"/>
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
				echo "The facility has been successfully modified to ".$name." and the new features have been added";
			} else {
				echo "The facility ".$name." could not be modified";
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

		</br></br>Modify the following fields to change the features present in the facility:</br>
		<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
			Facility Name <input type = "text" name = "newName" value = "<?php echo $facility['name']?>" /></br>
			Opening Time <input type = "time" name = "newOpen" value = "<?php echo $facility['open']; ?>" /></br>
			Closing Time <input type = "time" name = "newClose" value = "<?php echo $facility['close']; ?>" /></br>
			Capacity <input type = "text" name = "newCapacity" value = "<?php echo $facility['capacity']; ?>" /></br>
			<?php
				if($facility['type'] == 'academic') {
					?>
					Whiteboard 
					<input type = "radio" name = "newWhiteboard" value = 1 <?php echo ($facility['whiteboard']==1)?'checked':'' ?>>Yes
					<input type = "radio" name = "newWhiteboard" value = 0 <?php echo ($facility['whiteboard']==0)?'checked':'' ?>>No</br>
					Audio System 
					<input type = "radio" name = "newAudio" value = 1 <?php echo ($facility['audio']==1)?'checked':'' ?>>Yes
					<input type = "radio" name = "newAudio" value = 0 <?php echo ($facility['audio']==0)?'checked':'' ?>>No</br>
					Projector 
					<input type = "radio" name = "newProjector" value = 1 <?php echo ($facility['projector']==1)?'checked':'' ?>>Yes
					<input type = "radio" name = "newProjector" value = 0 <?php echo ($facility['projector']==0)?'checked':'' ?>>No</br>
					<?php
				} else if($facility['type'] == 'sports') {
					?>
					Scoreboard 
					<input type = "radio" name = "newScoreboard" value = 1 <?php echo ($facility['scoreboard']==1)?'checked':'' ?>>Yes
					<input type = "radio" name = "newScoreboard" value = 0 <?php echo ($facility['scoreboard']==0)?'checked':'' ?>>No</br>
					Spectator Area 
					<input type = "radio" name = "newSpectator" value = 1 <?php echo ($facility['spectator']==1)?'checked':'' ?>>Yes
					<input type = "radio" name = "newSpectator" value = 0 <?php echo ($facility['spectator']==0)?'checked':'' ?>>No</br>
					<?php
				}
			?>
			<input type="hidden" name="idFac" value=<?php echo $facility['id']; ?> />
			<input type="hidden" name="type" value=<?php echo $facility['type']; ?> />
			<input type="hidden" name="idRegion" value=<?php echo $facility['reg_id']; ?> />
			<button type="submit" name="modify">Modify Facility</button>
		</form>

		<?php
		}

?>


<?php
		close_db($conn);
	} else {
		header("Location: /cs2102/inc/login.php");
	}
?>

</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:165px;" type="submit" class="btn btn-default btn-sm" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>