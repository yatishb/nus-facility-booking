<?php include ("header.php");

	$conn = setup_db();
	if(isset($_GET['bookdate']) && isset($_GET['bookreg']) && isset($_GET['bookstart']) && isset($_GET['bookend']) && isset($_GET['bookfac']) && isset($_GET['bookuser']))
	{
		echo $_GET['bookdate'];
		$dtstart = $_GET['bookdate']." ".$_GET['bookstart'];
		$dtend = $_GET['bookdate']." ".$_GET['bookend'];
		$query1 = "SELECT MAX(book_id) from booking";
		$max = mysql_query($query1);
		$rowmax = mysql_fetch_array($max);
		$val = $rowmax[0] +1;		
		$query_insert = "INSERT INTO booking (`book_id`,`fac_id`,`reg_id`,`user_id`,`start`,`end`) VALUES(".$val.",".$_GET['bookfac'].",".$_GET['bookreg'].",'".$_GET['bookuser']."','".$dtstart."','".$dtend."')";
		mysql_query($query_insert);		
		echo '<script>console.log("Blah"); </script>	';
		//echo '<script>window.location.href = "/cs2102/inc/user-bookings.php"; </script>	';

	}

	include("footer.php");
?>