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
		$q = $this->execRequest('INSERT INTO user(Username, Email, HashPassword, Rank, Pplink) VALUES (?,?,?,1,"default.png") ',$values);
		$id = $this->getLastInsertId();
		return $id;
	}
	
	public function updateAccount(Array $values){
	    $q = $this->execRequest('UPDATE user SET Email=:email, HashPassword=:password, Rank=:rank, Pplink=:profilePictureLink WHERE Username=:username',$values);
	}

	public function deleteAccount(string $nom){
		$q = $this->execRequest('DELETE FROM user WHERE Username=?', [$nom]);
		return True;
	}
	
	public function getByID(string $nom):Account{
		$q = $this->execRequest('SELECT * FROM user WHERE Username=?', [$nom]);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		$account = new Account();
		if(gettype($donnees) == "array"){
			$account->hydrate($donnees);
		}else{
			throw new Exception("NoSuchAccount");
		}
		return $account;
	}
}

?>