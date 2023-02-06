<?php
require_once("controller/MainController.php");

$route = new MainController();

if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'cgu'){
		$route->displayCGU();				
	}
	else{
		$route->displayNotFound();
	}
}
else{
	$route->displayIndex();
}



?>