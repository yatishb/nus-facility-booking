<?php include("header.php"); ?>

<div class="search-holder">
<form class="form-inline" role="form">
  <div class="form-group">
    <select class="form-control">
	  <option>Choose Region</option>
	  <option>2</option>
	  <option>3</option>
	  <option>4</option>
	  <option>5</option>
	</select>
  </div>
  <div class="form-group">
    <select class="form-control">
	  <option>Choose Facility</option>
	  <option>2</option>
	  <option>3</option>
	  <option>4</option>
	  <option>5</option>
	</select>
  </div>
  <div class="form-group">
  <input type="text" class="form-control" placeholder="Start Date-Time"></input>
  </div>
  <div class="form-group">
  <input type="text" class="form-control" placeholder="End Date-Time"></input>
  </div>
  <button type="submit" class="btn btn-primary">Search</button>
</form>
</div>
<br>
<table class="table table-bordered">
  <tr class="table-heading nusblue"><td>Facility</td><td>Type</td><td>Status</td><td>Free Slots</td></tr>
  <tr><td>Central Library Discussion Room 1</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>14</td></tr>
  <tr><td>Central Library Discussion Room 2</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>16</td></tr>
  <tr><td>Central Library Discussion Room 3</td><td>Academic</td><td><span class="label label-danger">Full</span></td><td>0</td></tr>
  <tr><td>Central Library Discussion Room 4</td><td>Academic</td><td><span class="label label-warning">Few Slots</span></td><td>3</td></tr>
    <tr><td>Central Library Discussion Room 5</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>14</td></tr>
  <tr><td>Central Library Discussion Room 6</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>16</td></tr>
  <tr><td>Central Library Discussion Room 7</td><td>Academic</td><td><span class="label label-danger">Full</span></td><td>0</td></tr>
  <tr><td>Central Library Discussion Room 8</td><td>Academic</td><td><span class="label label-warning">Few Slots</span></td><td>3</td></tr>
    <tr><td>Central Library Discussion Room 9</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>14</td></tr>
  <tr><td>Central Library Discussion Room 10</td><td>Academic</td><td><span class="label label-success">Available</span></td><td>16</td></tr>
  <tr><td>Central Library Discussion Room 11</td><td>Academic</td><td><span class="label label-danger">Full</span></td><td>0</td></tr>
  <tr><td>Central Library Discussion Room 12</td><td>Academic</td><td><span class="label label-warning">Few Slots</span></td><td>3</td></tr>
</table>

<ul class="pagination middle">
  <li><a href="#">&laquo;</a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>

<?php include("footer.php"); ?>