<!doctype html>
<html>
<?php include 'head.php'; ?>
<body>
	<?php 
		$username= "username";
		$password= "password";
	
		if($username=="username")
		{
			if($password=="password")
			{
				include 'headerAusloggen.php';
				include 'actionBar.php';
			}
		}
		else
		{
			include 'headerEinloggen.php';
		}
	?>
	