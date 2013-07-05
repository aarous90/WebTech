<?php
	// Aufgerufen, wenn ein Spieler im Kampf einen Enhancer benutzt
	// Berechnet die neuen Werte des Angreifer Monsters und updatet die GameTabelle

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';

	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		// Was ist das Target des Defacers? Führe die Wert Berechnungen mit dem Enhancer aus
  		if($_GET["target"] == 0){
  			enhanceAtt();
  			echo "TARGET=0";
  		} else if($_GET["target"] == 1){
  			enhanceDef();
  			echo "TARGET=1";
  		} else {
  			// Hier ist ein Fehler passiert
  		}
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	function enhanceAtt(){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
		global $session_user_id;

		// Speichere die GameSessionId, um den anderen Spieler zu bekommen
		$gameSessionId = mysql_query("SELECT gameSessionId FROM tlreg WHERE user_id=$session_user_id");
		$row = mysql_fetch_row($gameSessionId); 
		if($row){
    		$gameSessionId = $row[0]; // Ergebnis: 1
    		//echo "GameSessionId: ".$gameSessionId."   ";
    	}
		// Speichere den anderen Spieler 
		$otherPlayerId = mysql_query("SELECT playerId FROM $gameSessionId WHERE playerId != $session_user_id");
		$row = mysql_fetch_row($otherPlayerId);
		if($row){
    		$otherPlayerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "otherPlayerId: ".$otherPlayerId."   ";
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
		// Hole defacer id aus der session tabelle 
		$enhancerId = mysql_query("SELECT enhancerId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($enhancerId);
		if($row){
    		$enhancerId = $row[0]; 
    		//echo "enhancerId: ".$enhancerId."   ";
    	}
		// Hole anhand der defacer id den defacer value aus der attacken liste
		$enhancerValue = mysql_query("SELECT value FROM enhancer WHERE id=$enhancerId");
		$row = mysql_fetch_row($enhancerValue);
		if($row){
    		$enhancerValue = $row[0]; 
    		//echo "enhancerValue: ".$enhancerValue."   ";
    	}
		
		// --------------------------------------------------------------------------------------

		// Brechne den neuen att Wert
 		$attMonAttValue = $attMonAttValue + ($enhancerValue*($attMonAttValue/100));
 		//echo "attMonAttValueNeu: ".$attMonAttValue."   ";
 		// Checken ob der neue Att Wert nicht über 100 steigt
 	 	if($attMonAttValue >= 100){
 			$attMonAttValue = 100;
 			echo "<p> Ihr Att Wert darf nicht über 100 steigen <p>";
 			//echo "<attMonAttValue. ".$attMonAttValue;
 		}
 		// Update den datensatz für das def monster 
 		mysql_query("UPDATE $gameSessionId SET monAtt=$attMonAttValue WHERE playerId=$session_user_id");
 		// Setze den Runden Index auf 1 für den anderen Spieler
 	 	mysql_query("UPDATE $gameSessionId SET turn=0 WHERE playerId=$session_user_id");
 	 	mysql_query("UPDATE $gameSessionId SET turn=1 WHERE playerId=$otherPlayerId");
	}

	function enhanceDef(){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
		global $session_user_id;

		// Speichere die GameSessionId, um den anderen Spieler zu bekommen
		$gameSessionId = mysql_query("SELECT gameSessionId FROM tlreg WHERE user_id=$session_user_id");
		$row = mysql_fetch_row($gameSessionId); 
		if($row){
    		$gameSessionId = $row[0]; // Ergebnis: 1
    		//echo "GameSessionId: ".$gameSessionId."   ";
    	}
		// Speichere den anderen Spieler 
		$otherPlayerId = mysql_query("SELECT playerId FROM $gameSessionId WHERE playerId != $session_user_id");
		$row = mysql_fetch_row($otherPlayerId); 
		if($row){
    		$otherPlayerId = $row[0]; // Ergebnis: 1
    		//echo "otherPlayerId: ".$otherPlayerId."   ";
    	}
		// id von att monster
		$attMonId = mysql_query("SELECT monsterId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($attMonId); 
		if($row){
    		$attMonId = $row[0]; // Ergebnis: 1
    		//echo "attMonId: ".$attMonId."   ";
    	}
		// att wert vom attacker monster 
		$attMonAttValue = mysql_query("SELECT monAtt FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($attMonAttValue); 
		if($row){
    		$attMonAttValue = $row[0]; // Ergebnis: 1
    		//echo "attMonAttValue: ".$attMonAttValue."   ";
    	}
		// def wert vom attacker monster 
		$attMonDefValue = mysql_query("SELECT monDef FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($attMonDefValue); 
		if($row){
    		$attMonDefValue = $row[0]; // Ergebnis: 1
    		//echo "attMonDefValue: ".$attMonDefValue."   ";
    	}
		// Hole defacer id aus der session tabelle 
		$enhancerId = mysql_query("SELECT enhancerId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($enhancerId); 
		if($row){
    		$enhancerId = $row[0]; // Ergebnis: 1
    		//echo "enhancerId: ".$enhancerId."   ";
    	}
		// Hole anhand der enhancer id den enhancer value aus der attacken liste
		$enhancerValue = mysql_query("SELECT value FROM enhancer WHERE id=$enhancerId");
		$row = mysql_fetch_row($enhancerValue); 
		if($row){
    		$enhancerValue = $row[0]; // Ergebnis: 1
    		//echo "enhancerValue: ".$enhancerValue."   ";
    	}
		
		// --------------------------------------------------------------------------------------

		// Brechne den neuen def Wert
 		$attMonDefValue = $attMonDefValue + ($enhancerValue*($attMonAttValue/100));
 		//echo "attMonDefValueNeu: ".$attMonDefValue."   ";
 		// Checken ob der neue Att Wert nicht über 100 steigt
 	 	if($attMonDefValue >= 100){
 			$attMonDefValue = 100;
 			echo "<p> Ihr Def Wert darf nicht über 100 steigen <p>";
 			//echo "<attMonDefValue. ".$attMonDefValue;
 		}
 		// Update den datensatz für das def monster 
 		mysql_query("UPDATE $gameSessionId SET monDef=$attMonDefValue WHERE playerId=$session_user_id");
 		// Setze den Runden Index auf 1 für den anderen Spieler
 	 	mysql_query("UPDATE $gameSessionId SET turn=0 WHERE playerId=$session_user_id");
 	 	mysql_query("UPDATE $gameSessionId SET turn=1 WHERE playerId=$otherPlayerId");
	}

	connectDB($sql);
?>

