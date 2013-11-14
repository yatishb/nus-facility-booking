<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	include ($root."/cs2102/inc/db-conn.php");
	$conn = setup_db();
	$query = "SELECT * FROM region;";
	$result = mysql_query($query);
?>


	
<form method="POST">
	Region<select id="region" name="region">
		<option select value="base">Please Select</option>
		<?php
			if ($result) :
			while ($row = mysql_fetch_assoc($result))
			{
				echo '<option value="', $row['reg_id'], '">', $row['name'], '</option>';
			}
			endif;
		?>
	</select>
		
	</br>
		
	facility:<select id="facility">
		<option>Please choose from above</option>
	</select>
	<input type="submit" value="Submit my choice"/>
	</form>

	<?php 
		echo "Getting here";
		if (isset($_POST['facility'])) : 
			echo " Something here";
			$name = mysql_real_escape_string($_POST['facility']);
			$query = "SELECT * FROM facility WHERE fac_id = '". $name."';";
			$result1 = mysql_query($query);
				if ($result1) :
					while ($row = mysql_fetch_assoc($result1)) {
						echo $row['reg_id'].$row['fac_id'];
					}
	?>
	<?php endif;?>
		<?php endif; ?>
	
<?php 
	close_db($conn); 
?>
<script>
$("#region").change(function() {
	var temp = (document.getElementById("region").value);
	console.log(temp);
	$("#facility").load("getter.php?choice=" +  temp);
});
</script>