<div id="navigation">
<?php
		if(logged_in() == true){
			include 'includes/widgets/loggedin_navigation.php';
		}else{
			include 'includes/widgets/navigation.php';
		}
			?>  
</div>