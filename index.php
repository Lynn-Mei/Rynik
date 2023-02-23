<?php
require_once("controller/MainController.php");
require_once("controller/AccountController.php");
session_start();

$route = new MainController();
$accountRoute = new AccountController();

if(isset($_GET['action'])){
	$action = $_GET['action'];
	
	if($action == 'log-in'){	
		if (isset($_POST['login']) && isset($_POST['password'])){
			$accountRoute->LogIn($_POST['login'],$_POST['password']);
		}
		else {
			$accountRoute->displayLogIn();
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