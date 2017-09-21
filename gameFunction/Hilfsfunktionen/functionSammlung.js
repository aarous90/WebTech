var x = 7;
var y = 8;
var z = x+y;
var person = "John Doe";

var cars=new Array();
	cars[0]="Saab";
	cars[1]="Volvo";
	cars[2]="BMW";

//Creating an object
var person={firstname:"John", lastname:"Doe", id:5566};
//Creating an object another way
person=new Object();
	person.firstname="John";
	person.lastname="Doe";
	person.age=50;
	person.eyecolor="blue";

function personConstructor(firstname,lastname,age,eyecolor)
{
	//.this meint hier die aktuell aufgerufene Funktion, ähnlich wie java
	this.firstname=firstname;
	this.lastname=lastname;
	this.age=age;
	this.eyecolor=eyecolor;

	//Instanz erzeugen
	//var person1 = new personConstructor("Pepe", "Schmitz", 45, "Brown")
}

function myFunction(){
	alert("Sie haben den Buttom geklickt");
}

function changeContent(){
	document.getElementById("text1").innerHTML="Sie haben also auf den Text gedrückt";
	document.getElementById("showX").innerHTML=z;
}

function newImage(){
	//Überschreibt das src-Attribut des image tags
	document.getElementById("image").src="landscape.jpg";
}

// requestet eine file vom server, die man dann beliebig benutzen kann (verrechnen, anzeigen etc)
function loadXMLDoc(){
	
	var xmlhttp;
	
	// erstellt das request objekt, je nach browser
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		// code for IE6, IE5
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // function that starts when the response is ready in the onreadystatechange event
    xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("ajaxTest").innerHTML=xmlhttp.responseText;
    		//alert("onreadystatechange");
    	}
	}

    // spezifiziert die art des requests (POST/GET, URL (location of file on server, asynch ja/nein?))
 	//xmlhttp.open("GET", "http://localhost/w3/ajaxTestFile.txt", true);
 	//xmlhttp.open("GET", "http://localhost/w3/phpTest.php", true);
 	xmlhttp.open("GET", "http://localhost/w3/getMonster.php", true);
	// sendet den request zum server
	xmlhttp.send();
}

// requestet eine file vom server, die man dann beliebig benutzen kann (verrechnen, anzeigen etc)
function getMonsterData(){
	
	var xmlhttp;
	
	if (window.XMLHttpRequest){
 		xmlhttp = new XMLHttpRequest();
  	} else {
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("monsterData").innerHTML=xmlhttp.responseText;
    	}
	}

 	xmlhttp.open("GET", "http://localhost/w3/getMonster.php", true);
	xmlhttp.send();
}
