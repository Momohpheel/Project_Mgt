<?php
mysql_connect("localhost","root","");
mysql_select_db("project_mgt");
session_start();

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


	



?>


<html lang="en-US">
<head>
	<title>Project Mgt.</title>
	<link rel = "stylesheet" href="/Project_Mgt/bootstrap-4.0.0-dist/css/bootstrap.min.css"/>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<head>
<body>
	<div class="container">
			<div class="col-lg-6">
				<div class="jumbotron">
				<h1>Search for Projects here<span class="glyphicon glyphicon-search"></span>	</h1>
				<input type="text" name="searchinput" placeholder="Place your search input here..." class="form-control"><br>
				<input type="submit" name="search" value="Find Project" class="btn btn-primary" style="float:right;">
				</div>
			</div>
		</div>
<?php
	for ($i = 0; $i < $_SESSION['count']; $i++)
{
	//echo $_SESSION['fields'.$i]['name']."<br/>";
	//echo $_SESSION['fields'.$i]['matric']."<br/>";
	//echo "<br/>";


		echo "<div class='container'>
			<table class='table table-hover'>

				<tr>
					<th>PROJECTS<th>
				</tr>
				<tr>
					<td>".$_SESSION['fields'.$i]['title']."</td>
					<td style='float:right;'><a href=".$_SESSION['fields'.$i]['project']." download>Download</a><br>Written by ".$_SESSION['fields'.$i]['name']."<br>Supervisor: ".$_SESSION['fields'.$i]['superv']."<br>Domain (".$_SESSION['fields'.$i]['domain'].")</td>
				</tr>
			</table>
		</div>";
	}
?>
</body>
</html>