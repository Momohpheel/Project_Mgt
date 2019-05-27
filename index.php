<?php
//database connection

mysql_connect("localhost","root","");
mysql_select_db("student_portal");

if ((isset($_POST['matricn'])) && (isset($_POST['password']))){
	if ((!empty($_POST['matricn'])) && (!empty($_POST['password']))){
		
		$matricn = $_POST['matricn'];
		$password = $_POST['password'];
		

		$query = "SELECT `id`,`matric.no`,`password`,`last_name`,`first_name` FROM `user_regs` WHERE `matric.no` = '$matricn' ";

		$query_run = mysql_query($query);
		if ($query_run){
			if ($get = mysql_fetch_assoc($query_run)){
				//get the data from the database
				$matricno = $get['matric.no'];
				$pass = $get['password'];
					$firstname = $get['first_name'];
				$last_name = $get['last_name'];
				//Checks if password is correct
				if ($password != $pass){
					echo 'Incorrect Matriculation No. or Password';
				}
				else{
					Header("Location:page.php");

				}
			}else{
				echo 'Incorrect Matriculation No. or Password';
			}

		}


}
	}
?>
<html lang="en-us">
<head>
	<title>Project Mgt.</title>
</head>
<link href="index.css" rel="stylesheet">
<body>
	<div id="color"><img src="images.png" style="position:absolute; top:260px;left:220px "/></div>
	<form class="jumb" action="index.php" method="POST">
	<p style="letter-spacing: 9px;float:right;
	position: absolute;
	top:200px;
	right: 130px;">McPherson Univeristy<p>
		<div id="form">
		
		Matric. No.:<br>
		<input type="text" name="matricn"><br>
		Password:<br> 
		<input type ="password" name="password"></br></br>
		<input type="Submit" name="submit" value = "Log in" style="background-color:grey;color:white;border-radius: 5px 5px 5px 5px; padding:10px;">
		<br>
		<br>
		<div id="links">
		<a href="#">Forgot your password?</a>
		<a href="register_users.php">You dont have an account yet?</a>
		<a href="administrator.php">Admin log-in</a>
		</div>
		</div>	
	</form>
</body>

</html>