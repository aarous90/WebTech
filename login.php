<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST) == false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($username) == true || empty($password) == true){
		$errors["message"] = 'Enter your user name and password.';
	}else if (user_exists($username) == false){
		$errors["message"] = 'Entered user name or password is incorrect.';	
	}else if (user_active($username) == false){
		$errors["message"] = 'You have to activate your account.';	
	}else{
		$login = login($username, $password);
		if($login==false){
			$errors["message"] = 'Entered user name or password is incorrect.';
		}else{
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}
		if(!empty($errors)){
		print_r($errors);
		}
}
include 'includes/overall/footer.php'
?>