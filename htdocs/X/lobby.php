<?php include 'core/init.php'; 
	  protect_page();
	  include 'includes/overall/header.php';
	  $chat = new Chat();
?>
<div id="chat">
	<div id="messages"></div>
	<textarea id="entry" placeholder="send message!"></textarea>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="js/chat.js"></script>
<?php include 'includes/overall/footer.php';?>
    
