<?php include ("header.php");?>

<?php
	$conn = setup_db();
	if(isset($_GET['reg']) && isset($_GET['facid']) && isset($_GET['start']) && isset($_GET['end']) && isset($_GET['date'] ))
	{
		$facid = $_GET['facid'];
		$start = $_GET['start'];
		$reg = $_GET['reg'];
		$end = $_GET['end'];
		$date = $_GET['date'];
		$query = "SELECT t.start , t.end 
				FROM timeslot t,facility f
				where t.start>= f.open_time 
				and t.end <= f.close_time
				and f.reg_id = ".$reg."
				and f.fac_id = ".$facid.";"; 
		$result = mysql_query($query);		
		echo '<table>';
		if($result){
		while($row = mysql_fetch_array($result))
		{
?>			
			<tr>
				<?php  

					$query1 = "SELECT * FROM booking b WHERE b.start ='".$row[0]."' AND b.end = '".$row[1]."' AND b.fac_id = ".$facid." AND b.reg_id = ".$reg;
					$result1 = mysql_query($query1);	
					echo '<td>',$row[0],'</td>';
					echo '<td>',$row[1],'</td>';
					?><td><?php
					if(mysql_num_rows($result1) == 0)
					{
						$dtstart = $row[0];
						$dtend = $row[1];
						if(isset($_SESSION['username']))
						{	
							echo "<script> console.log('Redirecting to same page');</script>";
							echo '<a href="confirm-booking.php?bookdate=',$date,'&bookreg=',$reg,'&bookstart=',$dtstart,'&bookend=',$dtend,'&bookfac=',$facid,'&bookuser=',$_SESSION['username'],'">
							Book</a>';
						}
						else 
						{			
							/*echo "<script> console.log('Sending to login page'); </script>";	
							echo '<a href="login.php?bookdate=',$date,'&bookstart=',$dtstart,'&bookend=',$dtend,'&bookfac=',$facid,'&bookreg=',$reg,'">
							Book</a>';*/
						}						 
					} ?></td>
				
			</tr>	
<?php			
		}
	}

				
	}



?>
<?php close_db($conn); ?>
<?php include ("footer.php");?>