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

	else if($action == 'sign-in'){
		if (isset($_POST['username']) && isset($_POST['password'])){
			$accountRoute->SignIn($_POST['username'],$_POST['email'],$_POST['password']);
		}
		else{
			$accountRoute->displaySignIn();
		}
	}
	else if($action == 'log-out'){
		$accountRoute->LogOut();
	}
	else if($action == 'cgu'){
		$route->displayCGU();				
	}
	else if($action == "account"){
		$accountRoute->displayAccount();
	}
	else{
		$route->displayNotFound();
	}
}
else{
	$route->displayIndex();
}
?>