<DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
	<title>Profile</title>
	<?php
			$root = $_SERVER['DOCUMENT_ROOT'];
			include ($root."/cs2102/inc/db-conn.php");
			$conn = setup_db();
			if(isset($_SESSION['user']))
			{
				$user = $_SESSION['user'];
			}
			$view = $user."_bookings";
			$query = "DROP VIEW IF EXISTS $view;";
			$result = mysql_query($query);
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
			$query ="SELECT * FROM $view ;";
			$result = mysql_query($query);

			echo'<table>';
			if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					
					echo '<tr>',
					'<td>',$row['Facility'],'</td>',
					'<td>',$row['Region'],'</td>',
					'<td>',$row['start'],'</td>',
					'<td>',$row['end'],'</td>',
					'<td>',
					'<form method = "POST">',
					'<input name="ifDelBooking" type="submit" value=',$row['book_id'],'>Delete</input>',
					'</form>',
					'</td>',
					'</tr>';//'<option value="', $row['reg_id'], '">', $row['name'], '</option>';
				}
				endif;
			echo'</table>';

			if(isset($_POST['ifDelBooking']))
			{
				echo '<script>var r=confirm("Confirm?");
						if (r==true)
  						{';
  							$query ="DELETE FROM booking 
									WHERE book_id = '".$_POST['ifDelBooking']."';";
  				echo 	'}</script>';
						
				// $query =   "DELETE FROM booking 
				// 			WHERE book_id = '".$_POST['ifDelBooking']."';";
				$result = mysql_query($query);
			}

	?>
</head>
<body>

<div align="center">
	
	
	
	<?php close_db($conn); ?>

	
</div>
</body>
</html>