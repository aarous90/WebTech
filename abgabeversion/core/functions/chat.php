<?php
function fetchMessages(){
	$sql ="SELECT chat.message, tlreg.username, tlreg.user_id FROM chat INNER JOIN tlreg ON chat.user_id = tlreg.user_id ORDER BY chat.timestamp ASC";
	$result = mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_array($result)) {
       $return[] = $row;
    }
    if(!empty($return)){
    return $return;
	}
}

function throwMessage($user_id, $message){
	$sql ="INSERT INTO chat (user_id, message, timestamp) VALUES (" . (int)$user_id . ", '" . sanitize((htmlentities($message, ENT_QUOTES, "UTF-8"))) . "', UNIX_TIMESTAMP())";
	mysql_query($sql) or die(mysql_error());
}
?>