<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$conn = setup_db();
$query = "SELECT * FROM region;";
$result = mysql_query($query);
?>
<div style="text-align:center">
	<h2 class="nusorange" style="margin-top:-10px">Search using the dropdowns</h2><br>
	<form class="form-inline" role="form" method="POST" action="/cs2102/inc/book-search.php">
		<div class="form-group">
		<label class="nusblue" for="region">Region</label>
		<select class="form-control" id="region" name="region">
			<?php
				if ($result) :
				echo '<option value="ANY"> Any </option>';	
				while ($row = mysql_fetch_assoc($result))
				{
					echo '<option value="', $row['reg_id'], '">', $row['name'], '</option>';
				}
				endif;
			?>
		</select>
		</div>&nbsp&nbsp&nbsp
		
		<div class="form-group">
		<label class="nusblue" for="facility-type">Type</label>
		<select class="form-control" id="facility-type" name="facility-type">
			<option value="ANY"> Any </option>
			<option value="academic"> Academic </option>
			<option value="sports"> Sports </option>
		</select>
		</div>&nbsp&nbsp&nbsp

		<div class="form-group">
		<label class="nusblue" for="facility">Facility</label>
		<select class="form-control" id="facility" name="facility">
			<option>Please choose from above</option>
		</select>
		</div><br><br>

		<div class="form-group">
		<label class="nusblue" for="start-time">Start Time</label>
		<select class="form-control input-sm" id="start-time" name="start-time">
			<option value="ANY"> Any </option>
			<?php
				$query = "SELECT `start` 
						FROM timeslot 
						ORDER BY `start`;";
				$result = mysql_query($query);
				if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					echo '<option value="', $row['start'], '">', $row['start'], '</option>';
				}
				endif;
			?>			
		</select>
		</div>&nbsp&nbsp&nbsp

		<div class="form-group">
		<label class="nusblue" for="end-time">End Time</label>
		<select class="form-control input-sm" id="end-time" name="end-time">
			<option value="ANY"> Any </option>
			<?php
				$query = "SELECT  `end` , ADDTIME(`end`,1) AS  `enddisplay` 
							FROM timeslot
							ORDER BY  `end`";
				$result = mysql_query($query);
				if ($result) :
				while ($row = mysql_fetch_assoc($result))
				{
					if($row['enddisplay']=="24:00:00")
					{
						$row['enddisplay'] = "00:00:00";
					}
					echo '<option value="', $row['end'], '">', $row['enddisplay'], '</option>';
				}
				endif;
			?>			
		</select>
		</div>&nbsp&nbsp&nbsp

		<div class="form-group">
		<label class="nusblue" for="date">Date</label>		
		<select class="form-control input-sm" id="date" name="date">
			<option value="ANY"> Any </option>
			<?php
				$today = date('Y-m-d');
				$count = 7;
				$i =  1;
				while ($count>0)
				{
					echo '<option value="', $today, '">', $today, '</option>';
					$today = date('Y-m-d',strtotime("+".$i." days"));
					$i+=1;
					$count-=1;
				}
				
			?>			
		</select>
		</div>
	<br><br>
	<p>
	<input name="submit" class="btn btn-warning btn-lg" type="submit" value="Search"></input>
	</p>
	</form>
	<?php //close_db($conn); ?>

<script>

	$("#region").ready(function() {
	var reg = (document.getElementById("region").value);
	var type = (document.getElementById("facility-type").value);
	console.log(type);
	console.log(reg);
	$("#facility").load("/cs2102/inc/getter.php?region="+reg+"&type="+type);
	});

	$("#region").change(function() {
	var reg = (document.getElementById("region").value);
	var type = (document.getElementById("facility-type").value);
	console.log(type);
	console.log(reg);
	$("#facility").load("/cs2102/inc/getter.php?region="+reg+"&type="+type);
	});

	$("#facility-type").change(function() {
	var reg = (document.getElementById("region").value);
	var type = (document.getElementById("facility-type").value);
	console.log(type);
	console.log(reg);
	$("#facility").load("/cs2102/inc/getter.php?region="+reg+"&type="+type);
	});

</script>	
</div>