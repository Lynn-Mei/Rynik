<?php
require_once("controller/MainController.php");
require_once("controller/AccountController.php");

$route = new MainController();
$accountRoute = new AccountController();

if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'log-in'){
		$accountRoute->displayLogIn();	
		if (isset($_POST['username'])){
			$accountRoute->LogIn($_POST);
		}			
	}
	if($action == 'sign-in'){
		$accountRoute->displaySignIn();
		if (isset($_POST['username'])){
			echo "Heyhey";
			$accountRoute->SignIn($_POST);
		}
	}
	if($action == 'log-out'){
		$accountRoute->LogOut();
	}
}
else{
	$route->displayIndex();
}



?>