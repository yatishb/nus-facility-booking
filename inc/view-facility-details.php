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
<input type="submit" value="View Facility"/>
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

	if(isset($_POST["back"])){
		header('Location: /cs2102/inc/admin-panel.php');
	}
?>

<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>