<?php

class Token{

private string $token = "";
private string $dateCreation;
private string $username  = "";

function __construct(){

}

public function getToken():string{
	return $this->token;
}

public function setToken(string $token){
	$this->token = $token;
}

public function getDateCreation():DateTime{
	return $this->date;
}

public function setDateCreation(string $dateCreation){
	$this->dateCreation = $dateCreation;
}

public function getUsername():string{
	return $this->username;
}

public function setUsername(string $username){
	$this->username = $username;
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