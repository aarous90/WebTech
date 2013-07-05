<?php include 'core/init.php'; 
	  protect_page();
	  include 'includes/overall/header.php';
?>
	<form action="" method="post">
		<table style="margin-left:auto;margin-right:auto;">
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username"></td>	
			</tr>
			<tr> 
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="password" name="password_confirmation"></td>
			</tr>
			<tr> 
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr> 
			</tr>
			<tr>
				<td></td>
				<td><input type="button" value="SAVE" id="button"></td>	
			</tr>
		</table>
	</form>
<?php include 'includes/overall/footer.php';?>
    
