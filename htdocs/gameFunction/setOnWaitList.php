<?php
	// Wird aufgerufen, wenn der Spieler sagt er ist bereit für ein Spiel
	// Setzt ihn auf eine Warteliste, wenn das schon einer ist, startet er eine GameTabelle und löscht die Spieler von der Warteliste

	include 'C:/xampp/htdocs/core/init.php';
	include 'C:/xampp/htdocs/gameFunction/databaseAccess.php';
	include 'C:/xampp/htdocs/gameFunction/checkPlayerAndCreateGame.php';

	// aaa
	function connectDB ($sql){
		// Baue Verbindung zu DB auf
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		// Im Falle eines Errors, mache folgendes
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		
  		// hier noch Prüfung einfügen, ob der Spieler schon in einem Spiel ist
  		//Schreibt den Spieler in die Warteliste
  		setOnWait($con);
  		// Schließe die Verbindung zur DB
  		mysqli_close($con);		
	}

	// aaa
	function setOnWait($con){
		// Zugang zur globalen Variable $session_user_id aus der init.php erhalten
		global $session_user_id;
		// Trägt die SpielerId in die onWait Liste ein
		mysql_query("INSERT INTO onwaitlist VALUES ($session_user_id)");
  		// Überprüfe, ob noch ein anderer Spieler in der Liste
  		checkForOtherPlayers($con);
	}

	// aa
	connectDB($sql);

?>