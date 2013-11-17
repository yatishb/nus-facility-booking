<?php include("header.php"); ?>
<h2 class="nusblue">Remove Booking</h2><br>

<?php
	if($_SESSION['admin']) {
		include("admin-functions.php");
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

	<div style="margin-top:15px; margin-left:55px">
	<label for="date">&nbsp&nbsp&nbspDate:</label>
	<input class="form-control" style="width:200px;" type="text" name="date" placeholder="yyyy-mm-dd"/>
	</div>

<div style="margin-top:15px; margin-left:110px">
<button type="submit" class="btn btn-primary" name="booking">View All Bookings</button>
</div>
</form>


<script>
$("#region").change(function() {
var temp = (document.getElementById("region").value);
console.log(temp);
$("#facility").load("getter-view-facility-details.php?choice=" +  temp);
});
</script>

<?php
		if(isset($_POST['delete'])) {
			$bookId = $_POST['delete'];
			$query = "DELETE FROM booking 
					  WHERE book_id = ".$bookId.";";
			$result = mysql_query($query);
			if($result) {
				?>
				<div class="alert alert-success alert-dismissable" style="margin-top:20px">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The booking has been successfully removed"; ?>
				</div>
				<?php
			} else {
				?>
				<div class="alert alert-danger alert-dismissable" style="margin-top:20px">
	  				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo "The booking selected could not be removed"; ?>
				</div>
				<?php
			}

		}

		if(isset($_POST['booking'])) {
			if(isset($_POST['facility'])) {
				$idFac = $_POST['facility'];
			} else {
				$idFac = NULL;
			}
			if(isset($_POST['region'])) {
				$idRegion = $_POST['region'];
			} else {
				$idRegion = NULL;
			}
			if(isset($_POST['date'])) {
				$date = $_POST['date'];
			} else {
				$date = NULL;
			}

			$bookings = array();
			if($idFac != NULL && $date != NULL) {
				$endDate = $date.' 23:59:59';
				$query = "SELECT b.book_id, b.start, b.end, f.name, b.user_id 
						  FROM booking b, facility f
						  WHERE f.fac_id = b.fac_id
						  AND b.fac_id = ".$idFac." 
						  AND b.start >= '".$date."' 
						  AND b.end <= '".$endDate."';";
			} elseif($idFac != NULL && $date == NULL) {
				$query = "SELECT b.book_id, b.start, b.end, f.name, b.user_id 
						  FROM booking b, facility f
						  WHERE f.fac_id = b.fac_id
						  AND b.fac_id = ".$idFac." 
						  AND b.start >= CURDATE() 
						  AND b.end <= CONCAT(CURDATE(),' 23:59:59');";
			} elseif($idRegion != NULL && $date != NULL) {
				$endDate = $date.' 23:59:59';
				$query = "SELECT b.book_id, b.start, b.end, f.name, b.user_id 
						  FROM booking b, facility f
						  WHERE f.fac_id = b.fac_id
						  AND b.reg_id = ".$idRegion." 
						  AND b.start >= '".$date."' 
						  AND b.end <= '".$endDate."';";
			} elseif($idRegion != NULL && $date == NULL) {
				$query = "SELECT b.book_id, b.start, b.end, f.name, b.user_id 
						  FROM booking b, facility f
						  WHERE f.fac_id = b.fac_id
						  AND b.fac_id = ".$idRegion." 
						  AND b.start >= CURDATE() 
						  AND b.end <= CONCAT(CURDATE(),' 23:59:59');";
			}

			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0) {
				?></br><h5 class='warningred'>No bookings found for the facility and date selected</h5><?php
			} else {
				?></br><h5 class='warningred'>The following bookings were found :</h5><?php
			
				while($row = mysql_fetch_array($result)) {
					$eachBooking = array(
										'id' => $row['book_id'],
										'user' => $row['user_id'],
										'facName' => $row['name'],
										'start' => substr($row['start'], 11),
										'end' => substr($row['end'], 11),
										'date' => substr($row['start'], 0, 10)
										);
					array_push($bookings, $eachBooking);
				}

				?>
				</br></br>
				<table class="table">
					<tr>
						<th>Facility</th>
						<th>Date</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>User</th>
					</tr>
					<?php
					foreach ($bookings as $eachBooking) {
						?><tr>
						<td><?php echo $eachBooking['facName']; ?></td>
						<td><?php echo $eachBooking['date']; ?></td>
						<td><?php echo $eachBooking['start']; ?></td>
						<td><?php echo $eachBooking['end']; ?></td>
						<td><?php echo $eachBooking['user']; ?></td>
						<td><form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
							<input type="hidden" name="facility" value="<?php if($idFac != NULL) echo $idFac; ?>" />
							<input type="hidden" name="region" value="<?php if($idRegion != NULL) echo $idRegion; ?>" />
							<input type="hidden" name="date" value="<?php if($date != NULL) echo $date; ?>" />
							<input type="hidden" name="booking" value=1 />
							<button class="btn btn-danger" type="submit" name="delete" value="<?php echo $eachBooking['id']; ?>">Delete</button>
						</td>
						</tr><?php
					} ?>
				</table>
			<?php
			}
		}

	} else {
		?>
		<script>window.location.href = "/cs2102/inc/login.php"; </script>
		<?php
	}
?>
</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:110px;" type="submit" class="btn btn-warning btn-xs" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>