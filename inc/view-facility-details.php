<h2>View Facility</h2>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	include $root.'/cs2102/inc/admin-functions.php';
	$conn = setup_db();
	$regions = getAllRegions(); 

?>

<form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
	<label for="region">Select Region:</label>
	<select id="region" name="region">
		<option select value="base">Please Select</option>
	<?php
		foreach ($regions as $row) {
			echo '<option value="', $row['id'], '">', $row['region'], '</option>';
		}
	?>
	</select>
	
	<label for="facility">Select Facility:</label>
	<select id="facility" name="facility">
		<option>Please Select</option>
	</select>
<input type="submit" value="Submit my choice"/>
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
		
		$query = "SELECT * FROM facility f 
				  WHERE f.fac_id=".$idFac." 
				  AND f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$facility = array(
						'id' => $row[0],
						'reg_id' => $row[1],
						'open' => $row[2],
						'close' => $row[3],
						'capacity' => $row[4],
						'name' => $row[5],
						'type' => $row[6]
						);

		$query = "SELECT R.name, R.location 
				  FROM region R 
				  WHERE R.reg_id = ".$facility['reg_id'].";";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$facility['regname'] = $row[0];
		$facility['location'] = $row[1];

		if($facility['type'] == 'academic') {
			$query = "SELECT * 
					  FROM academic a 
					  WHERE a.fac_id = ".$facility['id'].";";
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			$facility['whiteboard'] = $row[2];
			$facility['audio'] = $row[3];
			$facility['projector'] = $row[4];
			$facility['scoreboard'] = 0;
			$facility['spectator'] = 0;
		} else if($facility['type'] == 'sports') {
			$query = "SELECT * 
					  FROM sports s 
					  WHERE s.fac_id = ".$facility['id'].";";
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			$facility['scoreboard'] = $row[2];
			$facility['spectator'] = $row[3];
			$facility['whiteboard'] = 0;
			$facility['audio'] = 0;
			$facility['projector'] = 0;
		}

		?>
		<!--Display all the values obtained in the form of a table-->
		<table>
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
		<?php
	}
?>

<?php 
	close_db($conn); 
?>