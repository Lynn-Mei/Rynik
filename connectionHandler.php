<?php
	session_start();
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

	$sql = "SELECT * FROM User WHERE username = '".$_POST['username']."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["password"] == $_POST['password']){
				echo "Welcome back " . $row["username"]. "<br>";
				echo '<a href="webpage.php">HEY HEY =)</a>';
				echo '<a href="disconnect.php">Disconnect</a>';
				$_SESSION['name'] = $row["username"];
				$_SESSION['rank'] = $row["rank"];
				header("Location: index.php");
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