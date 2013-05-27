			<?php include 'core/init.php'; 
					protect_page();
				  include 'includes/overall/header.php';
				  if(empty($_POST)==false){
					$required_fields = array('current_password','password','password_confirmation');
					foreach ($_POST as $key => $value) {
						if(empty($value) && in_array($key, $required_fields)==true){
						$errors[] = 'You need to fill out all required fields.';
						break 1;
						}
					}	
						if(md5($_POST['current_password'])==$user_data['password']){
					    	if(trim($_POST['password'])!=trim($_POST['password_confirmation'])){
									$errors[] = 'Your new passwords do not match.';
							}else if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30){
								$errors[] = 'Your password must be between 6 and 30 characters.';
								}
						}else{
						$errors[] = 'Your current password is incorrect.';
						}					
			        }
			     	if(isset($_GET['success']) && empty($_GET['success'])){
						echo 'Your password has been changed!';	
					}
					else{	
						if(empty($errors) == true && empty($_POST) == false){
						change_password($session_user_id,$_POST['password']);
						?>
						<meta http-equiv="refresh" content="0;url=http://siftos.0fees.net/changepassword.php?success">
						<?php
						}else if(!empty($errors)){
							echo output_errors($errors);
						}
			?>
			<h3>Change password</h3><br>
			<form action="" method="post">
				<ul>
					<li>
						Current password*:<br>
						<input type="password" name="current_password">
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
						<br>
						<input type="submit" value="Change password">
					</li>
				</ul>	
			</form>
			<?php 
				}
			include 'includes/overall/footer.php';?>