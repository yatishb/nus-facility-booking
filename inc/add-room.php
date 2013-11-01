<h2>Add New Facility</h2>

<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include $root.'/cs2102/inc/db-conn.php';
$conn = setup_db();

$query = "SELECT `reg_id`, name FROM `region`;";
$result = mysql_query($query);
$regions = array();
while($rows = mysql_fetch_array($result)) {
	$eachregion = array(
					'id' => $rows[0],
					'region' => $rows[1]
					);
	array_push($regions, $eachregion);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST["back"])){
		header('Location: /cs2102/inc/adminpanel.php');
	}
}

?>




<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	Region : <select name = "region">
				<?php
				foreach($regions as $eachregion) {
					echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
				}
				?>
			</select></br>
	New Facility : <input type="text" style="width:200px" name="facility" placeholder="new facility name" />
		<?php //echo $regionErr; ?></br>
	Location : <input type="text" style="width:200px" name="location" placeholder="location of the new region" />
		<?php //echo $locationErr; ?></br></br>
	<button type="submit" name="create">Create New Region</button>
</form>



<?php
?>



<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>