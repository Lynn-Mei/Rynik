<?php
abstract class Model
{
	private PDO $db;
	
	protected function execRequest(string $sql, array $params = null):PDOStatement{
		$db = $this->getDB();
		
		$q = $this->db->prepare($sql);
		$resultat = $q->execute($params);
		
		return $q;
	}
	
	protected function getLastInsertId():int{
		$db = $this->db;
		return $db->lastInsertId();
	}
	
	private function getDB():PDO{
		try{
			$this->db = new PDO('mysql:host=localhost;dbname=valkiryn', 
				'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return $this->db;
		}
		catch(Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
	}
}
?>