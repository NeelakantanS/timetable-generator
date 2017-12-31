<?php
   session_start();
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/header.php";
   include_once($path);
   include_once("navbar.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/class.database.php";
   include_once($path);
   
   if(@$_SESSION['name']){
		
		
		function calculate_ltp(){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			
		}
		
		$count =0;
		
		$db_connection = new dbConnection();
		$link = $db_connection->connect(); 
		$query = $link->query("SELECT data, branch_name, year, semester, course
		FROM tablesheet s JOIN timetable t ON s.timetable_id = t.timetable_id ");
		$query->setFetchMode(PDO::FETCH_ASSOC);		
			while($result = $query->fetch()){
				$subcode= $result['data'];
				$branch_name = $result['branch_name'];
				$year = $result['year'];
				$semester = $result['semester'];
				$course = $result['course'];
				
				$query = $link->query("SELECT subject_id FROM subject WHERE subject_code ='$subcode'");
				$query->setFetchMode(PDO::FETCH_ASSOC);	
				while($result = $query->fetch()){
					$subid = $result['subject_id'];
					
					$query = $link->query("SELECT faculty_name, subject_name
										FROM course c JOIN faculty f ON c.faculty_id = f.faculty_id 
										JOIN subject s ON s.subject_id = c.subject_id WHERE course_name =  '$course' AND semester ='$semester' ");
					$query->setFetchMode(PDO::FETCH_ASSOC);	
					while($result = $query->fetch()){
						$faculty_name = $result['faculty_name'];
						$subject_name = $result['subject_name'];
						$count++;
						
						//$l = $result['l'];
						//$t = $result['t'];
						//$p = $result['p'];
						//$total_ = $l+$t+$p
					}
					
				}
				$total_load = $count;
				
				echo "<table border ='1'>".
					"<tr><td>".$subid."</td>".
						"<td>".$subcode."</td>".
						"<td>".$branch_name."</td>".
						"<td>".$year."</td>".
						"<td>".$semester."</td>".
						"<td>".$course."</td>".
						"<td>".$faculty_name."</td>".
						"<td>".$subject_name."</td>".
						"<td>".$count."</td>".
					"</tr></table><br>";
						
			}
		
		
		
		
		              
   }
   else
   {
	 echo "You are not logged in.";
   }
?>