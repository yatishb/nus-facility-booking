<h2>View All Regions</h2>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	include $root.'/cs2102/inc/admin-functions.php';
	$conn = setup_db();

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['delRegion'])){
			$id = $_POST['delRegion'];
			$query = "DELETE FROM region 
					  WHERE reg_id = ".intval($id).";";
			$result = mysql_query($query);
		}
	}
	
	$regions = getAllRegions();

?>

List of all the Regions :
</br>
<table>
<tr>
	<th>Name</th>
	<th>Location</th>
</tr>
<?php
	foreach($regions as $eachRegion) {
		?><tr>
			<td> <?php echo $eachRegion['region']; ?> </td>
			<td> <?php echo $eachRegion['location']; ?> </td>
			<td> <form method='POST' action='view-all-facility-in-region.php'>
				<button type="submit" name="region" value="<?php echo $eachRegion['id']; ?>">View Facilities</button>
				<input type='hidden' name='showAll' value='Submit'/>
				<input type='hidden' name='from' value='view-all-regions.php'/>
				</form></td>
			<td> <form method='POST' action='modify-region.php'> 
				<button type="submit" name="editReg" value="<?php echo $eachRegion['id']; ?>">Edit</button>
				<input type='hidden' name='regionSelect' value='Submit'/>
				</form></td>
			<td> <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
				<button type="submit" name="delRegion" value="<?php echo $eachRegion['id']; ?>">Delete Region</button>
				</form></td>
		</tr><?php	
	}
?>	
</table>


<?php
	close_db($conn);

	if(isset($_POST["back"])){
		header('Location: /cs2102/inc/admin-panel.php');
	}
?>

<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>

