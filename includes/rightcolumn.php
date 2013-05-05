<div id="rightcolumn">
	<?php
		if(logged_in() == true){
			echo 'logged in';
		}else{
			include 'includes/widgets/login.php';
		}
			?> 
</div>