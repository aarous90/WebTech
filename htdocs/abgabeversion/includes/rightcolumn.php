<div id="rightcolumn">
	<?php
		if(logged_in() == true){
			$location = $_SERVER['REQUEST_URI'];
			if($location == '/battle.php'){
				include 'includes/widgets/battle_log.php';
			}
		}
		else{
			include 'includes/widgets/reg_description.php';
		}
			?> 
</div>