<?php 
class Menu{
    private $idMenu;
    private $nom;
    private $description;
    private $prix;

    public function __construct(){
        $ctp = func_num_args();
        $args = func_get_args();
        if($ctp == 3){
            setNom($args[0]);
            setDescription($args[1]);
            setPrix($args[2]);
        }
    }

    public function setIdMenu($idMenu){
        $this->idMenu = $idMenu;
    }
    public function getIdMenu(){
        return $this->idMenu;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getNom(){
        return $this->nom;
    }

    public function setDescription($description){
        $this->description = $description;
    }
    public function getDescription(){
        return $this->description;
    }

    public function setPrix($prix){
        $this->prix = $prix;
    }
    public function getPrix(){
        return $this->prix;
    }

    public function ajouterMenu(){

    }

    public function modifierMenu(){

    }

    public function suprimerMenu(){

    }



}
?>