<?php
	// aaa
	function checkForOtherPlayers($con){
		// Speichert alle Player Einträge aus der Wartelistentabelle in der Variable
		$playerEntries =  mysql_query("SELECT playerId FROM onwaitlist");
		// Zählt die Anzahl der Player Einträge
		$playerNumber = mysql_num_rows($playerEntries);
		// Wenn zwei oder mehr Spieler drin sind, starte das Spiel
		if($playerNumber >= 2){
			//Hole einen den ersten Eintrag aus der Tabelle (der ander Spieler)
			$otherPlayerId = mysql_query("SELECT playerId FROM onwaitlist LIMIT 1 ");
			$row = mysql_fetch_row($otherPlayerId); 
			if($row){
    			$otherPlayerId = $row[0]."   ";
    		} else {
    			// Starte eine Intervall. So fragt er regelmäßig, ob ein neuer
    			// SPieler dazu gekommen ist, damit das SPiel beginnen kann
    		}
			// Wenn anderen Spieler in Liste, erstelle neue Spieltabelle
			createGameSession($con, $otherPlayerId);
		}
	}

	// aaa
	function createGameSession($con, $otherPlayerId){
		// Create random number
		global $random;
		$random = rand(1000, 9999);
		$newSession = "session".$random;
		//mysqli_query($con, "CREATE TABLE IF NOT EXISTS 'session'.$random(playerId INT(3)");
		//mysql_query("CREATE TABLE IF NOT EXISTS $newSession(playerId INT)");
		
		// Try to create new table
		if (mysql_query("CREATE TABLE IF NOT EXISTS $newSession(playerId INT(3), monsterId INT(30), monHp INT, monAtt INT(3), monDef INT(3), attackId INT(3), defacerId INT(3), enhancerId INT(3), turn INT)")){
			// If table does not exists, ok
		} else {
			// If tavle exists, try again
			echo "Error creating table: " . mysqli_error($con);
		}

		insertPlayerDataInGameSession($con, $otherPlayerId, $newSession);
	}

	// Liest die werte der Monster der Spieler aus der DB und schreibt sie in die GameSessionTable
	function insertPlayerDataInGameSession($con, $otherPlayerId, $newSession){
		//echo " Ich hole jetzt Daten von Player1 ";
		global $session_user_id;

		// Daten von Player One
		$pOneMonsterId = mysql_query("SELECT monsterId FROM tlreg WHERE user_id=$session_user_id");
		$row = mysql_fetch_row($pOneMonsterId);
		if($row){
    		$pOneMonsterId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneMonsterId: ".$pOneMonsterId."   ";
    	}
		$pOneAtt = mysql_query("SELECT att FROM monster WHERE id=$pOneMonsterId");
		$row = mysql_fetch_row($pOneAtt);
		if($row){
    		$pOneAtt = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneAtt: ".$pOneAtt."   ";
    	}
		$pOneDef = mysql_query("SELECT def FROM monster WHERE id=$pOneMonsterId");
		$row = mysql_fetch_row($pOneDef);
		if($row){
    		$pOneDef = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneDef: ".$pOneDef."   ";
    	}
		$pOneAttackId = mysql_query("SELECT attack FROM monster WHERE id=$pOneMonsterId");
		$row = mysql_fetch_row($pOneAttackId);
		if($row){
    		$pOneAttackId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneAttackId: ".$pOneAttackId."   ";
    	}
		$pOneDefacerId = mysql_query("SELECT defacer FROM monster WHERE id=$pOneMonsterId");
		$row = mysql_fetch_row($pOneDefacerId);
		if($row){
    		$pOneDefacerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneDefacerId: ".$pOneDefacerId."   ";
    	}
		$pOneEnhancerId = mysql_query("SELECT enhancer FROM monster WHERE id=$pOneMonsterId");
		$row = mysql_fetch_row($pOneEnhancerId);
		if($row){
    		$pOneEnhancerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pOneEnhancerId: ".$pOneEnhancerId."   ";
    	}
		
		//Daten von Player Two
		$pTwoMonsterId = mysql_query("SELECT monsterId FROM tlreg WHERE user_id=$otherPlayerId");
		$row = mysql_fetch_row($pTwoMonsterId);
		if($row){
    		$pTwoMonsterId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoMonsterId: ".$pTwoMonsterId."   ";
    	}
		$pTwoAtt = mysql_query("SELECT att FROM monster WHERE id=$pTwoMonsterId");
		$row = mysql_fetch_row($pTwoAtt);
		if($row){
    		$pTwoAtt = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoAtt: ".$pTwoAtt."   ";
    	}
		$pTwoDef = mysql_query("SELECT def FROM monster WHERE id=$pTwoMonsterId");
		$row = mysql_fetch_row($pTwoDef);
		if($row){
    		$pTwoDef = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoDef: ".$pTwoDef."   ";
    	}
		$pTwoAttackId = mysql_query("SELECT attack FROM monster WHERE id=$pTwoMonsterId");
		$row = mysql_fetch_row($pTwoAttackId);
		if($row){
    		$pTwoAttackId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoAttackId: ".$pTwoAttackId."   ";
    	}
		$pTwoDefacerId = mysql_query("SELECT defacer FROM monster WHERE id=$pTwoMonsterId");
		$row = mysql_fetch_row($pTwoDefacerId);
		if($row){
    		$pTwoDefacerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoDefacerId: ".$pTwoDefacerId."   ";
    	}
		$pTwoEnhancerId = mysql_query("SELECT enhancer FROM monster WHERE id=$pTwoMonsterId");
		$row = mysql_fetch_row($pTwoEnhancerId);
		if($row){
    		$pTwoEnhancerId = $row[0]; // Ergebnis: 17, weil der User 16 ist
    		//echo "pTwoEnhancerId: ".$pTwoEnhancerId."   ";
    	}
		
		// Insert Spieler eins in GameSessionTabelle, dieser SPieler ist zuerst dran
		mysql_query("INSERT INTO $newSession VALUES ($session_user_id, $pOneMonsterId, 100, $pOneAtt, $pOneDef, $pOneAttackId, $pOneDefacerId, $pOneEnhancerId, 1)");
		// Insert Spieler zwei in GameSession Tabelle, dieser Spieler ist als zweites dran
		mysql_query("INSERT INTO $newSession VALUES ($otherPlayerId, $pTwoMonsterId, 20, $pTwoAtt, $pTwoDef, $pTwoAttackId, $pTwoDefacerId, $pTwoEnhancerId, 0)");
		// Schreibe die GameSessionId in die User Tabelle - Spieler Eins
		mysql_query("UPDATE tlreg SET gameSessionId = '$newSession' WHERE user_id = $session_user_id");
		// Schreibe die GameSessionId in die User Tabelle - Spieler Eins
		mysql_query("UPDATE tlreg SET gameSessionId = '$newSession' WHERE user_id = $otherPlayerId");
		//Lösche Spieler eins aus der warteliste
		mysql_query("DELETE FROM onwaitlist WHERE playerId=$session_user_id");
		//Lösche Spieler zwei aus der warteliste
		mysql_query("DELETE FROM onwaitlist WHERE playerId=$otherPlayerId");
		// Gibt eine eins, für das erfolgreiche Erstellen des Spiels zurück
		echo 1;
	}
?>