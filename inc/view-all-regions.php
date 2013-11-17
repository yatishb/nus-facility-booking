<?php include("header.php"); ?>
<h2 class="nusblue">View All Regions</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
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

<table class="table">
<thead>
<tr>
	<th>Name</th>
	<th>Location</th>
</tr>
</thead>
<tbody>
<?php
	foreach($regions as $eachRegion) {
		?><tr>
			<td> <?php echo $eachRegion['region']; ?> </td>
			<td> <?php echo $eachRegion['location']; ?> </td>
			<td> <form method='POST' action='view-all-facility-in-region.php'>
				<button type="submit" class="btn btn-primary" name="region" value="<?php echo $eachRegion['id']; ?>">View Facilities</button>
				<input type='hidden' name='showAll' value='Submit'/>
				<input type='hidden' name='from' value='view-all-regions.php'/>
				</form></td>
			<td> <form method='POST' action='modify-region.php'> 
				<button type="submit" class="btn btn-warning" name="editReg" value="<?php echo $eachRegion['id']; ?>">Edit</button>
				<input type='hidden' name='regionSelect' value='Submit'/>
				</form></td>
			<td> <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
				<button type="submit" class="btn btn-danger" name="delRegion" value="<?php echo $eachRegion['id']; ?>">Delete Region</button>
				</form></td>
		</tr><?php	
	}
?>
</tbody>	
</table>


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