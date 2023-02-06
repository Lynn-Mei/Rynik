<?php
require_once("model.php");
require_once("Account.php");
class AccountManager extends Model
{
	
	public function getAll():Array{
		$q = $this->execRequest('select * from accounts',array());
		
		$accounts = array();
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
			$account = new Animal();
			$account->hydrate($donnees);
			array_push($accounts, $account);
		}
		return $accounts;
	}
	
	public function createAccount(Array $values){
		$q = $this->execRequest('INSERT INTO accounts(username, email, password, rank, ppicture) VALUES (?,?,?,1,"default.png") ',$values);
		$id = $this->getLastInsertId();
		return $id;
	}
	
	public function updateAccount(Array $values){
	    $q = $this->execRequest('UPDATE accounts SET email=:email, password=:password, rank=:rank, ppicture=:profilePictureLink WHERE username=:username',$values);
	}

	public function deleteAccount(string $nom){
		$q = $this->execRequest('DELETE FROM accounts WHERE username=?', [$nom]);
		return True;
	}
	
	public function getByID(string $nom):Account{
		$q = $this->execRequest('SELECT * FROM accounts WHERE idUser=?',array($idAnimal));
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		$account = new Account();
		$account->hydrate($donnees);
		
		return $account;
	}
}

?>