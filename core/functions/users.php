<?php
function activate($email,$email_code){
$email = mysql_real_escape_string($email);
$email_code = mysql_real_escape_string($email_code);
$sql = mysql_query("SELECT *FROM tlreg WHERE email = '$email' AND email_code = '$email_code' AND active = 0");
if (mysql_num_rows($sql) > 0) {
	mysql_query("UPDATE tlreg SET active = 1 WHERE email = '$email'");
	return true;
	}else{
		return false;
	}	
}
function change_password($user_id, $password){
$user_id = (int)$user_id;
$password = md5($password);
mysql_query("UPDATE tlreg SET password ='$password' WHERE user_id = '$user_id'");
}
function register_user($register_data) {
array_walk($register_data, 'array_sanitize');
$register_data['password'] = md5($register_data['password']);
$fields = implode(', ', array_keys($register_data));
$data = '\'' . implode('\', \'', $register_data) . '\'';
mysql_query("INSERT INTO tlreg($fields) VALUES($data)");
$to = $register_data['email'];
$subject = 'Activate your account.';
$message = '<html><body>';
$message .= '<p>Hello, '.$register_data['username'].'</p>';
$message .=	'<p>Thank you for joining the Trainers League! Activate your account now to play for free.</p>';
$message .=	'<p>Click the link below to activate your account:</p>';
$message .=	'<p><a href="http://siftos.0fees.net/activate.php?email='.$register_data['email'].'&email_code='.$register_data['email_code'].'">http://siftos.0fees.net/activate.php?email='.$register_data['email'].'&email_code='.$register_data['email_code'].'</a></p>';
$message .=	'<p>We will see you in-game!</p>';
$message .=	'<p>The Trainers League Team</p>';
$message .=	'<br><br><br><br><hr>';
$message .= '</body></html>';
email($to,$subject,$message);
}
function user_exists($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM tlreg WHERE username = '$username'") or die (mysql_error());
	if (mysql_num_rows($sql) > 0) {
		return true;
	}else{
		return false;
	}
}
function email_exists($email) {
	$email = sanitize($email);
	$sql = mysql_query("SELECT *FROM tlreg WHERE email = '$email'") or die (mysql_error());
	if (mysql_num_rows($sql) > 0) {
		return true;
	}else{
		return false;
	}
}
function user_active($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM tlreg WHERE username = '$username' AND active = 1") or die (mysql_error());
	if (mysql_num_rows($sql) > 0) {
		return true;
	}else{
		return false;
	}	
}
function get_user_id($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM tlreg WHERE username = '$username'") or die (mysql_error());
		if (mysql_num_rows($sql) > 0) {
			$sql = mysql_fetch_array($sql);
			return $sql['user_id'];
		}
}
function login($username, $password) {
	$user_id = get_user_id($username);
	$username = sanitize($username);
	$password = md5($password);
	$sql = mysql_query("SELECT *FROM tlreg WHERE username = '$username' AND password = '$password'") or die (mysql_error());
		if (mysql_num_rows($sql) > 0) {
			$sql = mysql_fetch_array($sql);
			return $sql['user_id'];
		}else{
			return false;
		}
	}
function logged_in() {
	if(isset($_SESSION['user_id'])){
		return true;
	}else{
	   	return false;
	}   
	}
function user_data($user_id) {
	$data = array();
	$user_id = (int) $user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '' . implode(', ', $func_get_args) . '';
		$sql = mysql_query("SELECT $fields FROM tlreg WHERE user_id = '$user_id'") or die (mysql_error());	 
		$data = mysql_fetch_assoc($sql);
		return $data;	
	}
}
?>