<?php
require_once("view/View.php");
require_once("model/AccountManager.php");


class AccountController{
	
	function __construct(){
		
	}
	
	public function displayLogIn():void {
		$indexView = new View('LogIn');
		$indexView->generer([]);
	}

	public function LogIn():void{
		
	}

	public function displaySignIn():void {
		$indexView = new View('SignIn');
		$indexView->generer([]);
	}

	public function SignIn(Array $val):void{
		/*$accountManager = new AccountManager();
		$accountManager->createAccount($val);
		*/
		$indexView = new View('SignIn');
		$indexView->generer([]);
	}

	public function LogOut():void {

	}
	
}

?>