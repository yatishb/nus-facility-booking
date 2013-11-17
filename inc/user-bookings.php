<DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
	<title>Profile</title>
	<?php
			$root = $_SERVER['DOCUMENT_ROOT'];
			include ($root."/cs2102/inc/db-conn.php");
			$conn = setup_db();
			//if(isset($_SESSION['user']))
			//{
				//$user = $_SESSION['user'];
			//}
			$user = "A0091565";
			$view = $user."_bookings";
			$query = "DROP VIEW IF EXISTS $view;";
			$result = mysql_query($query);
			echo '<script>console.log("Here1");</script>';

			$query ="CREATE VIEW $view 
					AS 
					SELECT b.book_id,f.name AS `Facility`,r.name AS `Region`,b.start,b.end FROM booking b
					INNER JOIN facility f 
					ON b.fac_id = f.fac_id
					INNER JOIN region r
					ON b.reg_id = r.reg_id
					WHERE `user_id`='$user'
					ORDER BY `start`;";
			$result = mysql_query($query);
	?>

</head>
<body>

<div align="center">
	<?php
			if(isset($_POST['delConfirm']))
			{
				$delid = $_POST['ifDelBooking'];
				$delquery ="DELETE FROM booking 
			 			WHERE book_id = ".$delid.";";
				$delresult = mysql_query($delquery);
				echo '<script>console.log("Here3");</script>';
				//echo '<script>location.reload();</script>';
			}

			$query ="SELECT * FROM $view ;";
			$result = mysql_query($query);
			echo '<script>console.log("Here2");</script>';

			echo'<table border="1" cellpadding="5">';
			echo mysql_num_rows($result) ;
			if (count($result)<0) :
	?>
				<tr>
				<th>Facility</th>
				<th>Region</th>
				<th>Booking Starts</th>
				<th>Booking ends</th>
				<th>Options</th>
				</tr>	
	<?php			
				while ($row = mysql_fetch_assoc($result))
				{
	?>		
					<tr>
					<td><?php echo $row['Facility'] ?></td>
					<td><?php echo $row['Region'] ?></td>
					<td><?php echo $row['start'] ?></td>
					<td><?php echo $row['end'] ?></td>
					<td>
					<form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return confirm('Are you sure?');">
					<button name="delConfirm" type="submit" value="<?php echo $row['book_id']; ?>">Delete</button>
					<input type="hidden" name="ifDelBooking" value="<?php echo $row['book_id']; ?>">
					</form>
					</td>
					</tr>
	<?php	
				}
			endif;
			echo'</table>';			
	?>
	
	
	<?php close_db($conn); ?>

	
</div>
</body>
</html>