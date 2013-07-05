var interval;

function registerReady(){
	var xmlhttp;

	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   	 }
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		if(xmlhttp.responseText == 1){
    			// Starte die Spielmechanik und alles
    			document.getElementById("status").innerHTML= "Das ist TRUE";
    		} else {
    			// Wenn ich kein true zurück bekommen, ist noch kein anderer Spieler in der
    			// Liste. In dem Fall, frag alle paar Sekunden nach, ob jetzt einer da ist
    			window.setInterval(checkForNewPlayer(), 5000);
    		}
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/setOnWaitList.php", true);
	xmlhttp.send();
}

// Fragt, ob ein neuer Spieler in der Warte Liste ist
function checkForNewPlayer(){
	var xmlhttp;

	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   	 }
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		if(xmlhttp.responseText == 1){
    			window.clearInterval(interval);
    			// Starte die Spielmechanik und alles
    			document.getElementById("status").innerHTML= "Das ist TRUE";
    		}
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/checkForNewPlayer.php", true);
	xmlhttp.send();
}

function attackBtn(){
	var xmlhttp;
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   		}
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		// Wenn eine Antwort kommt, dann wurde meine Aktion ausgeführt und der
    		// Gegner ist dran. Bis dahin, setze den Timer
    		interval = window.setInterval ("test()", 2000 );
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/attack.php", true);
	xmlhttp.send();
}

function test(){
	document.getElementById("status").innerHTML="hU";
}

function defAttBtn(){
	var xmlhttp;
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   		}
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		// Wenn eine Antwort kommt, dann wurde meine Aktion ausgeführt und der
    		// Gegner ist dran. Bis dahin, setze den Timer
    		interval = window.setInterval ("checkWhoseTurn()", 2000 );
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/deface.php?target=0", true);
	xmlhttp.send();
}

function defDefBtn(){
	var xmlhttp;
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   		}
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		// Wenn eine Antwort kommt, dann wurde meine Aktion ausgeführt und der
    		// Gegner ist dran. Bis dahin, setze den Timer
    		interval = window.setInterval ("checkWhoseTurn()", 5000 );
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/deface.php?target=1", true);
	xmlhttp.send();
}

function enhAttBtn(){
	var xmlhttp;
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   		}
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		// Wenn eine Antwort kommt, dann wurde meine Aktion ausgeführt und der
    		// Gegner ist dran. Bis dahin, setze den Timer
    		interval = window.setInterval ("checkWhoseTurn()", 5000 );
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/enhance.php?target=0", true);
	xmlhttp.send();
}

function enhDefBtn(){
	var xmlhttp;
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
   		}
   	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("status").innerHTML=xmlhttp.responseText;
    		// Wenn eine Antwort kommt, dann wurde meine Aktion ausgeführt und der
    		// Gegner ist dran. Bis dahin, setze den Timer
    		interval = window.setInterval ("checkWhoseTurn()", 5000 );
    	}
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/enhance.php?target=1", true);
	xmlhttp.send();
}

function checkWhoseTurn(){
	var xmlhttp;
	var response;

	if (window.XMLHttpRequest){xmlhttp = new XMLHttpRequest();} else {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
   	
   	xmlhttp.onreadystatechange=function(){
  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
    	//document.getElementById("status").innerHTML=xmlhttp.responseText;
    	document.getElementById("status").innerHTML="HIII";
    	response = xmlhttp.responseText;
    	if(response == 1){
			//Ich bin dran
			document.getElementById("status").innerHTML="Ich bin dran ";
			// Stoppe die Intervall-Abfrage, bis ich wieder eine Aktion ausgeführt habe
			//window.clearInterval(interval);
		} else {
			// Der andere ist noch dran, mache die Buttons nicht klickbar, etc
			xmlhttp.open("GET", "http://localhost/X/gameFunction/endGame.php", true);
			document.getElementById("status").innerHTML="Der andere ist dran";		
		}	
	}
 	xmlhttp.open("GET", "http://localhost/X/gameFunction/checkWhoseTurn.php", true);
	xmlhttp.send();
	}




	
}













	

