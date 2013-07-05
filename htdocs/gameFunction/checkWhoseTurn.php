<?php
	// Wird aufgerufen, wenn der Spieler sagt er ist bereit für ein Spiel
	// Setzt ihn auf eine Warteliste, wenn das schon einer ist, startet er eine GameTabelle und löscht die Spieler von der Warteliste

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';

	// Stellt Verbuindung mit der DB her und initialisiert die restlichen funktionen
	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		//gucke, wer dran ist
  		checkWhoseTurn();
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	// Liest den Runden Index aus und gibt ihn an die js File zurück
	function checkWhoseTurn(){
		global $session_user_id;
		// Speichere die GameSessionId, um den anderen Spieler zu bekommen
		$gameSessionId = mysql_query("SELECT gameSessionId FROM tlreg WHERE user_id = $session_user_id");
		$row = mysql_fetch_row($gameSessionId); 
		if($row){
    		$gameSessionId = $row[0]; // Ergebnis: 1
    	}
    	// Lese die Turn Va´riable aus, wenn sie = 1 ist, ist man selber dran
		$turn = mysql_query("SELECT turn FROM $gameSessionId WHERE playerId = $session_user_id");
		$row = mysql_fetch_row($turn);
		if($row){
    		$turn = $row[0]; 
    		echo $turn;
    	}
	}

	connectDB($sql);
	
?>