<?php include ("header.php");

	$conn = setup_db();
	if(isset($_GET['bookdate']) && isset($_GET['bookreg']) && isset($_GET['bookstart']) && isset($_GET['bookend']) && isset($_GET['bookfac']) && isset($_GET['bookuser']))
	{
		$dt = $_GET['bookdate'];
		$dtstart = $dt." ".$_GET['bookstart'];
		$dtend = $dt." ".$_GET['bookend'];
		$fac = $_GET['bookfac'];
		$reg = $_GET['bookreg'];
		$user = $_GET['bookuser'];

		echo $_GET['bookdate'];
		$go = 0;
		$query1 = "SELECT * from booking
					WHERE `reg_id`=".$reg."
					AND CAST(`start` as DATE)='".$dt."'
					AND `fac_id`=".$fac."
					AND `user_id`='".$user."';";
		echo $query1;			
		$counting = mysql_query($query1);
	
		$rowbook = mysql_num_rows($counting);
		echo '<script>console.log(',$rowbook,'); </script>	';
		if($rowbook > 2)
		{
			$go = 1;
		}

		if($go == 0)
		{
			$query1 = "SELECT MAX(book_id) from booking";
			$max = mysql_query($query1);
			$rowmax = mysql_fetch_array($max);
			$val = $rowmax[0] +1;	

			$query = "SELECT count(*) FROM booking WHERE fac_id = ".$_GET['bookfac']." AND start = '".$dtstart."' AND end = '".$dtend."';";
			$result = mysql_query($query);
			$countExist = mysql_fetch_array($result);
			$countExist = $countExist[0];

		if($countExist == 0) {
			$query_insert = "INSERT INTO booking (`book_id`,`fac_id`,`reg_id`,`user_id`,`start`,`end`) VALUES(".$val.",".$fac.",".$reg.",'".$user."','".$dtstart."','".$dtend."')";
			//mysql_query($query_insert);		
			echo '<script>console.log("Blah"); </script>	';
		}
			//echo '<script>window.location.href = "/cs2102/inc/user-bookings.php"; </script>	';	
		}

		else 
		{
			echo '<script>alert("Cannot exceed 3 bookings on a particular day");
					window.location.href = "/cs2102/inc/book-search.php";</script>';	
		}		

	}

	include("footer.php");
?>