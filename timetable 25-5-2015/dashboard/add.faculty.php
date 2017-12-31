<?php
   session_start();
  
if(@$_SESSION['user_id']){
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/header.php";
   include_once($path);
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/timetable/class.database.php";
   include_once($path);
   
   include_once("navbar.php");
  
	
	function GetFacultyInfo($user_id,$facultycode){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM faculty WHERE faculty_code = '$facultycode' AND user_id='$user_id'");
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
	
	function add_faculty($user_id,$code,$name,$designation,$qualification){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->prepare("INSERT INTO faculty (user_id,faculty_code, faculty_name, designation, qualification) VALUES(?,?,?,?,?)");
			$values = array ($user_id,$code,$name,$designation,$qualification);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}
	
	if(isset($_POST['submit']))
	{
			$check_faculty = GetFacultyInfo($_SESSION['user_id'], $_POST['fcode']);
		if($check_faculty === 0){
			$count= add_faculty($_SESSION['user_id'],$_POST['fcode'],$_POST['name'],$_POST['d'],$_POST['q']);
			if($count){ 
			
			echo 	'<div class="alert alert-success">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Tada Success! </strong>Added Successfully.  
					</div>'; 
			}
			else{
				echo '<div class="alert alert-block">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Not Added.  
					</div>';  
			}
		}
		else{
			echo '<div class="alert alert-block">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Subject Already Exists.  
					</div>'; 			
		}
		
	}
	
}
else{
	echo "You are not logged in yet. please go back and login again";
	exit();
}
?>


<div class="container"> 
  <div class="row">
    <div class="col-lg-6">
		<div class="jumbotron">

				<form class="form-horizontal" method= "post" action="">
				<fieldset>

				<!-- Form Name -->
				<legend>Add Faculty</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="name">Faculty Code</label>  
				  <div class="col-md-8">
				  <input id="fcode" name="fcode" type="text" placeholder="" class="form-control input-md" required="">
					
				  </div>
				</div>
				
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="name">Faculty Name</label>  
				  <div class="col-md-8">
				  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="l">Designation</label>  
				  <div class="col-md-8">
				  <input id="d" name="d" type="text" placeholder="" class="form-control input-md" required="">
				  <span class="help-block"></span>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="t">Qualification</label>  
				  <div class="col-md-8">
				  <input id="q" name="q" type="text" placeholder="" class="form-control input-md" required="">
				  <span class="help-block"></span>  
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="submit"></label>
				  <div class="col-md-8">
					<button id="submit" name="submit" class="btn btn-primary">Add Faculty</button>
				  </div>
				</div>

				</fieldset>
				</form>
		</div>		
    </div>
    <div class="col-lg-6">
		<div class="jumbotron">
		<?php
			if($_SESSION['user_id']){
				
				function deletefac($faculty_id, $user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$link->query("DELETE FROM  `timetable`.`faculty` WHERE  `faculty`.`faculty_id` ='$faculty_id' AND `faculty`.`user_id`='$user_id'");
				}
				if(isset($_GET['delete'])){
					 deletefac($_GET['id'],$_SESSION['user_id']);
					 echo 	'<div class="alert alert-success">  
							<a class="close" data-dismiss="alert">X</a>  
							<strong>Tada Success! </strong>Successfully Deleted.  
							</div>'; 
				}
				
				// This function lists all the timetable created till now.. with options like delete, edit
				function Facultylist($user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$query = $link->query("SELECT * FROM faculty WHERE user_id='$user_id'");
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					
					echo
						  "<h2>List of Faculty Already Added</h2>".          
						  "<table class='table'>".
							"<thead>".
							  "<tr>".
								"<th>Faculty Id</th>".
								"<th>Faculty Code</th>".
								"<th>Faculty Name</th>".
								"<th>Designation</th>".
								"<th>Qualification</th>".
								"<th>Options</th>".
							  "</tr>".
							"</thead>".
							"<tbody>";
							
							while($result = $query->fetch()){
							  echo "<tr>"
									 ."<td>".$result['faculty_id']."</td>"
									 ."<td>".$result['faculty_code']."</td>"
									 ."<td>".$result['faculty_name']."</td>"
									 ."<td>".$result['designation']."</td>"
									 ."<td>".$result['qualification']."</td>"
									 ."<td><a href='add.faculty.php?delete=true&id=".$result['faculty_id']."'>Delete</a></td>"
									 ."</tr>".
							  "</tr>";
							}  
					echo	"</tbody>".
						  "</table>".
						"</div>";
						
				}
				
				Facultylist($_SESSION['user_id']);
			}
			else{
				echo "You are not logged in yet. Please go back and login again";
			}
		?>
		
		</div>
    </div>
  </div>
  
</div>