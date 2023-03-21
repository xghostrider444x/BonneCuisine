<?php 
class Menu{
    private $idMenu;
    private $nom;
    private $description;
    private $prix;

    public function __construct(){
        $ctp = func_num_args();
        $args = func_get_args();
        if($ctp >= 3){
            $this->setNom($args[0]);
            $this->setDescription($args[1]);
            $this->setPrix($args[2]);
        }
        if($ctp == 4){
            $this->setIdMenu($args[3]);
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

    private function lastInsertId($conn,$lang){
    $query = "SELECT IdMenu FROM menu_" . $lang . " ORDER BY IdMenu DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['IdMenu'];
    }

    public function ajouterMenu($conn,$lang){
        $data = [
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix
        ];
        $requete = $conn->prepare("INSERT into menu_".$lang."(nom,description,prix) values(:nom,:description,:prix)");
        $requete->execute($data);
        //Cette partie de code récupère le id qui a été attribuer au menu précédament créer;
        $this->setIdMenu($this->lastInsertId($conn,$lang));

        if($this->ajouterImage()){
            return true;
        }
        return false;
    }

    public function modifierMenu($conn,$lang){
        $data = [
            'table' => "menu_".$lang,
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix,
            'id' => $this->idMenu
        ];
        $requete = $conn->prepare("UPDATE :table set nom=:nom, description=:description, prix=:prix where idMenu=:id");
        $requete->execute($data);

        if($this->modifierImage()){
            return true;
        }
        else{
           return false;
        }
        
    }

    public function supprimerMenu($conn){
        $data = [
            'id' => $this->idMenu,
        ];
        $requete= $conn->prepare("DELETE from menu_fr where idMenu = :id");
        $requete->execute($data);
        $requete= $conn->prepare("DELETE from menu_en where idMenu = :id");
        $requete->execute($data);
        if($this->supprimerImage()){
            return true;
        }
        else{
            return false;
        }
        
    }

    private function ajouterImage(){
        $verif = true;
        $id = $this->idMenu;
        if($_FILES['img']['size'] < 52428800){
            $fichier = $_FILES['img']['tmp_name'];
            $destination = "images/$id.png";
            move_uploaded_file($fichier,$destination);
        }
        else{
            $verif = false;
        }
        return $verif;
    }

    private function supprimerImage(){
        $verif = true;
        if(file_exists("images/$this->idMenu.png")){
            unlink("images/$this->idMenu.png");
        }
        else{
            $verif=false;
        }
        return $verif;
    }
    
    private function modifierImage(){
        $verif = true;

        if ($_FILES['img']['error'] == UPLOAD_ERR_NO_FILE) {
            return false;
        }

        if($_FILES['img']['size'] < 52428800){
            if($this->supprimerImage()){
                $verif = $this->ajouterImage();
            }
        }
        else{
            $verif = false;
        }
        return $verif;
    }

}
?>