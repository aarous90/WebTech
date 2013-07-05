<?php
	// Aufgerufen, wenn ein Spieler im Kampf eine Attacke benutzt
	// Berechnet die neue HP des Verteidiger Monsters und updatet die GameTabelle

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';
	
	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		// Führe die HP Berechnungen mit der Attacke aus
  		attack($con);
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	function attack($con){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
		global $session_user_id;
		//echo "<p>Attacke initialisiert";
		// Speichere die GameSessionId, um den anderen Spieler zu bekommen
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
		// id von att monster
		$attMonId = mysql_query("SELECT monsterId FROM $gameSessionId WHERE playerId = $session_user_id");
		$row = mysql_fetch_row($attMonId);
		if($row){
    		$attMonId = $row[0]; 
    		//echo "attmonId: ".$attMonId."   ";
    	}
		// att wert vom attacker monster 
		$attMonAttValue = mysql_query("SELECT monAtt FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($attMonAttValue);
		if($row){
    		$attMonAttValue = $row[0]; 
    		//echo "attMonAttValue: ".$attMonAttValue."   ";
    	}
		// Hole Attacken id aus der session tabelle 
		$attackId = mysql_query("SELECT attackId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($attackId);
		if($row){
    		$attackId = $row[0]; 
    		//echo "attackId: ".$attackId."   ";
    	}
		// Hole anhand der attacken id den attacken value aus der attacken liste
		$attackValue = mysql_query("SELECT value FROM attack WHERE id=$attackId");
		$row = mysql_fetch_row($attackValue);
		if($row){
    		$attackValue = $row[0]; 
    		//echo "attackValue: ".$attackValue."   ";
    	}
		// hp von def monster - beachte, dass dies hier die id des gegners ist
		$defMonHp = mysql_query("SELECT monHp FROM $gameSessionId WHERE playerId=$otherPlayerId");
		$row = mysql_fetch_row($defMonHp);
		if($row){
    		$defMonHp = $row[0]; 
    		//echo "defMonHp: ".$defMonHp."   ";
    	}
		// def von def monster
		$defMonDefValue = mysql_query("SELECT monDef FROM $gameSessionId WHERE playerId=$otherPlayerId");
		$row = mysql_fetch_row($defMonDefValue);
		if($row){
    		$defMonDefValue = $row[0]; 
    		//echo "defMonDefValue: ".$defMonDefValue."   ";
    	}
		
		// -------------------------------------------------------------------------------------------------------------------------------------------------------

		// Brechne den neuen hp Wert
 	 	$defMonHp = $defMonHp - ($attackValue*($attMonAttValue/100)) * ((100-$defMonDefValue)/100);
 	 	//echo "defMonHpNeu: ".$defMonHp."   ";
 	 	// Checken, ob der Spieler gewonnen hat
 	 	if($defMonHp <= 0){
 	 		echo "<p> Hurra, Sie haben gewonnen <p>";
 	 		// Beende das Spiel hier, schreibe in die Statistik des Spielers
 	 		mysql_query("UPDATE tlreg SET gameSessionId='0' WHERE user_id=$session_user_id");
 	 		mysql_query("UPDATE tlreg SET gameSessionId='0' WHERE user_id=$otherPlayerId");
 	 		// Hier noch Speicherung von Statistiken für die Spieler implementieren
 	 		// Session Tabelle löschen
 	 		mysql_query("DROP TABLE $gameSessionId");
 	 	} else {
 	 		// Setze den Runden Index auf 1 für den anderen Spieler
 	 		mysql_query("UPDATE $gameSessionId SET turn=0 WHERE playerId=$session_user_id");
 	 		mysql_query("UPDATE $gameSessionId SET turn=1 WHERE playerId=$otherPlayerId");
 	 	}
 	 	// Update den datensatz für das def monster 
 	 	mysql_query("UPDATE $gameSessionId SET monHp=$defMonHp WHERE playerId=$otherPlayerId");
	}

	connectDB($sql);
?>


