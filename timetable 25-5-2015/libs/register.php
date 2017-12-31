<?php
	session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/timetable/class.ManageUsers.php";
    include_once($path);
	
	$users = new ManageUsers();
	
	if(isset($_POST['register']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$date = date("Y-m-d");
		$time = date("H:i:s");
		
		$check_availability = $users->GetUserInfo($username);
		if($check_availability ==0)
		{
			$register_user = $users->registerUsers($password, $ip_address, $date, $time, $username, $email, $uname);
			if($register_user == 1)
			{
				$make_sessions = $users->GetUserInfo($username);
				foreach($make_sessions as $userSessions)
				{
					$_SESSION['name'] = $userSessions['username'];
					if(isset($_SESSION['name']))
					{
						header("location: ../dashboard/dashboard.php");
					}
				}
			}
		}
		else
		{
			echo $error = "Username Already taken";
		}
		
	}
?>