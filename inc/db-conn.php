<?php
function setup_db()
{
	$conn=mysql_connect("localhost","cs2102","pass","cs2102");
	mysql_select_db("cs2102",$conn);
	// Check connection
	if (!$conn)
	{
	echo "Failed to connect to MySQL: "; //. mysql_connect_error();
	}
	else
	{
		return $conn;
	}
}

function close_db($conn)
{
	mysql_close($conn);
}	
?>