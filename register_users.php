"<?php

mysql_connect("localhost","root","");
mysql_select_db("project_mgt");

if ((isset($_POST['firstname'])) && (isset($_POST['lastname'])) && (isset($_POST['dept'])) && (isset($_POST['matricn'])) && (isset($_POST['email'])) && (isset($_POST['level'])) && (isset($_POST['password'])) && (isset($_POST['cpassword']))){
	if ((!empty($_POST['firstname'])) && (!empty($_POST['lastname'])) && (!empty($_POST['dept'])) && (!empty($_POST['matricn'])) && (!empty($_POST['email'])) && (!empty($_POST['level'])) && (!empty($_POST['password'])) && (!empty($_POST['cpassword']))){
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$dept = $_POST['dept'];
		$matricn = $_POST['matricn'];
		$email = $_POST['email'];
		$level = $_POST['level'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		if ($password != $cpassword){
			echo "Password does not match";
		} else{
			
		
		
		$query = "INSERT INTO `user_reg` (`id`,`fname`, `lname`, `dept`, `matric`, `email`, `level`, `password`) VALUES ('','$firstname','$lastname','$dept','$matricn','$email','$level','$password')";

		//if ($check = mysql_query($query)){
			if (mysql_num_rows($query) == 0){
				echo "Username already exist";
			}else{
				Header("Location:index.php");
			}
		//}else{
		//	echo "Couldn't register! Try again!";
		//}
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
	<form class="jumb" action="register_users.php" method="POST">
	<p style="letter-spacing: 9px;float:right;
	position: absolute;
	top:160px;
	right: 130px;">McPherson Univeristy<p>
		<div id="rform">
		Firstname:<br>
		<input type="text" name="firstname"><br>
		Lastname:<br>
		<input type="text" name="lastname"><br>
		Department:<br>
		<input type="text" name="dept"><br>
		Matriculation number:<br>
		<input type="text" name="matricn"><br>
		E-mail address:<br>
		<input type="email" name="email"><br>
		Level:<br>
		<select name="level">
			<option>400L</option>
		</select><br>
		Password:<br> 
		<input type ="password" name="password"></br></br>
		Confirm Password:<br> 
		<input type ="password" name="cpassword"></br></br>
		<input type="Submit" name="submit" value="Sign up" style="background-color:grey;color:white;border-radius: 5px 5px 5px 5px; padding:10px;">
		<br>
		<br>
		
		</div>	
	</form>
</body>

</html>