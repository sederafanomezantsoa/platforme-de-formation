<?php
require_once __DIR__. "/../model/cours.php";

class CoursController
{
    private Cours $coursModel;

    public function __construct(PDO $pdo)
    {
        $this->coursModel = new Cours($pdo);
    }

    public function addCours(string $coursTitre,string $modTitre, string $modOrdre,string $lecTitre)
    {
        $this->coursModel->addCours($coursTitre,$modTitre,$modOrdre,$lecTitre);
    }  
}

