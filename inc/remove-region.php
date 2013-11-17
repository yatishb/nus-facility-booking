<?php include("header.php"); ?>
<h2 class="nusblue">Remove Region</h2></br>

<?php
	if($_SESSION['admin']) {
		include ('admin-functions.php');
		$conn = setup_db();

		$query = "SELECT count(*) FROM region;";
		$result = mysql_query($query);
		$countRegion = mysql_fetch_row($result);
		$countRegion = $countRegion[0];

		$regions = getAllRegions();

		$flag = "";
		$id = "base";
		$name = "Please select";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['delete'])){
				$id = $_POST['region'];
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
			$countFac = getNumberFacilitiesInRegion($id);
			if($countFac > 0) {
				$facility = getFacilityInRegion($id);

				echo "The following facilities will also be removed upon removing the region ".$name." :";
				echo "<ul>";
				foreach ($facility as $eachfac) {
					echo "<li>".$eachfac['facility']."</br>";
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
					$query = "DELETE FROM region 
							  WHERE reg_id = ".intval($idDelete).";";
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
		if($id != "base") {
			?>
			<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
				<button type="submit" name="confirm">Confirm</button>
				<input type="hidden" name="id2" value=<?php echo $id ?> />
			</form>
			<?php
		}
	} else {
		header("Location: /cs2102/inc/login.php");
	}
?>

</br>
<a href='/cs2102/inc/admin-panel.php'>
	<button style="margin-left:165px;" type="submit" class="btn btn-default btn-sm" name="back">Back To Admin Panel</button>
</a>
<?php include("footer.php"); ?>