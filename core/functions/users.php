<?php
function register_user($register_data) {
array_walk($register_data, 'array_sanitize');
$register_data['password'] = md5($register_data['password']);
$fields = implode(', ', array_keys($register_data));
$data = '\'' . implode('\', \'', $register_data) . '\'';
mysql_query("INSERT INTO tlreg($fields) VALUES($data)");
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