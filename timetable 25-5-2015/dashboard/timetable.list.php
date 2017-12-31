<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/timetable/class.database.php";
	include_once($path);

if($_SESSION['user_id']){	

	// This function lists all the timetable created till now.. with options like delete, edit
    function timetablelist($user_id){
		$db_connection = new dbConnection();
		$link = $db_connection->connect(); 
		$query = $link->query("SELECT * FROM timetable WHERE user_id='$user_id'");
		$query->setFetchMode(PDO::FETCH_ASSOC);
		
		
		echo
			  "<h2>Automatically Saved Timetables</h2>".            
			  "<table class='table'>".
				"<thead>".
				  "<tr>".
					"<th>Course Name</th>".
					"<th>Semester</th>".
					"<th>Options</th>".
				  "</tr>".
				"</thead>".
				"<tbody>";
				
				while($result = $query->fetch()){
				  echo "<tr>"
						 ."<td>".$result['course_full_name']."</td>"
						 ."<td>".$result['semester']."</td>"
						 ."<td><a href='delete.table.php?delete=true&id=".$result['timetable_id']."'><span class='glyphicon glyphicon-trash'></span></a> | 
							<a href='../view.table.php?view=true&id=".$result['timetable_id']."&year=".$result['year']."&semester=".$result['semester']."&coursecode=".$result['course']."&coursefullname=".$result['course_full_name']."'><span class='glyphicon glyphicon-search'></span></a>
							| <a href='../edit.table.php?edit=true&id=".$result['timetable_id']."&year=".$result['year']."&semester=".$result['semester']."&coursecode=".$result['course']."&coursefullname=".$result['course_full_name']."'><span class='glyphicon glyphicon-pencil'></span></a></td>"
						 ."</tr>".
				  "</tr>";
				}  
		echo	"</tbody>".
			  "</table>".
			"</div>";
			
	}
	
	timetablelist($_SESSION['user_id']);
}
else{
	echo "You are not logged in yet. Please go back and login again";
}
?>
