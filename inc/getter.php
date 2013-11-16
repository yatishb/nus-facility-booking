<?php
	$username = "cs2102";
	$password = "pass";
	$hostname = "localhost";
	
	$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	$selected = mysql_select_db("cs2102", $dbhandle) or die("Could not select examples");
	$reg = mysql_real_escape_string(urldecode($_GET['region']));
	$type = mysql_real_escape_string(urldecode($_GET['type']));
	$query = 	"SELECT * 
				FROM facility
				WHERE `reg_id`='$reg'";
	if(!($type=="ANY"))
	{
		$query.= "AND `type` = '$type'";
	}
	$query.=";";
	$result = mysql_query($query);
	echo "<option value='ANY'>Any</option>";
	while ($row = mysql_fetch_array($result)) {
   		echo "<option value='".$row['fac_id']."'>" . $row{'name'} . "</option>";
	}
?>