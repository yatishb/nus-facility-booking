<?php include("header.php"); ?>
<?php
	if($_SESSION['admin']) {
?>
<h3 class="nusblue">Welcome Admin!</h3><br>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Region
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
      		<a href="add-region.php" class="btn btn-success">Add New Region</a>
      		<a href="view-all-regions.php" class="btn btn-primary">View All Regions</a>
      		<a href="modify-region.php" class="btn btn-warning">Modify Regions</a>
      		<a href="remove-region.php" class="btn btn-danger">Remove Region</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Facility
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
      		<a href="add-academicroom.php" class="btn btn-success">Add New Academic Room</a>
      		<a href="add-sportsfac.php" class="btn btn-success">Add New Sports Facility</a>
      		<a href="view-all-facility-in-region.php" class="btn btn-primary">View All Facilities</a>
      		<a href="view-facility-details.php" class="btn btn-primary">View Facility Details</a>
      		<a href="modify-facility.php" class="btn btn-warning">Modify Facility</a>
      		<a href="remove-facility.php" class="btn btn-danger">Remove Facility</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Booking
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        	Yatish has not ADDED THIS !$!#$%!#
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          User
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
      		<a href="add-admin.php" class="btn btn-success">Add New Admin</a>
      </div>
    </div>
  </div>
</div>
<?php
	} else if(isset($_SESSION['username'])) {
		echo ("<h4>Sorry you are not an admin user !</h4>");
	} else{ ?>
		<script>window.location.href = "/cs2102/inc/login.php"; </script>
<?php	 } ?>

<?php include("footer.php"); ?>