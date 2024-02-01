<?php
require_once("view/View.php");
require_once("model/AccountManager.php");
require_once("model/TokenManager.php");

class AccountController{
	
	function __construct(){
		
	}
	
	public function displayLogIn():void {
		$indexView = new View('LogIn');
		$indexView->applyStyle('account');
		$indexView->generer([$this->getLoggedIn()]);
	}

	public function LogIn(string $login, string $password):void{
		$indexView = new View('LogIn');
		$indexView->applyStyle('account');
		//si l'utilisateur n'est pas deja connecte
		if(isset($_SESSION["token"])){
			$tokenManager = new TokenManager();
			try{
				$tokenManager->deleteToken($_SESSION['token']);
			}
			catch(Exception $e){
				echo"";
			}
		}
		//Si le mdp du LogIn est correcte
		$accountManager = new AccountManager();
		$account = $accountManager->getByID($login);
		if($account->getHashPassword() == hash ("sha256", $password )){
			$this->GenerateSession($login);
			$_SESSION["account"] = $account;
			//On retourne sur main
			$indexView = new View('Index');
			echo "<p class='success'>You are connected.</p>";
		}else{
			echo "<p class='error'>Your password is incorrect.</p>";
			$indexView = new View('LogIn');
		}
		$indexView->generer([$this->getLoggedIn()]);
	}

	public function displaySignIn():void {
		$indexView = new View('SignIn');
		$indexView->applyStyle('account');
		$indexView->generer([$this->getLoggedIn()]);
	}

	public function SignIn(string $login,string $email,string $password):void{
		$indexView = new View('SignIn');
		$indexView->applyStyle('account');
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
		$indexView->generer([$this->getLoggedIn()]);
	}

	public function LogOut():void {
		if(isset($_SESSION['token'])){
			$tokenManager = new TokenManager();
			$tokenManager->deleteToken($_SESSION['token']);
			session_destroy();
			session_start();
			$indexView = new View('Index');
			$indexView->generer([$this->getLoggedIn()]);
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
	
	public function getLoggedIn():Account|null{
	$account = null;	
	if(isset($_SESSION['token'])){
			$tokenManager = new TokenManager();
			$accountManager = new AccountManager();
			try{
				$account = $accountManager->getById($tokenManager->getAccountName($_SESSION['token']));
			}catch(Exception $e){
			}
		}
		return $account;
	}

	public function displayAccount():void{
		$indexView = new View('Account');
		//$indexView->applyStyle('accountPage');
		$accountManager = new AccountManager();
		$indexView->generer([$this->getLoggedIn()]);
	}
	
}

?>