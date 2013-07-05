<?php
	
	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';

	function connectDB($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		//gucke, wer dran ist
  		endGame();
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}


	function endGame(){
		$gameSessionId = mysql_query("SELECT gameSessionId FROM tlreg WHERE user_id = $session_user_id");
		$row = mysql_fetch_row($gameSessionId); 
		if($row){
    		$gameSessionId = $row[0]; // Ergebnis: 1
    		//echo "<p>GameSessionId: ".$gameSessionId;
    	}
		// Speichere den anderen Spieler 
		$otherPlayerId = mysql_query("SELECT playerId FROM $gameSessionId WHERE playerId != $session_user_id");
		$row = mysql_fetch_row($otherPlayerId);
		if($row){
    		$otherPlayerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "<p>otherPlayerId: ".$otherPlayerId."   ";
    	}

		echo "<p> Hurra, Sie haben gewonnen <p>";
 	 	// Beende das Spiel hier, schreibe in die Statistik des Spielers
 	 	mysql_query("UPDATE tlreg SET gameSessionId='0' WHERE user_id=$session_user_id");
 	 	mysql_query("UPDATE tlreg SET gameSessionId='0' WHERE user_id=$otherPlayerId");
 	 	// Hier noch Speicherung von Statistiken für die Spieler implementieren
 	 	// Session Tabelle löschen
 	 	mysql_query("DROP TABLE $gameSessionId");
	}




?>