<?php
	// Aufgerufen, wenn ein Spieler im Kampf einen Defacer benutzt
	// Berechnet die neuen Werte des Verteidiger Monsters und updatet die GameTabelle

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';

	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		// Was ist das Target des Defacers? Führe die Wert Berechnungen mit dem Defacer aus
  		if($_GET["target"] == 0){
  			defaceAtt();
  			echo "TARGET=0";
  		} else if($_GET["target"] == 1){
  			defaceDef();
  		} else {
  			// Hier ist ein Fehler passiert
  		}
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	function defaceAtt(){
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
		$defacerId = mysql_query("SELECT defacerId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($defacerId); 
		if($row){
    		$defacerId = $row[0]; // Ergebnis: 1
    		//echo "defacerId: ".$defacerId."   ";
    	}
		// Hole anhand der defacer id den defacer value aus der attacken liste
		$defacerValue = mysql_query("SELECT value FROM defacer WHERE id=$defacerId");
		$row = mysql_fetch_row($defacerValue); 
		if($row){
    		$defacerValue = $row[0]."   "; // Ergebnis: 1
    		//echo "defacerValue: ".$defacerValue."   ";
    	}
		// hp von def monster - beachte, dass dies hier die id des gegners ist
		$defMonAttValue = mysql_query("SELECT monAtt FROM $gameSessionId WHERE playerId=$otherPlayerId");
		$row = mysql_fetch_row($defMonAttValue); 
		if($row){
    		$defMonAttValue = $row[0]."   "; // Ergebnis: 1
    		//echo "defMonAttValue: ".$defMonAttValue."   ";
    	}
		// def von def monster
		$defMonDefValue = mysql_query("SELECT monDef FROM $gameSessionId WHERE playerId=$otherPlayerId");
		$row = mysql_fetch_row($defMonDefValue);
		if($row){
    		$defMonDefValue = $row[0]; 
    		//echo "defMonDefValue: ".$defMonDefValue."   ";
    	}
		
		// --------------------------------------------------------------------------------------

		// Brechne den neuen att Wert
 		$defMonAttValue = $defMonAttValue - ($defacerValue*($attMonAttValue/100)) * ((100-$defMonDefValue)/100);
 		//echo "defMonAttValueNeu: ".$defMonAttValue."   ";
 		// Checken, ob der Wert nicht unter 50 fällt
 		if($defMonAttValue <= 50){
 			$defMonAttValue = 50;
 			echo "<p> Der Att Wert Ihres Gegners darf nicht unter 50 fallen <p>";
 			//echo "defMonAttValue: ".$defMonAttValue;
 		}
 		// Update den datensatz für das def monster 
 		mysql_query("UPDATE $gameSessionId SET monAtt=$defMonAttValue WHERE playerId=$otherPlayerId");
 		// Setze den Runden Index auf 1 für den anderen Spieler
 	 	mysql_query("UPDATE $gameSessionId SET turn=0 WHERE playerId=$session_user_id");
 	 	mysql_query("UPDATE $gameSessionId SET turn=1 WHERE playerId=$otherPlayerId");
	}

	function defaceDef(){
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
		// Hole defacer id aus der session tabelle 
		$defacerId = mysql_query("SELECT defacerId FROM $gameSessionId WHERE playerId=$session_user_id");
		$row = mysql_fetch_row($defacerId); 
		if($row){
    		$defacerId = $row[0]; // Ergebnis: 1
    		//echo "defacerId: ".$defacerId."   ";
    	}
		// Hole anhand der defacer id den defacer value aus der attacken liste
		$defacerValue = mysql_query("SELECT value FROM defacer WHERE id=$defacerId");
		$row = mysql_fetch_row($defacerValue); 
		if($row){
    		$defacerValue = $row[0]; // Ergebnis: 1
    		//echo "defacerValue: ".$defacerValue."   ";
    	}
		// def von def monster
		$defMonDefValue = mysql_query("SELECT monDef FROM $gameSessionId WHERE playerId=$otherPlayerId");
		$row = mysql_fetch_row($defMonDefValue); 
		if($row){
    		$defMonDefValue = $row[0]; // Ergebnis: 1
    		//echo "defMonDefValue: ".$defMonDefValue."   ";
    	}

		// --------------------------------------------------------------------------------------

		// Brechne den neuen def Wert
 	 	$defMonDefValue = $defMonDefValue - ($defacerValue*($attMonAttValue/100)) * ((100-$defMonDefValue)/100);
 	 	//echo "defMonDefValueNeu: ".$defMonDefValue."   ";
 	 	// Checken ob der neue Att Wert nicht unter 50 fällt
 	 	if($defMonDefValue <= 50){
 			$defMonDefValue = 50;
 			echo "<p> Der Att Wert Ihres Gegners darf nicht unter 50 fallen <p>";
 			//echo "defMonDefValue: ".$defMonDefValue;
 		}
 	 	// Update den datensatz für das def monster 
 	 	mysql_query("UPDATE $gameSessionId SET monDef=$defMonDefValue WHERE playerId=$otherPlayerId");
		// Setze den Runden Index auf 1 für den anderen Spieler
 	 	mysql_query("UPDATE $gameSessionId SET turn=0 WHERE playerId=$session_user_id");
 	 	mysql_query("UPDATE $gameSessionId SET turn=1 WHERE playerId=$otherPlayerId");
	}

	connectDB($sql);
?>

