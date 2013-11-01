<h2>Add New Region</h2>

<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include $root.'/cs2102/inc/db-conn.php';
$conn = setup_db();

$query = "SELECT reg_id, name FROM region;";
$result = mysql_query($query);
$rows = mysql_fetch_array($result);
$regions = array();
$i = 0;
foreach($rows as $places) {
			array_push($regions,
					'id'.$id => $places['reg_id'],
					'region'.$id => $places['name']
					);
	}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST["back"])){
		header('Location: /cs2102/inc/adminpanel.php');
	}
}

?>




<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	Region : <select name = "region">

			</select>
	New Region Name : <input type="text" style="width:200px" name="newregion" placeholder="new region" />
		<?php echo $regionErr; ?></br>
	Location : <input type="text" style="width:200px" name="location" placeholder="location of the new region" />
		<?php echo $locationErr; ?></br></br>
	<button type="submit" name="create">Create New Region</button>
</form>



<?php
if($sucess) {
	echo "New Region ".$newRegion." has been added";
}
?>



<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>