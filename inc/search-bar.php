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
	
	<form method="POST" action="book-search.php">
	
	<table cellpadding="5">
	<tr>
		<td>
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
		</td>

		<td>
		<label for="facility-type">Type:</label>
		<select id="facility-type" name="facility-type">
			<option value="ANY"> Any </option>
			<option value="academic"> Academic </option>
			<option value="sports"> Sports </option>
		</select>
		</td>

		<td>
		<label for="facility">Facility:</label>
		<select id="facility" name="facility">
			<option>Please choose from above</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>	
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
		</td>
		
		<td>
		<label for="end-time">End Time:</label>
		<select id="end-time" name="end-time">
			<option value="ANY"> Any </option>
			<?php
				$query = "SELECT  `end` , ADDTIME(`end`,1) AS  `enddisplay` 
							FROM timeslot
							ORDER BY  `end`";
				$result = mysql_query($query);
				if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					if($row['enddisplay']=="24:00:00")
					{
						$row['enddisplay'] = "00:00:00";
					}
					echo '<option value="', $row['end'], '">', $row['enddisplay'], '</option>';
				}
				endif;
			?>			
		</select>
		</td>

		<td>
		<label for="date">Date:</label>		
		<select id="date" name="date">
			<option value="ANY"> Any </option>
			<?php
				$today = date('Y-m-d');
				$count = 7;
				$i =  1;
				while ($count>0)
				{
					echo '<option value="', $today, '">', $today, '</option>';
					$today = date('Y-m-d',strtotime("+".$i." days"));
					$i+=1;
					$count-=1;
				}
				
			?>			
		</select>
		</td>
	</tr>
	</table>	

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