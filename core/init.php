<?php
session_start();
require 'database/db_connect.php';
require 'classes/core.php';
require 'functions/users.php';
require 'functions/general.php';
require 'classes/chat.php';
$errors = array();
if(logged_in() == true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'username','password','email');
	$_SESSION['user'] = (isset($_GET['user']) == true) ? (int)$_GET['user'] : 0;
}
?>