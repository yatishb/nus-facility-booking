<DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
	<title>My Test Form</title>
	<?php
			$root = $_SERVER['DOCUMENT_ROOT'];
			//include ($root."/cs2102/inc/db-conn.php");
			$conn = setup_db();
			$query = "SELECT * FROM region;";
			$result = mysql_query($query);
	?>
</head>
<body>

<div align="center">
	
	<form method="POST" action="book-test.php">
	<p></p>
	<p>
		<label for="region">Region:</label>
		<select id="region" name="region">
			<?php
				if ($result) :
				echo '<option value="ANY"> Any </option>';	
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

		<label for="start-time">Start Time:</label>
		<select id="start-time" name="start-time">
			<option value="ANY"> Any </option>
			<?php
				$query = "SELECT `start` 
						FROM timeslot 
						ORDER BY `start`;";
				$result = mysql_query($query);
				if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					echo '<option value="', $row['start'], '">', $row['start'], '</option>';
				}
				endif;
			?>			
		</select>

		<label for="end-time">End Time:</label>
		<select id="end-time" name="end-time">
			<option value="ANY"> Any </option>
			<?php
				$query = "SELECT `end` 
						FROM timeslot 
						ORDER BY `end`;";
				$result = mysql_query($query);
				if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					echo '<option value="', $row['end'], '">', $row['end'], '</option>';
				}
				endif;
			?>			
		</select>
	</p>
	<p>
	<input name="submit" type="submit" value="Search"></input>
	</p>
	</form>
	<?php //close_db($conn); ?>

<script>

	$("#region").ready(function() {
	var reg = (document.getElementById("region").value);
	var type = (document.getElementById("facility-type").value);
	console.log(type);
	console.log(reg);
	$("#facility").load("getter.php?region="+reg+"&type="+type);
	});

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