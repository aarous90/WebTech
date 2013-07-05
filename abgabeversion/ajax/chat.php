<?php
require '../core/init.php';
	if(isset($_POST['method']) == true && empty($_POST['method']) == false){

	$method = trim($_POST['method']);

		if ($method == 'fetch'){

			$messages = fetchMessages();

			if(empty($messages) == true){
				echo 'no messages';
			} else {

				foreach($messages as $message){
					?>
					<div id='message'>
					<a href="#"><?php echo $message['username'];?></a> says:
					<p><?php echo nl2br($message['message']);?></p>
					</div>
					<?php
				}
			}	
		} else if ($method == 'throw' && isset($_POST['method']) == true){
				$message = trim($_POST['message']);
				if (empty($message) == false){
					throwMessage($session_user_id, $message);
				}
		}
	}
?>