<?php
	// Wird aufgerufen, wenn der Spieler sagt er ist bereit für ein Spiel
	// Setzt ihn auf eine Warteliste, wenn das schon einer ist, startet er eine GameTabelle und löscht die Spieler von der Warteliste

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';
	include 'C:/xampp/htdocs/gameFunction/checkPlayerAndCreateGame.php';

	// Stellt Verbuindung mit der DB her und initialisiert die restlichen funktionen
	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		//gucke, wer dran ist
  		checkForOtherPlayer($con);
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}
	
	connectDB($sql);


?>