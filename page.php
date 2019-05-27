<?php
mysql_connect("localhost","root","");
mysql_select_db("project_mgt");
session_start();

$target = "uploads/";
error_reporting(0);
$targetfile = $target.basename($_FILES["project"]["name"]);
$uploadok = 1;
$targetFileType = pathinfo($targetfile, PATHINFO_EXTENSION);
//echo $targetFileType;
if (isset($_POST['add'])){
	if ((isset($_POST['name'])) && (isset($_POST['matric'])) && (isset($_POST['title'])) &&  (isset($_POST['supervisor'])) && (isset($_POST['domain']))){
	if ((!empty($_POST['name'])) && (!empty($_POST['matric'])) && (!empty($_POST['title']))  && (!empty($_POST['supervisor'])) && (!empty($_POST['domain']))){
		
		$name = $_POST['name'];
		$matric = $_POST['matric'];
		$title = $_POST['title'];
		
		$supervisor = $_POST['supervisor'];
		$domain = $_POST['domain'];
			
		
		
		$query = "INSERT INTO `projects` (`id`,`name`, `matric`, `title`,`project`, `superv`, `domain`) VALUES ('','$name','$matric','$title','$targetfile','$supervisor','$domain')";

		mysql_query($query);
	}
}
	
	if (file_exists($targetfile)){
		echo "Sorry, file already exists";
		$uploadok = 0;
	}
	if ($_FILES["project"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadok = 0;
	}
	if($targetFileType != "pdf" && $targetFileType != "docx") {
    echo "Sorry, only PDF, DOCX files are allowed.";
    $uploadok = 0;
	}
	if ($uploadok == 0) {
    	echo "Sorry, your file was not uploaded.";
	}else{
	    if(move_uploaded_file($_FILES["project"]["tmp_name"],$targetfile)){
	        echo "The file ". basename($_FILES["project"]["name"]). " has been uploaded.";
	    }else{
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}

if (isset($_POST['update'])){
	$target = "uploads/";
$targetfile = $target.basename($_FILES["project"]["name"]);
$uploadok = 1;
$targetFileType = pathinfo($targetfile, PATHINFO_EXTENSION);

	if ((isset($_POST['title']))  && (isset($_POST['name'])) &&  (isset($_POST['password']))&&  (isset($_POST['matric']))){
		if ((!empty($_POST['title']))  && (!empty($_POST['name']))  && (!empty($_POST['password']))&& (!empty($_POST['matric']))){
		
		$title = $_POST['title'];
		//$project = $_POST['project'];
		$name = $_POST['name'];
		$password = $_POST['password'];
		$matric = $_POST['matric'];
		
			
		$quer = "SELECT `password` FROM `user_reg` WHERE `matric` = '$matric'";
		if ($one = mysql_query($quer)){
			if ($two = mysql_fetch_assoc($one)){
				$passwordc = $two['password'];
				echo $password;
			}
		}

		if ($password == $passwordc){

		$query = "UPDATE `projects` SET `name` = '$name', `title` = '$title', `project` = '$targetfile' WHERE `matric` = '$matric'";
		mysql_query($query);
	}else{
		echo 'Wrong Password!';
	}	
}
}
if (file_exists($targetfile)){
		echo "Sorry, file already exists";
		$uploadok = 0;
	}
	if ($_FILES["project"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadok = 0;
	}
	if($targetFileType != "pdf" && $targetFileType != "docx") {
    echo "Sorry, only PDF, DOCX files are allowed.";
    $uploadok = 0;
	}
	if ($uploadok == 0) {
    	echo "Sorry, your file was not uploaded.";
	}else{
	    if(move_uploaded_file($_FILES["project"]["tmp_name"],$targetfile)){
	        echo "The file ". basename($_FILES["project"]["name"]). " has been uploaded.";
	    }else{
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
}

if (isset($_POST['search'])){
	if ((isset($_POST['searchinput'])) && (!empty($_POST['searchinput']))){
	
	$search = $_POST['searchinput'];
	$query = "SELECT * FROM `projects` WHERE `title` LIKE '%$search%'";
	if ($jab = mysql_query($query)){
		
		
			$count = mysql_num_rows($jab);
			$_SESSION['count'] = $count;
		for ($i=0; $i< $count;$i++){
			if ($output = mysql_fetch_assoc($jab)){
			$title = $output['title'];
			$name = $output['name'];
			$domain = $output['domain'];
			$project = $output['project'];

			//echo $title."<br>";
			$_SESSION['fields'.$i] = $output;
			//echo var_dump($_SESSION['fields'.$i]);
			Header("Location:project.php");
		}
		// $_SESSION['fields'] = $title;
		// echo $_SESSION['fields'];
		
	}
		// $_SESSION['count'] = $count ;
		// echo var_dump($output);//arrray containing fields
		
		//end session
		// session_stop();
	}
}
}




?>
<html>
<head>
	<title>Project Mgt.</title>
	<link rel = "stylesheet" href="/Project_Mgt/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet"></link>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top"  >
	<div class="container-fluid" >
	    <div class="navbar-header">
	      <a class="navbar-brand" href="page.php" >Project Management System</a>
	    </div>
			<a class="navbar-brand" href="supervisor.php">Supervisor's Unit</a>
    </div>
</nav>

	<div class="container" >
	<div class="row">
		<div class="col-lg-6">
			<div class="jumbotron">
			<h1>Search for Projects here<span class="glyphicon glyphicon-search"></span>	</h1>
			<form method="post" action="page.php">
			<input type="text" name="searchinput" placeholder="Place your search input here..." class="form-control"><br>
			<input type="submit" name="search" value="Find Project" class="btn btn-primary" style="float:right;">
			</form>
			</div>
		</div>
		
		<div class="col-lg-6">
		<div class="clear">
			<div class="jumbotron">
			<form method="post" action="page.php" enctype="multipart/form-data">
			<h1>Update Project here<span class="glyphicon glyphicon-search"></span>	</h1>
			Title of Project: <input type="text" name="title" placeholder="Place your search input here..." class="form-control"><br>
			Project: <input type="file" name="project" class="form-control"><br>
			Name: <input type="text" name="name" class="form-control"><br>
			Password: <input type="text" name="password"  class="form-control"><br>
			Matriculation No.: <input type="text" name="matric"  class="form-control"><br>
			<input type="submit" name = "update" value="Update Project" class="btn btn-primary" style="float:right;">
			<small style="color:red;">Hello there! You can only update <strong>YOUR</strong> project!</small>
			</form>
			</div>
		</div>
		</div>
	</div>
	</div>
	<div class="clear">
	<div class="container">
		<div class="jumbotron">
		<h1>Add Projects here</h1>
		<form method="post" action="page.php" enctype="multipart/form-data">
		Name: <input type="text" name="name"  class="form-control"><br>
		Matric. No.: <input type="text" name="matric"  class="form-control"><br>
		Title of Project: <input type="text" name="title" class="form-control"><br>
		Project: <input type="file" name="project" class="form-control"><br>
		Name of Supervisor: <input type="text" name="supervisor"  class="form-control"><br>
		Project Domain: <select class="form-control" name="domain">
							<option>Networking</option>
							<option>Machine Learning</option>
							<option>Web Development</option>
							<option>Software Development</option>
							<option>Expert Systems</option>
							<option>Artificial Intelligence</option>
						</select><br>
		 <input type="submit" value="Add Project" name="add" class="btn btn-primary" style="float:right;">
		</form>
		</div>
	</div>
	</div>

</body>
</html>