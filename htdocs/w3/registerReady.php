





<?php

	// Datenbankverbindung
	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	$userId = 000;



	// Bezieht die Id des Users
	function getUserData($sql, $userId){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

 	 	//Muss so geschrieben werden, dass man die eigene ID bekommt
 	 	$userId = mysqli_query($con,"SELECT id FROM person WHERE id=1");

		mysqli_close($con);
	}		



	// Schreibt den Spieler in die Warte-Tabelle
	function registerReady($sql, $userId){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("Keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		}		

		mysqli_query($con,"INSERT INTO onwait (player) VALUES (1)");
	
		mysqli_close($con);

		echo "Status: Es hat alles gelappt";
	}


	// Aufruf der Methoden
	getUserData($sql, $userId);
	registerReady($sql, $userId);

?>