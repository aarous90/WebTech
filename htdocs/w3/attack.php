<?php

	$hp=$_GET["hp"];


	




	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	// Monster Attacker
	monAtt = new Object();
	monAtt.firstname="";
	monAtt.lastname="";
	monAtt.age=0;
	monAtt.eyecolor="";
	// Monster Defender
	monDef = new Object();
	monDef.firstname="";
	monDef.lastname="";
	monDef.age=0;
	monDef.eyecolor="";
	// Attacke 1
	attack = new Object();
	attack.id = 001;
	attack.value = 10;
	attack.ap = 10;
	// Defacer 1
	defacer = new Object();
	defacer.id = 001;
	defacer.value = 10;
	defacer.target = "att";
	defacer.ap = 10;
	// Attacke 1
	enhancer = new Object();
	enhancer.id = 001;
	enhancer.value = 10;
	enhancer.target = "att";
	enhancer.ap = 10;
	// Spieler
	player01 = 001;
	player02 = 002;
	

	function connectDB ($sql){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		//Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

  		// Welche Art von Aktion? Attack, Deface, Enhance
  		$type=$_GET["type"];

  		// Führt die einzelnen Aktionen aus
  		battle($type, $con);



  		mysqli_close($con);		
	}




	function attack($sql, $con){
		// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
		// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
		id von att monster
		$attmonId = mysqli_query($con,"SELECT monster FROM session0001 WHERE player=$player01");
		att von att monster 
		$attmonAtt = mysqli_query($con,"SELECT monAtt FROM session0001 WHERE player=player01");
		hp von def monster - beachte, dass dies hier die id des gegners ist
		$defmonHp = mysqli_query($con,"SELECT monHp FROM session0001 WHERE player=player02");
		def von def monster
		$defmonDef = mysqli_query($con,"SELECT monDef FROM session0001 WHERE player=player02");
		// --------------------------------------------------------------------------------------
		// welche attacke wurde ausgeführt? 
		$action=$_GET["action"];
		$a = att.$action;
		// Hole Attacken id aus der monster tabelle mit der action id (1-4 oder so)(att.od heißt, dass in der tabelle dann att1 oder att2 oder so steht und in der spalte nur die id der attacke)
		$attId = mysqli_query($con,"SELECT $a FROM monster WHERE id=attmonId");
		// Hole anhand der attacken id den attacken value aus der attacken liste
		$attValue = mysqli_query($con,"SELECT value FROM attack WHERE id=attId");
		// Brechne den neuen hp Wert
 	 	$defmonHp = $defmonHp - (($attmonAtt/100)*$attackValue)*((100-$defmonDef)/100);
 	 	// Update den datensatz für das def monster 
 	 	mysqli_query($con,"UPDATE session0001 SET hp=$defmonHp WHERE player=$player2");
 	 	// Schicke den neuen hp wert an den client des attack monsters
 	 	echo dem neuen wert und noch was --> nochmal nachdenken
	}



	function deface(defacer, monAtt, monDef){
		// Was ist das Ziel des Defacers
		$target=$_GET["target"];
		// Ausfürhen der Aktion je nach Ziel
		switch ($target) {
			case "att":
				// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
				// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
				// id von att monster
				$attmonId = mysqli_query($con,"SELECT monster FROM session0001 WHERE player=$player01");
				// att von att monster 
				$attmonAtt = mysqli_query($con,"SELECT monAtt FROM session0001 WHERE player=player01");
				// att von def monster - beachte, dass dies hier die id des gegners ist
				$defmonAtt = mysqli_query($con,"SELECT monHp FROM session0001 WHERE player=player02");
				// def von def monster
				$defmonDef = mysqli_query($con,"SELECT monDef FROM session0001 WHERE player=player02");
				// --------------------------------------------------------------------------------------
				// welcher defacer wurde ausgeführt? 
				$action=$_GET["action"];
				$a = defacer.$action;
				// Hole defacer id aus der monster tabelle mit der action id (1-4 oder so)(att.od heißt, dass in der tabelle dann att1 oder att2 oder so steht und in der spalte nur die id der attacke)
				$deafcerId = mysqli_query($con,"SELECT $a FROM monster WHERE id=attmonId");
				// Hole anhand der defacer id den defacer value aus der attacken liste
				$defacerValue = mysqli_query($con,"SELECT value FROM defacer WHERE id=defacerId");
				// Brechne den neuen att Wert
 	 			$defmonAtt = $defmonAtt - (($attmonAtt/100)*$defacerValue)*((100-$defmonDef)/100);
 	 			// Update den datensatz für das def monster 
 	 			mysqli_query($con,"UPDATE session0001 SET att=$defmonAtt WHERE player=$player2");
 	 			// Schicke den neuen âtt wert an den client des attack monsters
 	 			echo dem neuen wert und noch was --> nochmal nachdenken
				break;
			
			case "def":
				// Die Session Tabelle hält nur die zwei Spieler und wird bei spielstart atomatisch erstellt
				// Die eigene id und die id des anderen spielers kennt der browser, die wird ihm bei der anmeldung des spiels mitgeteilt
				// id von att monster
				$attmonId = mysqli_query($con,"SELECT monster FROM session0001 WHERE player=$player01");
				// att von att monster 
				$attmonAtt = mysqli_query($con,"SELECT monAtt FROM session0001 WHERE player=player01");
				// hp von def monster - beachte, dass dies hier die id des gegners ist
				$defmonAtt = mysqli_query($con,"SELECT monHp FROM session0001 WHERE player=player02");
				// def von def monster
				$defmonDef = mysqli_query($con,"SELECT monDef FROM session0001 WHERE player=player02");
				// --------------------------------------------------------------------------------------
				// welcher defacer wurde ausgeführt? 
				$action=$_GET["action"];
				$a = defacer.$action;
				// Hole defacer id aus der monster tabelle mit der action id (1-4 oder so)(att.od heißt, dass in der tabelle dann att1 oder att2 oder so steht und in der spalte nur die id der attacke)
				$defacerId = mysqli_query($con,"SELECT $a FROM monster WHERE id=attmonId");
				// Hole anhand der defacer id den defacer value aus der attacken liste
				$defacerValue = mysqli_query($con,"SELECT value FROM defacer WHERE id=defacerId");
				// Brechne den neuen att Wert
 	 			$defmonDef = $defmonDef - (($attmonAtt/100)*$defacerValue)*((100-$defmonDef)/100);
 	 			// Update den datensatz für das def monster 
 	 			mysqli_query($con,"UPDATE session0001 SET def=$defmonDef WHERE player=$player2");
 	 			// Schicke den neuen âtt wert an den client des attack monsters
 	 			echo dem neuen wert und noch was --> nochmal nachdenken



				
				break;
			default:
				// Hier passiert nischt
				break;
		}
	}



	function enhance(enhancer, monAtt, monDef){
		switch (defacer.target) {
			case "att":
				monAtt.att = monAtt.att + ((monAtt.att/100)*enhancer.value);
				break;
			case "def":
				monAtt.def = monAtt.def + ((monAtt.att/100)*enhancer.value);
				break;
			default:
				// Hier passiert nischt
				break;
		}
	}




	function battle($type, $con){
		switch (type) {
			case "attack":
				attack();
				break;
			case "defacer":
				deface();
				break;
			case "enhancer":
				enhance();
				break;
			default:
				// Hier wieder nischt
				break;
		}

	}


?>