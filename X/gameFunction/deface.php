<?php
	// Aufgerufen, wenn ein Spieler im Kampf einen Defacer benutzt
	// Berechnet die neuen Werte des Verteidiger Monsters und updatet die GameTabelle

	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	// Spielerdaten, Beispielwerte, sollte der Browser irgendwie über die  Session kennen
	$thisPlayerId = "01";
	$otherPlayerId = "02";
	$sessionTable = "session0001";
	// Welcher Wert wird mit dem Defacer verändert?
	$target=$_GET["target"]; // Ziele sind: 0=att, 1=def


	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		// Führe die Wert Berechnungen mit dem Defacer aus
  		if($target == 0){
  			defaceAtt();
  		} else if($target == 1){
  			defaceADef($con);
  		} else {
  			// Hier ist ein Fehler passiert
  		}
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}


	function defaceAtt(){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt

		// id von att monster
		$attMonId = mysqli_query($con,"SELECT monsterId FROM $sessionTable WHERE playerId=$thisPlayerId");
		// att wert vom attacker monster 
		$attMonAttValue = mysqli_query($con,"SELECT monAtt FROM $sessionTable WHERE playerId=$thisPlayerId");
		// Hole defacer id aus der session tabelle 
		$defacerId = mysqli_query($con,"SELECT defacerId FROM $sessionTable WHERE id=thisMonId");
		// Hole anhand der defacer id den defacer value aus der attacken liste
		$defacerValue = mysqli_query($con,"SELECT value FROM defacer WHERE id=defacerId");
		// hp von def monster - beachte, dass dies hier die id des gegners ist
		$defMonAttValue = mysqli_query($con,"SELECT monAtt FROM $sessionTable WHERE playerId=$otherPlayerId");
		// def von def monster
		$defMonDefValue = mysqli_query($con,"SELECT monDef FROM $sessionTable WHERE playerId=$otherPlayerId");
		
		// --------------------------------------------------------------------------------------

		// Brechne den neuen att Wert
 		$defMonAttValue = $defmonAtt - (($attmonAtt/100)*$defacerValue)*((100-$defmonDef)/100);
 		// Update den datensatz für das def monster 
 		mysqli_query($con,"UPDATE session0001 SET monAtt=$defMonAttValue WHERE playerId=$otherPlayerId");
	}

	function defaceDef(){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt

		// id von att monster
		$attMonId = mysqli_query($con,"SELECT monsterId FROM $sessionTable WHERE playerId=$thisPlayerId");
		// att wert vom attacker monster 
		$attMonAttValue = mysqli_query($con,"SELECT monAtt FROM $sessionTable WHERE playerId=$thisPlayerId");
		// Hole defacer id aus der session tabelle 
		$defacerId = mysqli_query($con,"SELECT defacerId FROM $sessionTable WHERE id=thisMonId");
		// Hole anhand der defacer id den defacer value aus der attacken liste
		$defacerValue = mysqli_query($con,"SELECT value FROM defacer WHERE id=defacerId");
		// def von def monster
		$defMonDefValue = mysqli_query($con,"SELECT monDef FROM $sessionTable WHERE playerId=$otherPlayerId");

		// --------------------------------------------------------------------------------------

		// Brechne den neuen def Wert
 	 	$defMonDefValue = $defMonDefValue - (($attMonAttValue/100)*$defacerValue)*((100-$defMonDefValue)/100);
 	 	// Update den datensatz für das def monster 
 	 	mysqli_query($con,"UPDATE session0001 SET def=$defMonDefValue WHERE playerId=$otherPlayerId");
	}
?>

