<?php
	// Erstellt, wenn sich zwei Spieler gefunden haben eine GameTabelle, die alle Daten über das Spiel enthält
	// Darin werden alle wichtigen Daten der zwei Spieler und deren Monster gespeichert

	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	// Spielerdaten, Beispielwerte, sollte der Browser irgendwie über die  Session kennen
	$PlayerOneId = "01";
	$PlayerTwoId = "02";

	// Random Zahl zur Erstellund der Spieltabelle


	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		// Erstelle die Session Tabelle
  		createTable($con);
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	function createTable($con){
		// Create random number
		$random = rand();
		this.$random = $random;
		// Try to create new table
		if (mysql_query($con, "CREATE TABLE IF NOT EXISTS $random(playerId INT(3), monster INT(30), monAtt INT(3), monDef INT(3), attackId INT(3), defacerId INT(3), enhancerId INT(3)");{
			// If table does not exists, ok
			echo "Table persons created successfully";
		} else {
			// If tavle exists, try again
			echo "Error creating table: " . mysqli_error($con);
			create();
		}
	}

	function insertInTable($con){
		// Daten von Player One
		$pOneMonsterId = mysqli_query($con,"SELECT monsterId FROM player WHERE playerId=$playerOneId");
		$pOneAtt = mysqli_query($con,"SELECT att FROM monster WHERE monsterId=$pOneMonsterId");
		$pOneDef = mysqli_query($con,"SELECT def FROM monster WHERE monsterId=$pOneMonsterId");
		$pOneAttackId = mysqli_query($con,"SELECT attackId FROM monster WHERE monsterId=$pOneMonsterId");
		$pOneDefacerId = mysqli_query($con,"SELECT defacerId FROM monster WHERE monsterId=$pOneMonsterId");
		$pOneEnhancerId = mysqli_query($con,"SELECT enhancerId FROM monster WHERE monsterId=$pOneMonsterId");
		//Daten von Player Two
		$pTwoMonsterId = mysqli_query($con,"SELECT monsterId FROM player WHERE playerId=$playerTwoId");
		$pTwoAtt = mysqli_query($con,"SELECT att FROM monster WHERE monsterId=$pTwoMonsterId");
		$pTwoDef = mysqli_query($con,"SELECT def FROM monster WHERE monsterId=$pTwoMonsterId");
		$pTwoAttackId = mysqli_query($con,"SELECT attackId FROM monster WHERE monsterId=$pTwoMonsterId");
		$pTwoDefacerId = mysqli_query($con,"SELECT defacerId FROM monster WHERE monsterId=$pTwoMonsterId");
		$pTwoEnhancerId = mysqli_query($con,"SELECT enhancerId FROM monster WHERE monsterId=$pTwoMonsterId");

		// Insert Spieler eins
		mysqli_query($con,"INSERT INTO $random (playerId, monster, monAtt, monDef, attackId, defacerId, enhancerId) VALUES ($pOneMonsterId, $pOneAtt, $pOneDef, $pOneAttackId, $pOneDefacerId, $pOneEnhancerId)");
		// Insert Spieler zwei
		mysqli_query($con,"INSERT INTO $random (playerId, monster, monAtt, monDef, attackId, defacerId, enhancerId) VALUES ($pTwoMonsterId, $pTwoAtt, $pOneDef, $pTwoAttackId, $pTwoDefacerId, $pTwoEnhancerId)");
	}
	








?>