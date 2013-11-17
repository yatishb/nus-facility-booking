<?php include ("header.php");?>
<DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
	<title>Profile</title>
	<?php
			$conn = setup_db();
			if(isset($_SESSION['username']))
			{
				$user = $_SESSION['username'];
			}
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
				//echo '<script>console.log("Here3");</script>';
				//echo '<script>location.reload();</script>';
			} ?>
			
			<div class="panel-group" id="accordion">
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			        	Upcoming Bookings
			        </a>
			      </h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse in">
			      <div class="panel-body">
			      	<?php
					$query ="SELECT * FROM $view 
							WHERE `start` >= NOW();";
					$result = mysql_query($query);
					echo '<script>console.log("Here2");</script>';
		
					if (mysql_num_rows($result) >0) 
					{
						echo'<table class="table">';
			?>
						<thead>
						<tr>
						<th>Facility</th>
						<th>Region</th>
						<th>Booking Starts</th>
						<th>Booking ends</th>
						<th>Options</th>
						</tr>	
						</thead>
						<tbody>
			<?php			
						while ($row = mysql_fetch_assoc($result))
						{
			?>		
							<tr>
							<td><?php echo $row['Facility'] ?></td>
							<td><?php echo $row['Region'] ?></td>
							<td><?php echo $row['start'] ?></td>
							<td><?php echo $row['end'] ?></td>
			<?php			
							$today = date('Y-m-d');
							$todate = strtotime( $today );
							$phpdate = strtotime( $row['start'] );
							//$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
							
			?>			
							<td>
							<form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return confirm('Are you sure?');">
							<button name="delConfirm" class="btn btn-danger" type="submit" value="<?php echo $row['book_id']; ?>">Delete</button>
							<input type="hidden" name="ifDelBooking" value="<?php echo $row['book_id']; ?>">
							</form>
							</td>			
							</tr>
			<?php	
						}
					echo'</tbody></table>';				
					}
					else
					{
						//echo 'You have no recent bookings!';
					}
					?>			      		
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
			        	Past Bookings
			        </a>
			      </h4>
			    </div>
			    <div id="collapseTwo" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<?php
					$query ="SELECT * FROM $view WHERE `start` < NOW();;";
					$result = mysql_query($query);
					echo '<script>console.log("Here2");</script>';
		
					if (mysql_num_rows($result) >0) 
					{
						echo'<table class="table">';
			?>
						<thead>
						<tr>
						<th>Facility</th>
						<th>Region</th>
						<th>Booking Starts</th>
						<th>Booking ends</th>
						</tr>	
						</thead>
						<tbody>
			<?php			
						while ($row = mysql_fetch_assoc($result))
						{
			?>		
							<tr>
							<td><?php echo $row['Facility'] ?></td>
							<td><?php echo $row['Region'] ?></td>
							<td><?php echo $row['start'] ?></td>
							<td><?php echo $row['end'] ?></td>
			<?php			
							$today = date('Y-m-d');
							$todate = strtotime( $today );
							$phpdate = strtotime( $row['start'] );
							//$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
							
			?>			
							</tr>
			<?php	
						}
					echo'</tbody></table>';				
					}
					else
					{
						//echo 'You have no recent bookings!';
					}
					?>			      		
			      </div>
			    </div>
			  </div>
			 </div>
				
	
	<?php close_db($conn); ?>

	
</div>
</body>
</html>
<?php include ("footer.php");?>