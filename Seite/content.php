<!doctype html>
<html>
<?php include 'head.php'; ?>
<body>
	<?php 
		$id="Lobby";
		
		if($id=="register")
		{
			include 'linkeSpalte.php'; 
			include 'register.php'; 
			include 'rechteSpalte.php'; 
		}
		if($id=="kampf")
		{
			include 'kampf.php'; 
			include 'kampfLog.php'; 
			include 'kampfBar.php';
		}
		if($id=="Home")
		{
			include 'homeNews.php';
		}
		if($id=="My Account")
		{
			include 'myAccount.php';
		}
		if($id=="Lobby")
		{
			include 'lobby.php';
		}
		if($id=="Play Now")
		{
			include 'playNow.php';
		}
	?>
	 
	