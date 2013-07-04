<div id="header">
	<div style = "float:left;">
		<img src="res/favicon.png">		
		<font size="16">TRAINERS LEAGUE</font>
	</div>
	<div style = "float:right;">
		<?php
			if(logged_in() == true){
				include 'includes/widgets/loggedin.php';
			}else{
				include 'includes/widgets/login.php';
			}
		?> 
	</div>
</div>