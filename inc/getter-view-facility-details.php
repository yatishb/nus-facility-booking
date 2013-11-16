<?php
	$username = "cs2102";
	$password = "pass";
	$hostname = "localhost";
	
	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	$selected = mysql_select_db("cs2102", $dbhandle) or die("Could not select examples");
	$choice = mysql_real_escape_string(urldecode($_GET['choice']));
	
	$query = "SELECT * FROM facility f WHERE `reg_id`='$choice' ORDER BY f.name";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
   		echo "<option value='".$row['fac_id']."'>" . $row{'name'} . "</option>";
	}
?>