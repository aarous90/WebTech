<?php
	// Aufgerufen, wenn ein Spieler im Kampf eine Attacke benutzt
	// Berechnet die neue HP des Verteidiger Monsters und updatet die GameTabelle

	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	// Spielerdaten, Beispielwerte, sollte der Browser irgendwie über die  Session kennen
	$thisPlayerId = "01";
	$otherPlayerId = "02";
	$sessionTable = "session0001";
	//
	//


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
		
		// id von att monster
		$attMonId = mysqli_query($con,"SELECT monsterId FROM $sessionTable WHERE playerId=$thisPlayerId");
		// att wert vom attacker monster 
		$attMonAttValue = mysqli_query($con,"SELECT monAtt FROM $sessionTable WHERE playerId=$thisPlayerId");
		// Hole Attacken id aus der session tabelle 
		$attackId = mysqli_query($con,"SELECT attackId FROM $sessionTable WHERE playerId=$thisPlayerId");
		// Hole anhand der attacken id den attacken value aus der attacken liste
		$attackValue = mysqli_query($con,"SELECT value FROM attack WHERE id=attackId");
		// hp von def monster - beachte, dass dies hier die id des gegners ist
		$defMonHp = mysqli_query($con,"SELECT monHp FROM $sessionTable WHERE playerId=$otherPlayerId");
		// def von def monster
		$defMonDefValue = mysqli_query($con,"SELECT monDef FROM $sessionTable WHERE playerId=$otherPlayerId");
		
		// --------------------------------------------------------------------------------------------------------------------------------------------------------

		// Brechne den neuen hp Wert
 	 	$defmonHp = $defmonHp - (($attmonAtt/100)*$attackValue)*((100-$defmonDef)/100);
 	 	// Update den datensatz für das def monster 
 	 	mysqli_query($con,"UPDATE session0001 SET monHp=$defmonHp WHERE playerId=$otherPlayerId");
	}
?>