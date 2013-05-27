<?php 
	include 'core/init.php';
	logged_in_redirect();
	include 'includes/overall/header.php';
	if(empty($_POST) == false){
		$required_fields = array('username','password','password_confirmation','email');
		foreach ($_POST as $key => $value) {
			if(empty($value) && in_array($key, $required_fields) == true){
			$errors[] = 'You need to fill out all required fields.';
			break 1;
		}
	}
		if(empty($errors) == true){
			if(user_exists($_POST['username']) == true){
				$errors[] = 'The username \'' . $_POST['username'] . '\' is already taken.';
			}
			if(preg_match("/\\s/", $_POST['username']) == true){
				$errors[] = 'Your passwords must not contain any spaces.';
			}
			if(strlen($_POST['username']) < 6 || strlen($_POST['username']) > 30){
				$errors[] = 'Your username must be between 6 and 30 characters.';
			}
			if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30){
				$errors[] = 'Your password must be between 6 and 30 characters.';
			}
			if($_POST['password'] != $_POST['password_confirmation']){
				$errors[] = 'Your passwords dont match.';
			}
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$errors[] = 'A valid email address is required.';
			}
			if(email_exists($_POST['email']) == true){
				$errors[] = 'The email address \'' . $_POST['email'] . '\' is already in use.';
			}
		}
	}
?>
<?php
	if(isset($_GET['success']) && empty($_GET['success'])){
		?>
		<h3>You have been registered successfully!</h3>
		<p>Please check your email and spam folder to activate your account.</p>
		<?php	
	}
	else{
		if(empty($errors) == true && empty($_POST) == false){
			$register_data = array(
			'username'=> $_POST['username'],
			'password'=> $_POST['password'],
			'email'=> $_POST['email'],
			'email_code'=> md5($_POST['username']+date(DATE_RFC822))
			);
	register_user($register_data);?>
	<meta http-equiv="refresh" content="0;url=http://siftos.0fees.net/register.php?success">
	<?php
	exit();
	}else if(empty($errors) == false){
		echo output_errors($errors);
	}
?>
<h3>Register</h3><br>
<form action="" method="post">
	<ul>
		<li>
			Username*:<br>
			<input type="text" name="username">
		</li>
		<li>
			Password*:<br>
			<input type="password" name="password">
		</li>
		<li>
			Confirm Password*:<br>
			<input type="password" name="password_confirmation">
		</li>
		<li>
			Email*:<br>
			<input type="text" name="email">
		</li>
		<li>
			<br>
			<input type="submit" value="Register">
		</li>
	</ul>	
</form>
<?php 
}
include 'includes/overall/footer.php';?>

