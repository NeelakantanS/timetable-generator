<?php
   session_start();
   include_once('class.database.php');
   
   $db_connection = new dbConnection();
   $link = $db_connection->connect(); 
   
   function count_ltp($celldata,$user_id){
	   $db_connection = new dbConnection();
	   $link = $db_connection->connect(); 	   
	   $query = $link->query("SELECT * FROM subject WHERE subject_code='$celldata' AND user_id='$user_id'"); 
	   $query->setFetchMode(PDO::FETCH_ASSOC);
			while($result = $query->fetch()){
				$l = $result['l'];
				$t = $result['t'];
				$p = $result['p'];
				$total = $l+$t+$p;
			}
		return $total;
	   
   }
   
   function count_sub($celldata,$timetable_id, $user_id){
	   $count = 0;
	   $db_connection = new dbConnection();
	   $link = $db_connection->connect(); 	   
	   $query = $link->query("SELECT * FROM tablesheet WHERE data='$celldata' AND timetable_id='$timetable_id' AND user_id='$user_id'"); 
	   $query->setFetchMode(PDO::FETCH_ASSOC);
			while($result = $query->fetch()){
				$sub = $result['data'];
				$count++;
			}
		return $count;
		
   }
   
   
	function check_faculty_collision($faculty_name, $cellid, $user_id){
		$db_connection = new dbConnection();
	    $link = $db_connection->connect(); 	   
	    $query = $link->query("SELECT * FROM tablesheet WHERE cell='$cellid' AND faculty_name='$faculty_name' AND user_id='$user_id'"); 
	    $rowCount = $query->rowCount();	
		if($rowCount)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
   
	if(!empty($_POST["cellid"]) && !empty($_POST["celldata"]))
		{
			// we insert cellid, cell data and timetable id from timetable table..
			$cellid = $_POST["cellid"];
			$celldata = $_POST["celldata"];
			$timetable_id = $_SESSION['id'];
			$user_id= $_SESSION['user_id'];
			
			
			$query = $link->query("SELECT * FROM tablesheet WHERE cell='$cellid' AND user_id='$user_id'"); 
		    $query->setFetchMode(PDO::FETCH_ASSOC);
			while($result = $query->fetch()){
				$r = $result['data'];
			}
			
			if(strcmp(@$r, $celldata) == 0)
			{
				echo "COLLISION DETECTED. This faculty has already been assigned at this time and day. Data Not saved press F5 to Refresh";
			}
			else{
				
				if(count_sub($celldata,$timetable_id,$user_id)<count_ltp($celldata,$user_id)){
					
					$query = $link->query("SELECT DISTINCT faculty_name FROM course 
					c JOIN faculty f ON c.faculty_id = f.faculty_id 
					JOIN subject s ON s.subject_id = c.subject_id WHERE subject_code='$celldata' AND c.user_id='$user_id'"); 
					
					$query->setFetchMode(PDO::FETCH_ASSOC);
					while($result = $query->fetch()){
						$faculty_name = $result['faculty_name'];
					}
					if(check_faculty_collision($faculty_name, $cellid, $user_id)){
						echo "COLLISION DETECTED. This faculty has already been assigned at this time and day. Data Not saved press F5 to Refresh";
					}
					else{
						$query = $link->prepare("INSERT INTO tablesheet(`cell`, `data`, `faculty_name`, `timetable_id`, `user_id`) VALUES(?,?,?,?,?)");
						$values = array ($cellid, $celldata, $faculty_name, $timetable_id, $user_id);
						$query->execute($values);
						$rowCount = $query->rowCount();	
						if($rowCount){
							echo "Successful";
						}
					}					
				}
				else
				{
					echo "You can't exceed the maximum lecture and tutorial for this subject. The last dragged element was not saved. Refresh using F5";
				}
			}
		}
		
	if(!empty($_POST["cellid"]) && empty($_POST["celldata"]))
	{		
		$timetable_id = $_SESSION['id'];
		$user_id= $_SESSION['user_id'];
		$deletecell = $_POST["cellid"];
		$query = $link->query("SELECT * FROM tablesheet WHERE timetable_id='$timetable_id' AND user_id='$user_id'");
		$rowCount = $query->rowCount();		
			if($rowCount){
					$query = $link->query("DELETE FROM tablesheet WHERE cell='$deletecell' AND timetable_id='$timetable_id' AND user_id= '$user_id'");
					$rowCount = $query->rowCount();	
					if($rowCount){
						echo "Successfully deleted ";
					}
				}
				else
				{
					echo "";
				}		
	}

?>