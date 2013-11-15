<?php

	function getAllRegions() {
		$query = "SELECT R.reg_id, R.name, R.location FROM region R;";
		$result = mysql_query($query);
		$regions = array();
		while($rows = mysql_fetch_array($result)) {
			$eachregion = array(
							'id' => $rows[0],
							'region' => $rows[1],
							'location' =>$rows[2]
							);
			array_push($regions, $eachregion);
		}
		return $regions;
	}

	function getFacilityInRegion($idRegion) {
		$query = "SELECT f.fac_id, f.name 
				  FROM facility f 
				  WHERE f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);
		$facilities = array();
		while($rows = mysql_fetch_array($result)) {
			$eachFac = array(
							'id' => $rows[0],
							'facility' => $rows[1]
							);
			array_push($facilities, $eachFac);
		}
		return $facilities;
	}

	function getAllAcademicFacilitiesInRegion($idRegion, $facilities){
		$query = "SELECT f.fac_id, f.name, f.open_time, f.close_time, f.capacity, a.whiteboard, a.audio_system, a.projector 
				  FROM facility f
				  INNER JOIN academic a
				  ON a.fac_id = f.fac_id
				  WHERE f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);

		while($rows = mysql_fetch_array($result)) {
			$eachFac = array(
							'id' => $rows[0],
							'name' => $rows[1],
							'open' => $rows[2],
							'close' => $rows[3],
							'capacity' => $rows[4],
							'whiteboard' => $rows[5],
							'audio' => $rows[6],
							'projector' => $rows[7],
							'scoreboard' => 0,
							'spectator' => 0,
							'type' => 'academic'
							);
			array_push($facilities, $eachFac);
		}
		return $facilities;
	}

	function getAllSportsFacilitiesInRegion($idRegion, $facilities){
		$query = "SELECT f.fac_id, f.name, f.open_time, f.close_time, f.capacity, s.scoreboard, s.spectator_area 
				  FROM facility f
				  INNER JOIN sports s
				  ON s.fac_id = f.fac_id
				  WHERE f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);

		while($rows = mysql_fetch_array($result)) {
			$eachFac = array(
							'id' => $rows[0],
							'name' => $rows[1],
							'open' => $rows[2],
							'close' => $rows[3],
							'capacity' => $rows[4],
							'whiteboard' => 0,
							'audio' => 0,
							'projector' => 0,
							'scoreboard' => $rows[5],
							'spectator' => $rows[6],
							'type' => 'sports'
							);
			array_push($facilities, $eachFac);
		}
		return $facilities;
	}

	function getNumberFacilitiesInRegion($idRegion) {
		$query = "SELECT count(*) 
				  FROM facility f 
				  WHERE f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);
		$countFac = mysql_fetch_row($result);
		$countFac = $countFac[0];
		return $countFac;
	}

	function getAllDetailsFacility($idFac, $idRegion) {
		$query = "SELECT * FROM facility f 
				  WHERE f.fac_id=".$idFac." 
				  AND f.reg_id = ".$idRegion.";";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$facility = array(
						'id' => $row[0],
						'reg_id' => $row[1],
						'open' => $row[2],
						'close' => $row[3],
						'capacity' => $row[4],
						'name' => $row[5],
						'type' => $row[6]
						);

		$query = "SELECT R.name, R.location 
				  FROM region R 
				  WHERE R.reg_id = ".$facility['reg_id'].";";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$facility['regname'] = $row[0];
		$facility['location'] = $row[1];

		if($facility['type'] == 'academic') {
			$query = "SELECT * 
					  FROM academic a 
					  WHERE a.fac_id = ".$facility['id'].";";
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			$facility['whiteboard'] = $row[2];
			$facility['audio'] = $row[3];
			$facility['projector'] = $row[4];
			$facility['scoreboard'] = 0;
			$facility['spectator'] = 0;
		} else if($facility['type'] == 'sports') {
			$query = "SELECT * 
					  FROM sports s 
					  WHERE s.fac_id = ".$facility['id'].";";
			$result = mysql_query($query);
			$row = mysql_fetch_row($result);
			$facility['scoreboard'] = $row[2];
			$facility['spectator'] = $row[3];
			$facility['whiteboard'] = 0;
			$facility['audio'] = 0;
			$facility['projector'] = 0;
		}
		
		return $facility;
	}

?>