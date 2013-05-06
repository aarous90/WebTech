<?php
	include 'core/init.php';
	if (empty($_POST) == false) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (empty($username) == true || empty($password) == true){
			$errors[] = 'Enter your user name and password.';
		}else if (user_exists($username) == false){
			$errors[] = 'Entered user name or password is incorrect.';	
		}else if (user_active($username) == false){
			$errors[] = 'You need to activate your account.';	
		}else{
			$login = login($username, $password);
			if($login==false){
				$errors[] = 'Entered user name or password is incorrect.';
			}else{
				$_SESSION['user_id'] = $login;
				header('Location: index.php');
				exit();
			}
		}
	}else{
		$errors[] = 'No data recieved.';
	}
	include 'includes/overall/header.php';
	if(!empty($errors)){
		?>
		<h3>An error has occurred</h3>
		<?php
		echo output_errors($errors);
	}
	include 'includes/overall/footer.php'
	?>