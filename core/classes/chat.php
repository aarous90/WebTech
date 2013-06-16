<?php
class Chat extends Core{
	
	public function fetchMessages(){
		$this->query("SELECT chat.message, tlreg.username, tlreg.user_id FROM chat INNER JOIN tlreg ON chat.user_id = tlreg.user_id ORDER BY chat.timestamp DESC") or die (mysql_error());
		return $this->rows();
	}
	
	public function throwMessage($user_id, $message){
		$this->query("INSERT INTO chat (user_id, message, timestamp) VALUES (" . (int)$user_id . ", '" . $this->db->real_escape_string(htmlentities($message)) . "', UNIX_TIMESTAMP()");
	}
}
?>