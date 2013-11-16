<h2>Modify Region</h2>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	include $root.'/cs2102/inc/admin-functions.php';
	$conn = setup_db();

	$result = 0;
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		//Will enter when the details for the region to be modified to have been entered
		if(isset($_POST['modify'])) {
			$id = $_POST['id'];
			$name = $_POST['newName'];
			$location = $_POST['newLocation'];

			$query = "UPDATE region r
					  SET r.name = '".$name."', r.location = '".$location."' 
					  WHERE r.reg_id = ".$id.";";
			$result = mysql_query($query);

			$_POST['editReg'] = $id;
			$_POST['regionSelect'] = "value";
		}
	}

	$regions = getAllRegions(); 

	$flag = "";
	$idRegion = "base";
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['regionSelect'])){
			$idRegion = $_POST['editReg'];
			if($idRegion == "base"){
				$flag = "*required";
			}
		}
	}

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
<button type = "submit" name="regionSelect">Edit Region</button>
</form>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['modify'])) {
			if($result) {
				echo "The region has been successfully modified to ".$name;
			} else {
				echo "The region ".$name." could not be modified";
			}
		}

		//will enter when the region to be modified has been selected
		if(isset($_POST['regionSelect'])){
			$idRegion = $_POST['editReg'];
			if($idRegion != "base"){
				$query = "SELECT r.name, r.location
						  FROM region r
						  WHERE r.reg_id = ".$idRegion.";";
				$result = mysql_query($query);
				$row = mysql_fetch_row($result);
				$region = array(
								'id' => $idRegion,
								'name' => $row[0],
								'location' => $row[1]
								);

				?>
				</br></br>Modify the following fields to change the features present in the facility:</br>
				<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
					Region Name <input type = "text" name = "newName" value = "<?php echo $region['name']; ?>" /></br>
					Region Location <input type = "text" name = "newLocation" value = "<?php echo $region['location']; ?>" /></br>
					<input type = "hidden" name = "id" value = "<?php echo $region['id']; ?>" />
					<button type = "submit" name = "modify">Modify Region</button>
				</form>
				<?php
			}
		}
	}

	close_db($conn);

	if(isset($_POST["back"])){
		header('Location: /cs2102/inc/admin-panel.php');
	}
?>

<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="back">BACK</button>
</form>