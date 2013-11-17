<?php include("header.php"); ?>
<h2 class="nusblue">View Facility</h2></br>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>

<?php
	if($_SESSION['admin']) {
		include('admin-functions.php');
		$conn = setup_db();
		$regions = getAllRegions(); 

?>

<form class="form-inline" role="form" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<label for="region">Select Region:</label>
	<select class="form-control" style="width:200px;" id="region" name="region">
		<option select value="base">Please Select</option>
	<?php
		foreach ($regions as $row) {
			echo '<option value="', $row['id'], '">', $row['region'], '</option>';
		}
	?>
	</select>
	
	<label for="facility">&nbsp&nbsp&nbsp Select Facility:</label>
	<select class="form-control" style="width:200px;" id="facility" name="facility">
		<option>Please Select</option>
	</select>
<button type="submit" class="btn btn-primary">View Facility</button>
</form>


<script>
$("#region").change(function() {
var temp = (document.getElementById("region").value);
console.log(temp);
$("#facility").load("getter-view-facility-details.php?choice=" +  temp);
});
</script>


<?php 
	if (isset($_POST['facility'])) {
		$idFac = $_POST['facility'];
		$idRegion = $_POST['region'];
		$facility = getAllDetailsFacility($idFac, $idRegion);

		?>
		<!--Display all the values obtained in the form of a table-->
		</br></br><table class="table">
			<tr>
				<td>Facility Name :</td>
				<td><?php echo $facility['name']; ?></td>
			</tr>
			<tr>
				<td>Facility Region :</td>
				<td><?php echo $facility['regname']; ?></td>
			</tr>
			<tr>
				<td>Opening Time :</td>
				<td><?php echo $facility['open']; ?></td>
			</tr>
			<tr>
				<td>Closing Time :</td>
				<td><?php echo $facility['close']; ?></td>
			</tr>
			<tr>
				<td>Capacity :</td>
				<td><?php echo $facility['capacity']; ?></td>
			</tr>
			<tr>
				<td>Whiteboard Present :</td>
				<td><?php if($facility['whiteboard']) 
							echo "Yes"; 
						  else 
						  	echo "No"; ?></td>
			</tr>
			<tr>
				<td>Audio-System Present :</td>
				<td><?php if($facility['audio']) 
							echo "Yes"; 
						  else 
						  	echo "No"; ?></td>
			</tr>
			<tr>
				<td>Projector Present :</td>
				<td><?php if($facility['projector']) 
							echo "Yes"; 
						  else 
						  	echo "No"; ?></td>
			</tr>
			<tr>
				<td>Scoreboard Present :</td>
				<td><?php if($facility['scoreboard']) 
							echo "Yes"; 
						  else 
						  	echo "No"; ?></td>
			</tr>
			<tr>
				<td>Spectator Area :</td>
				<td><?php if($facility['spectator']) 
							echo "Yes"; 
						  else 
						  	echo "No"; ?></td>
			</tr>
		</table>

<!--Display the calendar for the day -->
		<?php 
		$date = date('Y-m-d');
		if(isset($_POST['previous'])) {
			$date = $_POST['date'];
			$date = date('Y-m-d', strtotime($date .' -1 day'));
		} else if(isset($_POST['next'])) {
			$date = $_POST['date'];
			$date = date('Y-m-d', strtotime($date .' +1 day'));
		}
		$bookings = getAllBookingsFacility($idFac, $date);
		?>
		</br></br>
		<table>
			<tr><div class="btn-group">
				<th style="width:100px; text-align:left;"><form class="form-inline" role="form" action = "<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
					<button type="submit" class="btn btn-default" name="previous">&laquo;</button>
					<input type="hidden" name="date" value=<?php echo $date;?> />
					<input type="hidden" name="facility" value=<?php echo $idFac;?> />
					<input type="hidden" name="region" value=<?php echo $idRegion;?> />
					</form></th>
				<th style="width:100px; text-align:center;"><?php
						if($date == date('Y-m-d')) {
							echo "Today";
						} else {
							echo $date;
						} ?></th>
				<th style="width:100px; text-align:right;"><form class="form-inline" role="form" action = "<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
					<button class="btn btn-default" type="submit" name="next">&raquo;</button>
					<input type="hidden" name="date" value=<?php echo $date;?> />
					<input type="hidden" name="facility" value=<?php echo $idFac;?> />
					<input type="hidden" name="region" value=<?php echo $idRegion;?> />
					</form></th>
			</udiv></tr>
			<tr>
				<td style="text-align:center"><b>Start Time</b></td>
				<td style="text-align:center"><b>End Time</b></td>
				<td style="text-align:center"><b>User</b></td>
			</tr>
			<?php
				if(empty($bookings)){
					echo "<tr><td>No bookings</td></tr>";
				}
				foreach($bookings as $eachbooking) {
					?>
					<tr>
						<td style="text-align:center"><?php echo str_replace($date,"", $eachbooking['start']); ?></td>
						<td style="text-align:center"><?php echo str_replace($date,"", $eachbooking['end']); ?></td>
						<td style="text-align:center"><?php echo $eachbooking['user_id']; ?></td>
					</tr>
					<?php
				}
			?>
		</table>


<?php
		} //end of if(isset['facility'])	

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