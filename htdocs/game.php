<?php include 'core/init.php'; 
	  protect_page();
	  include 'includes/overall/header.php';
?>


	<script language="javascript" type="text/javascript" src="gameFunction/script.js"></script>
	<script language="javascript" type="text/javascript" src="gameFunction/checkWhoseTurn.js"></script>

	<h1>Spiel Test</h1>
		
		<button id="attBtn" onclick="attackBtn()">Attack</button><br>
		<button id="defAttBtn" onclick="defAttBtn()">DefaceAtt</button><br>
		<button id="defDefBtn" onclick="defDefBtn()">DefaceDef</button><br>
		<button id="enhAttBtn" onclick="enhAttBtn()">EnhanceAtt</button><br>
		<button id="enhDefBtn" onclick="enhDefBtn()">EnhanceDef</button><br>
		<button id="readyBtn" onclick="registerReady()">I'm Ready</button><br>
		<button id="turnBtn" onclick="checkWhoseTurn()">Wer ist dran?</button><br>

		<div id="status">
			Status
		</div>



<?php include 'includes/overall/footer.php';?>
    




    
