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
				and f.fac_id = ".$facid."
				AND t.start>='".$start."'
				AND t.end <='".$end."';"; 
		echo '<script>console.log ("',mysql_real_escape_string($query),'");</script>';
		$result = mysql_query($query);
		
		$queryfac = "SELECT f.name, f.type, r.name
					FROM facility f, region r
					WHERE f.reg_id=r.reg_id 
					AND f.fac_id = ".$facid.";";
		$facres = mysql_query($queryfac);
		while($rowres = mysql_fetch_array($facres))
		{
			echo '<div class="centerme"><h1 class="nusblue" style="margin-left:100px;">'.$rowres[0].'</h1>
			<h3 style="margin-left:100px;"><span class="label label-primary">'.$date.'</span>&nbsp<span class="label label-default">'.$rowres[2].'</span>&nbsp<span class="label label-default" style="text-transform:capitalize">'.$rowres[1].'</span></h3><br>
			';
			if($rowres['type'] == 'academic'){
				$query = "SELECT a.whiteboard, a.audio_system, a.projector 
						  FROM academic a
						  INNER JOIN facility f
						  ON a.fac_id = f.fac_id 
						  WHERE f.fac_id = ".$facid.";";
				$resultAt = mysql_query($query);
				$attribute = mysql_fetch_row($resultAt);
				echo '<h3 style="margin-left:100px; margin-top:-20px">';
				if($attribute[0] == 1)
					echo '<span class="label label-default">'."Whiteboard".'</span>&nbsp';
				if($attribute[1] == 1)
					echo '<span class="label label-default">'."Audio System".'</span>&nbsp';
				if($attribute[2] == 1)
					echo '<span class="label label-default">'."Projector".'</span>&nbsp';
				echo '</h3><br>';
			} elseif($rowres['type'] == 'sports') {
				$query = "SELECT s.scoreboard, s.spectator_area 
						  FROM sports s
						  INNER JOIN facility f
						  ON s.fac_id = f.fac_id 
						  WHERE f.fac_id = ".$facid.";";
				$resultAt = mysql_query($query);
				$attribute = mysql_fetch_row($resultAt);
				echo '<h3 style="margin-left:100px; margin-top:-20px">';
				if($attribute[0] == 1)
					echo '<span class="label label-default">'."Scoreboard".'</span>&nbsp';
				if($attribute[1] == 1)
					echo '<span class="label label-default">'."Spectator Area".'</span>&nbsp';
				echo '</h3><br>';
			}
			
		}		
		echo '<table class="table narrow">
				<thead>
					<th>Start Time</th>
					<th>End Time</th>
					<th style="width:40px;"></th>
				</thead>
				<tbody>
		';
		if($result){
		while($row = mysql_fetch_array($result))
		{
?>			
			<tr>
				<?php  

					$query1 = "SELECT * FROM booking b WHERE CAST(b.start AS DATE) ='".$date."' AND CAST(b.start AS TIME) ='".$row[0]."' AND CAST(b.end AS TIME) = '".$row[1]."' AND b.fac_id = ".$facid." AND b.reg_id = ".$reg;
					
					$result1 = mysql_query($query1);	
					echo '<td>',$row[0],'</td>';
					$newdt = date('H:i:s', strtotime($row[1])+1);
					echo '<td>',$newdt,'</td>';
				
					//echo '<script> console.log("'.$num."');</script>";
					if(mysql_num_rows($result1)==0)
					{
						
						$dtstart = $row[0];
						$dtend = $row[1];
						if(isset($_SESSION['username']))
						{	
							if($_SESSION['admin']){
								echo '<td><a class="btn btn-primary" href="confirm-booking.php?bookdate=',$date,'&bookreg=',$reg,'&bookstart=',$dtstart,'&bookend=',$dtend,'&bookfac=',$facid,'&bookuser=',$_SESSION['username'],'">
								Block</a></td>';
							} else {
								echo '<td><a class="btn btn-primary" href="confirm-booking.php?bookdate=',$date,'&bookreg=',$reg,'&bookstart=',$dtstart,'&bookend=',$dtend,'&bookfac=',$facid,'&bookuser=',$_SESSION['username'],'">
								Book</a></td>';
							}
						}
						else 
						{			
							echo "<script> console.log('Sending to login page'); </script>";	
							echo '<td><a class="btn btn-primary" href="login.php?bookdate=',$date,'&bookstart=',$dtstart,'&bookend=',$dtend,'&bookfac=',$facid,'&bookreg=',$reg,'">
							Book</a></td>';
						}						 
					}
					else 
					{
						echo '<td><button type="button" class="btn btn-default" disabled="disabled">Booked</button></td>';
					}
				?>			
				
			</tr>	
<?php			
		}
		echo '</tbody></table></div>';
	}

				
	}



?>
<?php close_db($conn); ?>
<?php include ("footer.php");?>