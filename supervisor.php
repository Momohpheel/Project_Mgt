<?php


?>
<html>
<head>
	<title>Project Mgt.</title>
	<link rel = "stylesheet" href="/Project_Mgt/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet"></link>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="page.php">Project Management System</a>
	    </div>
			<a class="navbar-brand" href="supervisor.php">Supervisor's Unit</a>
    </div>
</nav>

<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4" style="border: 0.5px solid grey; border-radius:9px 9px 9px 9px; padding: 50px; top:90px;">
	<form action="MAILTO:someone@example.com" method="post" enctype="text/plain">
		Name: <input type="text" class="form-control" name="name" placeholder="Name" required><br/>
		Subject: <input type="text" name="Subject" class="form-control" placeholder="Subject" required><br/>
		Mail: <textarea name="mail" class="form-control" placeholder="Mail" required></textarea><br/>
		<input type="submit" class="btn btn-info" value="Send Mail">
	</form>
	</div>
	<div class="col-lg-4"></div>
</div>
</body>
</html>