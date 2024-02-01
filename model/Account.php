<?php

class Account{

private string $username  = "";
private string $hashPassword = "";
private int $rank;
private string $profilPicLink = "";
private string $email = "mururoa.lynn@sezamail.net";

function __construct(){

}

public function getUsername():string{
	return $this->username;
}

public function setUsername(string $usname){
	$this->username = $usname;
}

public function getEmail():string{
	return $this->email;
}

public function setEmail(string $email){
	$this->email = $email;
}

public function getHashPassword():string{
	return $this->hashPassword;
}

public function setHashPassword(string $hash){
	$this->hashPassword = $hash;
}

public function getRank():int{
	return $this->rank;
}

public function setRank(int $rk){
	$this->rank = $rk;
}

public function getProfilPicLink():?string{
	return $this->profilPicLink;
}

public function setProfilPicLink(?string $rk){
	$this->profilPicLink = $rk;
}


public function hydrate(array $donnees){
	foreach($donnees as $key => $value){
		$method = 'set'.ucfirst($key);
		if(method_exists($this, $method)){
			$this->$method($value);
		}
	}
}
}
?>