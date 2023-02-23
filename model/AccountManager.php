<?php
require_once("model.php");
require_once("Account.php");
class AccountManager extends Model
{
	
	public function getAll():Array{
		$q = $this->execRequest('select * from user',array());
		
		$accounts = array();
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
			$account = new Animal();
			$account->hydrate($donnees);
			array_push($accounts, $account);
		}
		return $accounts;
	}
	
	public function createAccount(Array $values){
		$q = $this->execRequest('INSERT INTO user(username, email, password, rank, ppicture) VALUES (?,?,?,1,"default.png") ',$values);
		$id = $this->getLastInsertId();
		return $id;
	}
	
	public function updateAccount(Array $values){
	    $q = $this->execRequest('UPDATE user SET email=:email, password=:password, rank=:rank, ppicture=:profilePictureLink WHERE username=:username',$values);
	}

	public function deleteAccount(string $nom){
		$q = $this->execRequest('DELETE FROM user WHERE username=?', [$nom]);
		return True;
	}
	
	public function getByID(string $nom):Account{
		$q = $this->execRequest('SELECT * FROM user WHERE username=?', [$nom]);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		$account = new Account();
		if(gettype($donnees) == "array"){
			$account->hydrate($donnees);
		}
		return $account;
	}

	public function getToken():string{
		return "Hey hey, I am a token";
	}
}

?>