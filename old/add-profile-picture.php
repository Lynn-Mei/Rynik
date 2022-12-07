<?php
	session_start();

	$uploads_dir = 'C:\xampp\htdocs\Valkiryn2\Valkiryn\images\\';
	/*Need to add conflict gestion*/
	$name = basename($_FILES['file']["name"]);
	move_uploaded_file($_FILES['file']['tmp_name'], "$uploads_dir/$name");

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

	$sql = "Update user SET pplink = 'images/". $name  ."' WHERE username = '".$_SESSION['name']."'";
	$result = $conn->query($sql);
	
	$_SESSION['pplink'] = "images/". $name;

	echo "<img src='images/". $name . "' />";

?>