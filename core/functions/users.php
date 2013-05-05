<?php
function user_exists($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM `tlreg` WHERE `username` = '$username'") or die (mysql_error());
	if (mysql_num_rows($sql) > 0) {
		return true;
	}else{
		return false;
	}
}
function user_active($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM `tlreg` WHERE `username` = '$username' AND `active` = 1") or die (mysql_error());
	if (mysql_num_rows($sql) > 0) {
		return true;
	}else{
		return false;
	}	
}
function get_user_id($username) {
	$username = sanitize($username);
	$sql = mysql_query("SELECT *FROM `tlreg` WHERE `username` = '$username'") or die (mysql_error());
		if (mysql_num_rows($sql) > 0) {
			$sql = mysql_fetch_array($sql);
			return $sql['user_id'];
		}
}
function login($username, $password) {
	$user_id = get_user_id($username);
	$username = sanitize($username);
	$password = md5($password);
	$sql = mysql_query("SELECT *FROM `tlreg` WHERE `username` = '$username' AND `password` = '$password'") or die (mysql_error());
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
?>