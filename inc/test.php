<DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
	<title>My Test Form</title>
	<?php
			$root = $_SERVER['DOCUMENT_ROOT'];
			include ($root."/cs2102/inc/db-conn.php");
			$conn = setup_db();
			$query = "SELECT * FROM region;";
			$result = mysql_query($query);
	?>
</head>
<body>

<div align="center">
	
	<form method="POST">
	<p></p>
	<p>
		<label for="region">Region:</label>
		<select id="region" name="region">
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
		
		<label for="facility-type">Type:</label>
		<select id="facility-type" name="facility-type">
			<option value="ANY"> Any </option>
			<option value="academic"> Academic </option>
			<option value="sports"> Sports </option>
		</select>
		
		<label for="facility">Facility:</label>
		<select id="facility" name="facility">
			<option>Please choose from above</option>
		</select>
	</p>
	<p>
	<input name="submit" type="submit" value="Search"></input>
	</p>
	</form>
	
	<?php if (isset($_POST['submit'])) :
			$name = mysql_real_escape_string($_POST['region']);
			$query ="SELECT * 
					FROM facility 
					WHERE `reg_id` = '". $name."'";
			#if(!($_POST['facility-type'] == "ANY"))
			#{
				#$query.= "AND `type` = '".$_POST['facility-type']."'";
			#}
			$query.=";";
			$result1 = mysql_query($query);
				if ($result1) :
	?>	
	<table align="center" border="1" style="border-collapse:collapse;border-spacing=0" >
		
	<?php
		while ($row = mysql_fetch_assoc($result1))
		{
			echo '<tr>';
			echo '<td>', $row['reg_id'], '</td><td>', $row['fac_id'], '</td>';
			echo '</tr>';
		}
	?>

	</table>
			<?php endif;?>
		<?php endif; ?>
	<?php close_db($conn); ?>

<script>
$("#region").change(function() {
var reg = (document.getElementById("region").value);
var type = (document.getElementById("facility-type").value);
console.log(type);
console.log(reg);
$("#facility").load("getter.php?region="+reg+"&type="+type);
});
$("#facility-type").change(function() {
var reg = (document.getElementById("region").value);
var type = (document.getElementById("facility-type").value);
console.log(type);
console.log(reg);
$("#facility").load("getter.php?region="+reg+"&type="+type);
});
</script>	
</div>
</body>
</html>