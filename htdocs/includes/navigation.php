<?php
	if(logged_in() == true){
		?>
		<div id="navigation">
			<table>
				<tr>
					<td>
						<div  id="navigationitem" style = "float:left;">
							<input id="navigationitem" type="button" value="Home" onclick=location.href='home.php'>	
						</div>
					</td>
					<td>
						<div  id="navigationitem" style = "float:left;">
							<input id="navigationitem" type="button" value="Lobby" onclick=location.href='lobby.php'>	
						</div>
					</td>	
					<td>
						<div  id="navigationitem" style = "float:left;">
							<input id="navigationitem" type="button" value="Play Now" onclick=location.href='game.php'>	
						</div>
					</td>
					<td>
						<div  id="navigationitem" style = "float:left;">
							<input id="navigationitem" type="button" value="My Account" onclick=location.href='account.php'>	
						</div>
					</td>	
				</tr>
		    </table>
		</div>
		<?php
	}
?> 
