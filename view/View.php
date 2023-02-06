<?php

class View {
	private string $fichier;
	private string $titre;
	private array $stylesheets;
	
	function __construct(string $action){
		$this->fichier = "view/view" . $action . ".php";
		$this->titre = $action;
		$this->stylesheets = array();
		array_push($this->stylesheets, 'index');
	}
	
	function generer(array $donnees){
		$content = $this->genererFichier($this->fichier, $donnees);
		
		$vue = $this->genererFichier('view/cast.php',
			array('titre'=>$this->titre, 'contenu' => $content, 'stylesheets' => $this->stylesheets));
		echo $vue;
	}
	
	function getTitle():string{
		return $this->titre;
	}
	
	function getFichier():string{
		return $this->fichier;
	}

	function applyStyle(string $name):void{
		array_push($this->stylesheets, $name);
	}
	
	private function genererFichier(string $fichier, array $donnees){
		if (file_exists($fichier)){
			extract($donnees);
			ob_start();
			require $fichier;
			return ob_get_clean();
		}
		else{
			throw new Exception("Fichier '$fichier' introuvable");
		}
	}
}
?>