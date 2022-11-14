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

	$username_exists = false;
	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			$username_exists = true;
			echo "Username already in use";
		}
	}else{
		$sql = "INSERT INTO `user`(`idUser`, `username`, `password`, `rank`) VALUES (NULL,'".$_POST['username']."','".$_POST['password']."',1)";
		$result = $conn->query($sql);

		if ($result==true) {
			echo "Success";
			$_SESSION['name'] = $_POST["username"];
		} else {
			echo "Failed to register user";
		}
	}
	
	$conn->close();
?>