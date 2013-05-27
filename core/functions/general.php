<?php
function email($to,$subject,$message){
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Trainers League <noreply@trainersleague.net>' . "\r\n";
mail($to, $subject, $message, $headers);
}
function logged_in_redirect(){
	if(logged_in()==true){
		header('Location:index.php');
		exit();
	}  
}
function protect_page(){
	if(logged_in()==false){
		header('Location:protected.php');
		exit();
	}                               
}
function sanitize($data){
	return mysql_real_escape_string($data);
}
function array_sanitize(&$item){
	return mysql_real_escape_string($item);
}
function output_errors($errors){
	$output = array();
	foreach ($errors as $error) {
		$output[] = '<li>'. $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul><br>';
}
?>