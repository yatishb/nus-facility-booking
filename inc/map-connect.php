<?php include("header.php"); ?>
<script src="https://code.jquery.com/jquery.js"></script>
<h2 class="nusblue">Loading....</h2>
<div class="progress progress-striped active">
  <div class="progress-bar"  role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
    <span class="sr-only">90% Complete</span>
  </div>
</div>

<?php
	$regid = $_GET['region'];
?>

<form id="mapform" action="/cs2102/inc/book-search.php" method="post">
<input type="hidden" name="region" value=<?php echo $regid; ?>>
<input type="hidden" name="facility" value="ANY">
<input type="hidden" name="facility-type" value="ANY">
<input type="hidden" name="start-time" value="ANY">
<input type="hidden" name="end-time" value="ANY">
<input type="hidden" name="date" value="ANY">
<input type="hidden" name="submit1" value="ANY">
</form>

<script type="text/javascript">
document.getElementById("mapform").submit();
</script>

<?php include("footer.php"); ?>