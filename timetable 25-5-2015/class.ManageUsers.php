<?php
	include_once('class.database.php');
	
	class ManageUsers{
		public $link;
		
		function __construct(){
			$db_connection = new dbConnection();
			$this->link = $db_connection->connect();
			return $this->link;
		}
		
		function registerUsers($password, $ip_address, $date, $time, $username, $email, $uname){
			$query = $this->link->prepare("INSERT INTO users (password,ip_address,date,time,username, email, uname) VALUES(?,?,?,?,?,?,?)");
			$values = array ($password, $ip_address, $date, $time, $username, $email, $uname);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}
		
		function LoginUsers($username, $password){
			$query = $this->link->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
			$rowCount = $query->rowCount();
			return $rowCount;
		}
		
		function GetUserInfo($username){
			$query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
			$rowCount = $query->rowCount();
			if($rowCount ==1)
			{
				$result = $query->fetchAll();
				return $result;
			}
			else
			{
				return $rowCount;
			}
		}
		
	}
	
?>