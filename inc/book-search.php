<?php include ("header.php");?>

<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
?>
<div class="home-holder">
<?php
include ($root."/cs2102/inc/search-bar.php");	
?>
</div>
<?php
if (isset($_POST['submit']) || isset($_POST['submit1'])) :
			$region = mysql_real_escape_string($_POST['region']);
			$facility = mysql_real_escape_string($_POST['facility']);
			$facilitytype = mysql_real_escape_string($_POST['facility-type']);
			$starttime0 = mysql_real_escape_string($_POST['start-time']);
			$starttime = mysql_real_escape_string($_POST['start-time']);
			$endtime0 = mysql_real_escape_string($_POST['end-time']);
			$endtime = mysql_real_escape_string($_POST['end-time']);
			$bookdate0 = mysql_real_escape_string($_POST['date']);
			$bookdate = mysql_real_escape_string($_POST['date']);
			$page = mysql_real_escape_string($_POST['page']);
			
			$next = $page+1;
			$prev = $page-1;
			$limit=10;
			$offset =($page-1)*$limit;
			$count=0;
			
			if($starttime >= $endtime && !($starttime=="ANY") && !($endtime=="ANY"))
			{
				echo '<script>alert("Invalid time duration");
									</script>';
			}
			//echo $region," ",$facility," ",$facilitytype," ",$starttime," ",$endtime," ",$bookdate;

			mysql_query("DROP VIEW IF EXISTS facility_slots;");
			$query ="CREATE VIEW facility_slots
					AS
					SELECT f.fac_id, COUNT( t.start ) AS `num` 
					FROM facility f, timeslot t
					WHERE t.start >= f.open_time
					AND t.end <= f.close_time AND ";
			if($starttime=="ANY" && $endtime=="ANY" && $bookdate=="ANY")
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.=" t.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and t.end <= CONCAT('".$bookdate."', ' ','23:59:59')";
							
				}
				elseif ($starttime=="ANY" && $endtime=="ANY" && (!($bookdate=="ANY")))
				{
					if(!($bookdate == date('Y-m-d')))
					{
						$query.="t.start >= CONCAT('".$bookdate."', ' ','00:00:00')
							 and t.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					} else {
						$query.="t.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and t.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					}
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && $bookdate=="ANY") 
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.="t.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and t.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && !($bookdate=="ANY"))
				{
					$query.="t.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and t.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}
			$query.="GROUP BY f.fac_id";
			$query.=";";
			echo '<script>console.log ("',mysql_real_escape_string($query),'");</script>';
			$result1 = mysql_query($query);

			mysql_query("DROP VIEW IF EXISTS facility_booked_slots;");
			$query ="	CREATE VIEW facility_booked_slots
						AS
						SELECT b.fac_id,count(*) AS `num`
						from booking b";

				if($starttime=="ANY" && $endtime=="ANY" && $bookdate=="ANY")
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";
							
				}
				elseif ($starttime=="ANY" && $endtime=="ANY" && (!($bookdate=="ANY")))
				{
					if(!($bookdate == date('Y-m-d')))
					{
						$query.=" where b.start >= CONCAT('".$bookdate."', ' ','00:00:00')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					} else {
						$query.=" where b.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					}
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && $bookdate=="ANY") 
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and b.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && !($bookdate=="ANY"))
				{
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and b.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}

			$query.=" GROUP BY b.fac_id UNION SELECT f.fac_id, 0 FROM facility f WHERE f.fac_id NOT IN (SELECT b.fac_id FROM booking b ";
			if($starttime=="ANY" && $endtime=="ANY" && $bookdate=="ANY")
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";
							
				}
				elseif ($starttime=="ANY" && $endtime=="ANY" && (!($bookdate=="ANY")))
				{
					if(!($bookdate == date('Y-m-d')))
					{
						$query.=" where b.start >= CONCAT('".$bookdate."', ' ','00:00:00')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					} else {
						$query.=" where b.start >= CONCAT('".$bookdate."', ' ','".date('H:i:s')."')
							 and b.end <= CONCAT('".$bookdate."', ' ','23:59:59')";					
					}					
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && $bookdate=="ANY") 
				{
					$bookdate = date('Y-m-d');
					$bookdate2 = date('Y-m-d',strtotime("+3 days"));
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and b.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}
				elseif (!($starttime=="ANY") && !($endtime=="ANY") && !($bookdate=="ANY"))
				{
					$query.=" where b.start >= CONCAT('".$bookdate."', ' ','". $starttime."')
							 and b.end <= CONCAT('".$bookdate."', ' ','". $endtime."')";
				}
				$query.=");";
			//echo $query;
			echo '<script>console.log ("',mysql_real_escape_string($query),'");</script>';
			$result1 = mysql_query($query);


			$query ="SELECT f.name as `facility`,r.name as `region`, 
					f.type as `type`, a.num - b.num as `free`, 
					f.open_time,f.close_time,f.reg_id,f.fac_id
					FROM facility f, region r, facility_slots a,facility_booked_slots b
					WHERE f.reg_id = r.reg_id
					AND f.fac_id = a.fac_id
					AND f.fac_id = b.fac_id	";
			if(!($facility=="ANY"))
			{
				$query.= "	AND b.fac_id = ".$facility."
							group by b.fac_id";				
			}
			else
			{
				if($region =="ANY" && !($facilitytype =="ANY"))
				{
					$query.= "	AND b.fac_id 
								IN (SELECT fac_id 
									FROM facility 
									WHERE `type` ='".$facilitytype."' )
							group by b.fac_id";				
				}
				elseif (!($region =="ANY") && $facilitytype =="ANY")
				{
					$query.= "	AND b.fac_id 
								IN (SELECT fac_id 
									FROM facility 
									WHERE `reg_id` =".$region." )
							group by b.fac_id";				
				}
				elseif (!($region =="ANY") && !($facilitytype =="ANY"))
				{
					$query.= "	AND b.fac_id 
								IN (SELECT fac_id 
									FROM facility 
									WHERE `reg_id` =".$region."
									AND `type` = '".$facilitytype."' )
							group by b.fac_id";				
				}
				else
				{
					$query.= "	group by b.fac_id";					
				}

			}
			$query.=" LIMIT ".$limit." OFFSET ".$offset;
			$query.=";";
			//echo $query;
			echo '<script>console.log ("',mysql_real_escape_string($query),'");</script>';

			$result = mysql_query($query);
				if ($result) :
					echo '<br><h3 class="nusblue">Matching Results</h3><br><table class="table">
							<thead>
								<tr> 
									<th>Facility</th>
									<th>Region</th>
									<th>Type</th>
									<th>Available Slots</th>
									<th></th>
								</tr>
							</thead>		
							<tbody>';
					while ($row = mysql_fetch_array($result))
					{
			?>			
						<tr>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<?php 
							if(($starttime=="ANY") && ($endtime=="ANY") && $bookdate==date('Y-m-d'))
								{
									$starttime=date('H:i:s');
									$endtime=$row[5];		
								}
								elseif(($starttime=="ANY") && ($endtime=="ANY") && !($bookdate==date('Y-m-d')))
								{
									$starttime=$row[4];
									$endtime=$row[5];		
								}
								
							if($row[3] >5 ) {									
									
							?>
							<td>
							<a class="btn btn-primary" href="book-facility.php?facid=<?php echo $row[7]; ?>&
								start=<?php echo $starttime; ?>&
								end=<?php echo $endtime; ?>&
								date=<?php echo $bookdate; ?>&
								reg=<?php echo $row[6]; ?>">Book</a></td>
							<?php 
							} elseif($row[3] > 0){ ?>
								<td>
							<a class="btn btn-warning" href="book-facility.php?facid=<?php echo $row[7]; ?>&
								start=<?php echo $starttime; ?>&
								end=<?php echo $endtime; ?>&
								date=<?php echo $bookdate; ?>&
								reg=<?php echo $row[6]; ?>">Few Slots</a></td>
							<?php } else { ?>
								<td><button class="btn btn-danger" disabled="disabled" >No Slots</button></td>
							<?php } 

							if($facility != 'ANY' && $facility == $row[7]) {
								echo "Facility specified";
								echo '<script>window.location.href="/cs2102/inc/book-facility.php?facid=', $row[7],'&
												start=',$starttime,'&
												end=',$endtime,'&
												date',$bookdate,'&
												reg=',$row[6],'"; </script>';
							}
							$count+=1; ?>
						</tr>

			<?php		
					}
					echo '</tbody></table>';

