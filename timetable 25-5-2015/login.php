<?php 
   session_start();
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/header.php";
   include_once($path); 

   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/class.ManageUsers.php";
   include_once($path);
   
   $users = new ManageUsers();
   
   
   if(isset($_POST['lgn']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$count = $users->LoginUsers($username, $password);
		if($count ==0)
		{
			echo "You are not yet Registered";
		}
		else if($count == 1)
		{
			$make_sessions = $users->GetUserInfo($username);
				foreach($make_sessions as $userSessions)
				{
					$_SESSION['name'] = $userSessions['username'];
					if(isset($_SESSION['name']))
					{
						header("location: dashboard/dashboard.php");
					}
				}
		}
		
	}
	
	
?>
<body>
	<nav class="navbar navbar-default navbar-static-top">
	  <div class="container">
	  <h3>Time Table Builder</h3>
	  </div>
	</nav>
	
	<div id="content">
		<div id="form">
		<form class="form-horizontal" method="post" action="">
			<fieldset>

			<!-- Form Name -->
			<legend>Login Here</legend>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="username">Username</label>  
			  <div class="col-md-4">
			  <input id="username" name="username" type="text" placeholder="" class="form-control input-md" required="">
				
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
			  <label class="col-md-4 control-label" for="login"></label>
			  <div class="col-md-4">
				<input type="submit" name="lgn" class="btn btn-success" value="Login">
			  </div>
			</div>

			</fieldset>
		</form>
		</div>
	</div>

</body>
<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/footer.php";
   include_once($path);
?>