<div id="navigation">
<?php
		if(logged_in() == true){
			include 'includes/widgets/loggednavi.php';
		}else{
			include 'includes/widgets/navigation.php';
		}
			?> 		 
</div>