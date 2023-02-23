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

	public function LogIn(string $login, string $password):void{
		$indexView = new View('LogIn');
		//Si le mdp du LogIn est correcte
		$accountManager = new AccountManager();
		$account = $accountManager->getByID($login);
		if($account->getHashPassword() == hash ("sha256", $password )){
			//On recupere le token
			$_SESSION["token"] = $accountManager->getToken();
			//On retourne sur main
			
			$indexView = new View('Index');
		}
		else{
			echo "Could not log in";
		}
		$indexView->generer([]);
	}

	public function displaySignIn():void {
		$indexView = new View('SignIn');
		$indexView->generer([]);
	}

	public function SignIn(string $login,string $password):void{
		$indexView = new View('SignIn');
		$indexView->generer([]);
	}

	public function LogOut():void {
		session_reset();
	}
	
}

?>