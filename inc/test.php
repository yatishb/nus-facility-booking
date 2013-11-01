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
		<label for="first-choice">first-choice:</label>
		<select id="first-choice" name="first-choice">
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
		
		<label for="second-choice">Second-choice:</label>
		<select id="second-choice">
			<option>Please choose from above</option>
		</select>
	</p>
	<p>
	<input type="submit" value="Submit my choice"/>
	</p>
	</form>
	<?php if (isset($_POST['seecond-choice'])) : 
			$name = mysql_real_escape_string($_POST['second-choice']);
			$query = "SELECT * FROM facility WHERE fac_id = '". $name."';";
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
$("#first-choice").change(function() {
var temp = (document.getElementById("first-choice").value);
console.log(temp);
$("#second-choice").load("getter.php?choice=" +  temp);
});
</script>	
</div>
</body>
</html>