<?php

class Cours
{
	private PDO $pdo;
	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	public function addCours(string $coursTitre,string $modTitre, string $modOrdre,string $lecTitre)
	{	
		$lecons = $this->getLecons();
		$module = $this->getModule();
		$cours = $this->getCours();
		$id_cours=null;
		$id_module=null;
		foreach($cours as $cr){
			if($cr["title"]===$coursTitre){
				$id_cours=$cr["id_cours"];
			}
		}
		if($id_cours === null)
		{
			$sql = "INSERT INTO cours(title) VALUES(?)";
			$this->pdo->prepare($sql)->execute([$coursTitre]);
			$cours = $this->getCours();
		}
		foreach($cours as $cr){
                        if($cr["title"]===$coursTitre){
                                $id_cours=$cr["id_cours"];
                        }
		}
		foreach($module as $md){
                        if($md["mod_title"]===$modTitre and $md["mod_ordre"]===$modOrdre){
                                $id_module=$md["id_module"];
                        }
		}
                if($id_module === null)
                {
                        $sql = "INSERT INTO module(mod_title,mod_ordre,id_cours) VALUES(?,?,?)";
                        $this->pdo->prepare($sql)->execute([$modTitre,$modOrdre,$id_cours]);
                        $module = $this->getModule();
                }
		foreach($module as $md){
                        if($md["mod_title"]===$modTitre and $md["mod_ordre"]===$modOrdre){
                                $id_module=$md["id_module"];
                        }
                }
	
		foreach($lecons as $lc){
			if(($lecTitre !== $lc["lec_title"]) && ($id_module != $lc["id_module"])){
				$sql = "INSERT INTO lecons(lec_title,id_module) VALUES(?,?)";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute([$lecTitre,$id_module]);
			}
		}		

		return true;
	}
	public function getCours(): ? array{
		$sql="SELECT * FROM cours";
                $cours = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $cours;
	}
	public function getModule(): ? array{
		$sql="SELECT * FROM module";
                $module = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $module;
	}
	public function getLecons(): ? array{
		$sql ="SELECT * FROM lecons";
        $lecons = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $lecons;
	}
}
