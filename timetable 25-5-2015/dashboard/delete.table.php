<?php
	session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/timetable/class.database.php";
	include_once($path);
	
if($_SESSION['user_id']){
		//the below function deletes a table when user clicks the delete link...
		
		function deletetable($timetable_id,$user_id) {
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
				
			$query = $link->query("DELETE FROM `timetable`.`timetable` WHERE `timetable`.`timetable_id` ='$timetable_id' AND `timetable`.`user_id`='$user_id'");
			$query = $link->query("DELETE FROM  `timetable`.`tablesheet` WHERE  `tablesheet`.`timetable_id` ='$timetable_id' AND `tablesheet`.`user_id`='$user_id'");
			 
		}
		// When user clicks delete deletetable function is called here with parameters semester, course, branch.. 
		
		if (isset($_GET['delete'])) {
			deletetable($_GET['id'],$_SESSION['user_id']);
			echo 	'<div class="alert alert-success">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Tada Success! </strong>Table Successfully deleted.  
					</div>'; 
		  }	
}

?>