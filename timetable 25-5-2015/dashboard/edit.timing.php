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
   
	function GetTimingInfo($user_id){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM timing WHERE user_id= '$user_id'");
			$rowCount = $query->rowCount();
			if($rowCount ==1)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	
	function add_timing($id, $one, $two, $three, $four, $five, $six, $seven, $eight){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->prepare("INSERT INTO timing (user_id, first, second, third, fourth, fifth, sixth, seventh, eight) VALUES(?,?,?,?,?,?,?,?,?)");
			$values = array ($id, $one, $two, $three, $four, $five, $six, $seven, $eight);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}
	
	if(isset($_POST['submit']))
	{
			$check_timing = GetTimingInfo($_SESSION['user_id']);
		if($check_timing){
			$count= add_timing($_SESSION['user_id'], $_POST['first'], $_POST['second'], $_POST['third'], $_POST['fourth'], $_POST['fifth'], $_POST['sixth'], $_POST['seventh'], $_POST['eight']);
			if($count){ 
			
			echo 	'<div class="alert alert-success">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Success! </strong>Added Successfully.  
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
					<strong>Opps Error!</strong>Timing Already Exists.  
					</div>'; 			
		}
		
	}
	
}
else{
	echo "You are not logged in yet. please go back and login again";
	exit();
}

?>
<body>
<div class="container"> 
  <div class="row">
    <div class="col-lg-6">
		<div class="jumbotron">
		
						
			<form class="form-horizontal" action="" method="POST">
				<fieldset>

				<!-- Form Name -->
				<legend>Lecture Timing</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="first">First Lecutre</label>  
				  <div class="col-md-8">
				  <input id="first" name="first" type="text" placeholder="e.g 8:45 - 9:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="second">Second Lecture</label>  
				  <div class="col-md-8">
				  <input id="second" name="second" type="text" placeholder="e.g 9:45 - 10:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="third">Third Lecture</label>  
				  <div class="col-md-8">
				  <input id="third" name="third" type="text" placeholder="e.g 10:45 - 11:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="fourth">Fourth Lecture</label>  
				  <div class="col-md-8">
				  <input id="fourth" name="fourth" type="text" placeholder="e.g 12:45 - 1:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="fifth">Fifth Lecture</label>  
				  <div class="col-md-8">
				  <input id="fifth" name="fifth" type="text" placeholder="e.g 1:45 - 2:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="sixth">Sixth Lecture</label>  
				  <div class="col-md-8">
				  <input id="sixth" name="sixth" type="text" placeholder="e.g 2:45 - 3:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="seventh">Seventh Lecture</label>  
				  <div class="col-md-8">
				  <input id="seventh" name="seventh" type="text" placeholder="e.g 3:45 - 4:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="eight">Eight Lecture</label>  
				  <div class="col-md-8">
				  <input id="eight" name="eight" type="text" placeholder="e.g 5:45 - 6:45" class="form-control input-md" required="">
					
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="submit"></label>
				  <div class="col-md-4">
					<button id="submit" name="submit" class="btn btn-primary">Add Timimg</button>
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
				
				function deletetiming($id, $user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$link->query("DELETE FROM `timetable`.`timing` WHERE `timing`.`id` = '$id' AND `timing`.`user_id`='$user_id'");
				}
				if(isset($_GET['delete'])){
					 deletetiming($_GET['id'],$_SESSION['user_id']);
					 echo 	'<div class="alert alert-success">  
							<a class="close" data-dismiss="alert">X</a>  
							<strong>Tada Success! </strong>Successfully Deleted.  
							</div>'; 
				}
				
				// This function lists all the timetable created till now.. with options like delete, edit
				function timimg_list($user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$query = $link->query("SELECT * FROM timing WHERE user_id= '$user_id'");
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					
					echo
						  "<h2>Lecture Timing</h2>".          
						  "<table class='table'>".
							"<thead>".
							  "<tr>".
							   "<th>1st</th>".
								"<th>2nd</th>".
								"<th>3rd</th>".
								"<th>4th</th>".
								"<th>5th</th>".
								"<th>6th</th>".
								"<th>7th</th>".
								"<th>8th</th>".
								"<th>Options</th>".
							  "</tr>".
							"</thead>".
							"<tbody>";
							
							while($result = $query->fetch()){
							  echo "<tr>"
									."<td>".$result['first']."</td>"
									 ."<td>".$result['second']."</td>"
									 ."<td>".$result['third']."</td>"
									 ."<td>".$result['fourth']."</td>"
									 ."<td>".$result['fifth']."</td>"
									 ."<td>".$result['sixth']."</td>"
									 ."<td>".$result['seventh']."</td>"
									 ."<td>".$result['eight']."</td>"
									 ."<td><a href='edit.timing.php?delete=true&id=".$result['id']."'>Delete</a></td>"
									 ."</tr>".
							  "</tr>";
							}  
					echo	"</tbody>".
						  "</table>".
						"</div>";
						
				}
				
				timimg_list($_SESSION['user_id']);
			}
			else{
				echo "You are not logged in yet. Please go back and login again";
			}
		?>
		
		</div>
    </div>
  </div>
  
</div>