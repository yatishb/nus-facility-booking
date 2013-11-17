<html>
<head></head>
<body>
<script src="https://code.jquery.com/jquery.js"></script>
<h2>LOADING....</h2>

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
/*$("#mapform").change(​
function() {
var frm = document.getElementById("mapform");
frm.submit();
});
window.onload = myfunc;*/
document.getElementById("mapform").submit();
</script>

</body>
</html>