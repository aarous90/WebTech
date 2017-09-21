


<?php
	//Eine Variable
	/*$x = 7;
	$t=40;
	$txt1="Hello world!";
	$txt2="What a nice day!";
	
	// Erste Art ein Array zu machen
	$cars=array("Volvo","BMW","Toyota");
	
	// Zweite Art ein Attay zu machen
	$cars[0]="Volvo";
	$cars[1]="BMW";
	$cars[2]="Toyota";

	// Ein associates Array
	$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
	echo "Peter is " . $age['Peter'] . " years old.";



	//Der Punkt ist gleich dem Plus in Java, er joint die Strings
	echo $txt1 . " " . $txt2;

	
	// IF Statement Muster
	if ($t<"20"){
 		echo "Have a good day!";
  	}

  	// Switch Statement Muster
  	switch ($t){
		case 7:
  			//code to be executed if n=label1;
 			break;
		case 10:
  			//code to be executed if n=label2;
  			break;
		default:
 			//code to be executed if n is different from both label1 and label2;
	}*/







	$sql["host"] = "127.0.0.1";
	$sql["user"] = "root";
	$sql["pass"] = "";
	$sql["db"] = "tl";

	$host = "127.0.0.1";
	$user = "root";
	$pass = "";
	$db = "tl";

	

 	function createDatabase($con){
		$con = mysqli_connect($host,$user,$pass,$db) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		}

		$sql="CREATE DATABASE my_db";
		if (mysqli_query($con,$sql)){
  			echo "Database my_db created successfully";
 	 	} else {
  			echo "Error creating database: " . mysqli_error($con);
  		}

  		mysqli_close($con);
 	}



 	function createTable($sql){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		} 		

 		$sql="CREATE TABLE session(id INT(3), player1 INT(3), player2 INT(3))";

		// Execute query
		if (mysqli_query($con,$sql)){
  			echo "Table persons created successfully";
 		 } else {
  			echo "Error creating table: " . mysqli_error($con);
  		}

  		mysqli_close($con);
 	}



	function insertIntoDB($con){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		}		

		mysqli_query($con,"INSERT INTO persons (FirstName, LastName, Age) VALUES ('Peter', 'Griffin',35)");
		mysqli_query($con,"INSERT INTO persons (FirstName, LastName, Age) VALUES ('Glenn', 'Quagmire',33)");
	
		mysqli_close($con);
	}



	function selectFromTable($con){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		}		


		$result = mysqli_query($con,"SELECT * FROM monster");

		while($row = mysqli_fetch_array($result)){
  			echo $row['FirstName'] . " " . $row['LastName'];
  			echo "<br>";
  		}

		mysqli_close($con);
	}



	function selectFromTableWhere($con){
		$con = mysqli_connect($sql["host"],$sql["user"],$sql["pass"],$sql["db"]) or die ("keine Verbindung möglich");
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
 		}

		$result = mysqli_query($con,"SELECT * FROM Persons WHERE FirstName='Peter'");

		while($row = mysqli_fetch_array($result)){
  			echo $row['FirstName'] . " " . $row['LastName'];
  			echo "<br>";
  		}

  		mysqli_close($con);
	}

	//createDatabase($con);
	createTable($sql);
	//insertIntoDB($con);
	//selectFromTable($con);




	



	

?>

