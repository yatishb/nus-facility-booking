<?php include("inc/header.php"); ?>
<script>
document.getElementById("mastlink-home").className = "active";
</script>

<div class="home-holder">
	<form class="form-horizontal" action="login.php" method="post">
		<p class="heading-search nusorange">Search for a facility</p>
        <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Region</label>
	        <div class="col-sm-6">
	        <select class="form-control">
			  <option>Choose Region</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
	        </div>
        </div>
        <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Facility</label>
	        <div class="col-sm-6">
	        <select class="form-control">
			  <option>Choose Facility</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			</select>
	        </div>
        </div>
         <div class="form-group">
	        <label for="inputEmail3" class="col-sm-2 control-label nusblue">Date/Time</label>
	        <div class="col-sm-6">
			    <input type="text" class="form-control dateform-left" placeholder="dd/mm/yyyy HH:MM"></input>
			    <input type="text" class="form-control dateform-right" placeholder="dd/mm/yyyy HH:MM"></input>
			  </div>
	        </div>
        <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-6">
		        <button class="btn btn-warning" type="submit">Search</button>
	        </div>
        </div>
    </form>
</div>

<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
  });
</script>

<br><br>

<div class="map-holder">
<img src="/cs2102/img/map.png" alt="" usemap="#map" width="900">
<map name="map">
    <area shape="poly" coords="173, 525, 197, 511, 224, 507, 261, 513, 285, 539, 246, 529, 270, 580, 249, 588, 271, 550, 239, 537, 245, 527, 237, 525, 219, 525, 176, 524, 218, 532, 216, 535, 194, 512, 224, 506, 261, 514, 246, 541, 268, 532, 272, 566, 248, 588, 279, 549, 251, 535" href="/cs2102/inc/search.html" class="bgblue"/>
</map>
</div>

<?php include("inc/footer.php"); ?>
