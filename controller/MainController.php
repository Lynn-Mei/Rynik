<?php
require_once("view/View.php");

class MainController{
	
	function __construct(){
		
	}
	
	public function displayIndex():void {
		$indexView = new View('Index');
		$indexView->generer([]);
	}
	
}

?>