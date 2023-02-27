<?php
require_once("model.php");
require_once("Token.php");
require_once("model/AccountManager.php");
require_once("model/Account.php");
class TokenManager extends Model
{
	
	public function getAll():Array{
		$q = $this->execRequest('select * from session',array());
		
		$tokens = array();
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
			$token = new Token();
			$token->hydrate($donnees);
			array_push($tokens, $token);
		}
		return $tokens;
	}
	
	public function createToken(Array $values){
		$q = $this->execRequest('INSERT INTO session(Token,DateCreation,Username) VALUES (?,?,?) ',$values);
		$id = $this->getLastInsertId();
		return $id;
	}
	
	public function updateToken(Array $values){
	    $q = $this->execRequest('UPDATE session SET WHERE Token=:token',$values);
	}

	public function deleteToken(string $token){
		$q = $this->execRequest('DELETE FROM session WHERE Token=?', [$token]);
		return True;
	}
	
	public function getAccountName(string $token):string{
		$q = $this->execRequest('SELECT * FROM session WHERE Token=?', [$token]);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		$token = new Token();
		$account = new Account();
		if(gettype($donnees) == "array"){
			$token->hydrate($donnees);
		}else{
			throw new Exception("NoSuchAccount");
		}
		return $token->getUsername();
	}

	public function getAccountByToken(string $token):Account{
		$q = $this->execRequest('SELECT * FROM session WHERE Token=?', [$token]);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		$token = new Token();
		$account = new Account();
		if(gettype($donnees) == "array"){
			$token->hydrate($donnees);
			$accManager = new AccountManager();
			$account = $accManager->getById($token->getUsername());
		}else{
			throw new Exception("NoSuchAccount");
		}
		return $account;
	}
}

?>