<?php
session_start();
require 'database/db_connect.php';
require 'functions/users.php';
require 'functions/general.php';
require 'classes/core.php';
require 'classes/chat.php';
$errors = array();
if(logged_in() == true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'username','password','email');
}
?>