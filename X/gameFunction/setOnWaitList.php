<?php
	// Wird aufgerufen, wenn der Spieler sagt er ist bereit für ein Spiel
	// Setzt ihn auf eine Warteliste, wenn das schon einer ist, startet er eine GameTabelle und löscht die Spieler von der Warteliste

	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	// Spieler Id, wird beim Klicken auf die Warteliste mit geschickt
	$playerId = "01";
	




	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		//Schreibt den Spieler in die Warteliste
  		setOnWait($con);
  		// Überprüfe, ob noch ein anderer Spieler in der Liste
  		checkForOtherPlayers($con);
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	function setOnWait($con){
		// Zugriff auf die globale Variable playerId bekommen
		global $playerId;
		// Trägt die SpielerId in die onWait Liste ein
		mysqli_query($con,"INSERT INTO onWaitList (playerId) VALUES ($playerId)");
	}

	function checkForOtherPlayers($con){
		// Speichert alle Player Einträge in der Variable
		$playerEntries =  mysql_query("SELECT playerId FROM onWaitList");
		// Zählt die Anzahl der Player Einträge
		$playerNumber = mysql_num_rows($playerEntries);
		// Wenn zwei oder mehr Spieler drin sind, starte das Spiel
		if($playerNumber >= 2){
			//Hole eigenen Eintrag
			$attMonId = mysqli_query($con,"SELECT playerId FROM onWaitList WHERE playerId=$thisPlayerId");
			//Hole einen zweiten Eintrag (der erste Spieler am besten)

			//Schreibe Sie in eine GAmeTable/Session 
			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//Lösche die Einträge aus der Warteliste
			mysqli_query($con,"DELETE FROM onWaitList WHERE playerId=$playerId");
			mysqli_query($con,"DELETE FROM onWaitList WHERE playerId=$otherPlayerId");
		}
	}







?>