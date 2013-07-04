<div id="leftcolumn">
	<?php
		if(logged_in() == true){
			$location = $_SERVER['REQUEST_URI'];
			if($location == '/battle.php'){
				include 'includes/widgets/battle_buttons.php';
			}
		}else{
			include 'includes/widgets/tl_description.php';
		}
			?> 
</div>