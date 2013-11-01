<?php include("header.php"); ?>

<script>
document.getElementById("mastlink-login").className = "active";
</script>



<div class = "row center">
<div class = "span10 center">
<div class = "row center">
	<div class = "span4 offset2 border-right">
	  <form class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" class="input-block-level" placeholder="Username">
        <input type="password" class="input-block-level" placeholder="Password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit">Login</button>
      </form>
	</div>
	<div class = "span4">
	  <form class="form-signin">
        <h2 class="form-signin-heading">Register</h2>
        <input type="text" class="input-block-level" placeholder="Name">
        <input type="text" class="input-block-level" placeholder="Username">
        <input type="password" class="input-block-level" placeholder="Password">
        <input type="password" class="input-block-level" placeholder="Confirm Password">
        <label class="checkbox">
        </label>
        <button class="btn btn-large btn-primary" type="submit">Sign Up</button>
      </form>
	</div>
</div>
</div>
</div>

<?php include("footer.php"); ?>