<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
	if(isset($_GET['success']) == true && empty($_GET['success']) == true){
		?>
		<h3>Your account has been activated!</h3>
		<p>You can now log in.</p>
		<?php
	}
	else if(isset($_GET['email'], $_GET['email_code']) == true){
		
		$email = trim($_GET['email']);
		$email_code = trim($_GET['email_code']);

		if(email_exists($email) == false){
			$errors[] = 'We could not find that email address.';
		}
		else if(activate($email,$email_code) == false){
			$errors[] = 'We had problems activating your account.';
		}
		if(empty($errors) == false){
		?>
		<h3>An error has occurred</h3>
		<?php
		echo output_errors($errors);
		}
		else{
			header('Location: activate.php?success');
			exit();
		}
	}
	else{
 		header('Location: index.php');
	}
include 'includes/overall/footer.php';
?>