?>

	
<?php if($prev>=1){ ?>
<form action="book-search.php" method="POST">
<input type="hidden" name="region" value=<?php echo $region; ?>>
<input type="hidden" name="facility" value=<?php echo $facility; ?>>
<input type="hidden" name="facility-type" value=<?php echo $facilitytype; ?>>
<input type="hidden" name="start-time" value=<?php echo $starttime0 ; ?>>
<input type="hidden" name="end-time" value=<?php echo $endtime0; ?>>
<input type="hidden" name="date" value=<?php echo $bookdate0?>>
<input type="hidden" name="page" value=<?php echo $prev?>>
<input type="submit" class="btn btn-sm btn-warning" value="PREV" name="submit">
</form>
</br>
<?php }?> 
<?php if($count == 10){ ?>
<form action="book-search.php" method="POST">
<input type="hidden" name="region" value=<?php echo $region; ?>>
<input type="hidden" name="facility" value=<?php echo $facility; ?>>
<input type="hidden" name="facility-type" value=<?php echo $facilitytype; ?>>
<input type="hidden" name="start-time" value=<?php echo $starttime0 ; ?>>
<input type="hidden" name="end-time" value=<?php echo $endtime0; ?>>
<input type="hidden" name="date" value=<?php echo $bookdate0?>>
<input type="hidden" name="page" value=<?php echo $next?>>
<input type="submit" class="btn btn-sm btn-warning" value="NEXT" name="submit">
</form>
<?php } ?>
	<?php endif;?>
	<?php endif; ?>
<?php close_db($conn); ?>
<?php include ("footer.php");?>