<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/header.php";
   include_once($path);
?>
<body>
	<nav class="navbar navbar-default navbar-static-top">
	  <div class="container">
	  <h3>Time Table Builder</h3>
	  </div>
	</nav>
	
	<div id="content">
		<div id="form">
		<form class="form-horizontal" method="post" action="libs/register.php">
			<fieldset>

			<!-- Form Name -->
			<legend>Register Here</legend>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="username">Collage Name</label>  
			  <div class="col-md-4">
			  <input id="uname" name="uname" type="text" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="username">Username</label>  
			  <div class="col-md-4">
			  <input id="username" name="username" type="text" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="email">Email</label>  
			  <div class="col-md-4">
			  <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Password input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="password">Password</label>
			  <div class="col-md-4">
				<input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="register"></label>
			  <div class="col-md-4">
				<input type="submit" id="register" name="register" class="btn btn-success" value="Register">
			  </div>
			</div>

			</fieldset>
		</form>
		</div>
		<div id="login">
		Already Registered. <a href="../timetable/login.php">Login </a>
		</div>
	</div>
			
			


</body>
<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/footer.php";
   include_once($path);
?>