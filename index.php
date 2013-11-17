<?php include("inc/header.php"); ?>
<script>
document.getElementById("mastlink-home").className = "active";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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

<br><br>

<?php include("inc/map.php"); ?>

<?php include("inc/footer.php"); ?>
