<?php
require_once("view/View.php");
require_once("model/AccountManager.php");
require_once("model/TokenManager.php");

class AccountController{
	
	function __construct(){
		
	}
	
	public function displayLogIn():void {
		$indexView = new View('LogIn');
		$indexView->generer([]);
	}

	public function LogIn(string $login, string $password):void{
		$indexView = new View('LogIn');
		//si l'utilisateur n'est pas deja connecte
		if((isset($_SESSION["token"]) && !$this->CheckTokenExists($_SESSION["token"])) || !isset($_SESSION["token"])){
		//Si le mdp du LogIn est correcte
		$accountManager = new AccountManager();
		$account = $accountManager->getByID($login);
		if($account->getHashPassword() == hash ("sha256", $password )){
			$this->GenerateSession($login);
			//On retourne sur main
			$indexView = new View('Index');
			echo "<p class='success'>You are connected.</p>";
		}
		else{
			echo "<p class='error'>Your password is incorrect.</p>";
		}}else{
			$indexView = new View('Index');
		}
		$indexView->generer([]);
	}

	public function displaySignIn():void {
		$indexView = new View('SignIn');
		$indexView->generer([]);
	}

	public function SignIn(string $login,string $email,string $password):void{
		$indexView = new View('SignIn');
		$accountManager = new AccountManager();
		try{
			$account = $accountManager->GetById($login);
			echo "<p>Account already exists</p>";
		}catch(Exception $e){	
			if($e->getMessage() == "NoSuchAccount"){
				$accountManager->createAccount([$login,$email,hash ("sha256", $password )]);
				$indexView = new View('Index');
				
				echo "<p>Account successfuly created</p>";
				$this->GenerateSession($login);
			}
		}
		$indexView->generer([]);
	}

	public function LogOut():void {
		session_reset();
		if(isset($_SESSION['token'])){
			$tokenManager = new TokenManager();
			$tokenManager->deleteToken($_SESSION['token']);
			$indexView = new View('Index');
			$indexView->generer([]);
		}
	}

	public function CheckTokenExists(string $token):bool{
		
		$tokenManager = new TokenManager();
		$res = true;
		try{
			$tokenManager->getAccountByToken($token);
		}catch(Exception $e){
			$res = false;
		}
		
		return $res;
	}

	private function GenerateSession(string $username){
			
		$stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$stringLength = strlen($stringSpace);
		$randomString = '';
		for ($i = 0; $i < 16; $i ++) {
			$randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
		}
		$_SESSION["token"] = $randomString;
		$tokenManager = new TokenManager();
		$date   = new DateTime();
		$tokenManager->createToken([$_SESSION["token"],$date->format('Y-m-d H:i:s'),$username]);
	}
	
	
}

?>