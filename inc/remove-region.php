<h2>Remove Region</h2>

<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include $root.'/cs2102/inc/db-conn.php';
	$conn = setup_db();

	$query = "SELECT count(*) FROM region;";
	$result = mysql_query($query);
	$countRegion = mysql_fetch_row($result);
	$countRegion = $countRegion[0];

	$query = "SELECT R.reg_id, R.name FROM region R;";
	$result = mysql_query($query);
	$regions = array();
	while($rows = mysql_fetch_array($result)) {
		$eachregion = array(
						'id' => $rows[0],
						'region' => $rows[1]
						);
		array_push($regions, $eachregion);
	}

	$flag = "";
	$id = "base";
	$name = "Please select";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['delete'])){
			$id = $_POST['region'];
			$selected = $id;
			if($id == "base"){
				$flag = "*required";
			}
			foreach($regions as $eachregion) {
				if($eachregion['id'] == $id)
					$name = $eachregion['region'];
			}
		}
	}

?>


<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST"> 
	<label> Select Region to be deleted : </label>
	<select name = "region" >
		<option select value="base">Please Select</option>
		<?php
			foreach($regions as $eachregion) {
				echo "<option value = ".$eachregion['id'].">".$eachregion['region']."</option>";
			}
		?>
	</select><?php echo $flag; ?></br>
	<button type="submit" name="delete">Delete</button>
</form>


<?php
	if($id != "base"){
		$query = "SELECT count(*) FROM facility WHERE reg_id=".$id.";";
		$result = mysql_query($query);
		$countFac = mysql_fetch_row($result);
		$countFac = $countFac[0];

		if($countFac > 0) {
			$query = "SELECT f.name, f.fac_id FROM facility f WHERE f.reg_id =".$id.";";
			$result = mysql_query($query);
			$facility = array();
			while($rows = mysql_fetch_array($result)) {
				$eachfac = array(
								'id' => $rows[1],
								'name' => $rows[0]
								);
				array_push($facility, $eachfac);
			}

			echo "The following facilities will also be removed upon removing the region ".$name." :";
			echo "<ul>";
			foreach ($facility as $eachfac) {
				echo "<li>".$eachfac['name']."</br>";
			}
			echo "</ul></br>";
		} else {
			echo "There are no other facilities in this region ".$name;
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['confirm'])){
			$idDelete = $_POST['id2'];
			if($idDelete != "base") {
				$query = "DELETE FROM region WHERE reg_id = ".intval($idDelete).";";
				$result = mysql_query($query);
				foreach($regions as $eachregion) {
					if($eachregion['id'] == $idDelete)
						$name = $eachregion['region'];
				}
				if($result) {
					echo $name." has been successfully deleted";
				}
			}
		}
	}


	close_db($conn);
?>

<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
	<button type="submit" name="confirm">Confirm</button>
	<input type="hidden" name="id2" value=<?php echo $id ?> />
</form>

