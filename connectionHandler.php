<?php
	
	//print($_GET['username']);
	//print($_GET['password']);
	
	//$mysqli = new mysqli("localhost", "", "", "valkiryn");

	//$mysqli->query("SELECT rank FROM User WHERE username = 'Lynn'");
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "valkiryn";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM User WHERE username = '".$_GET['username']."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["password"] == $_GET['password']){
				echo "Welcome back " . $row["username"]. "<br>";
			}
			else{
				echo "Wrong password";
			}
		}
	} else {
		echo "User not found";
	}
	$conn->close();
?>