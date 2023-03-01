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

    public function ajouterMenu($conn){
        $data = [
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix
        ];
        $requete = $conn->prepare("INSERT into menu_fr(nom,description,prix) values(:nom,:description,:prix)");
        $requete->execute($data);
        $requete = $conn->prepare("INSERT into menu_en(nom,description,prix) values(:nom,:description,:prix)");
        $requete->execute($data);
        //Cette partie de code récupère le id qui a été attribuer au menu précédament créer;
        $requete = $conn->prepare("SELECT idMenu from menu_fr where nom = :nom");
        $requete->execute(array('nom'=>$this->nom));
        $id = $requete->fetch();
        $this->setIdMenu($id["idMenu"]);
        return true;
    }

    public function modifierMenu($conn){
        $data = [
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix,
            'id' => $this->idMenu,
        ];
        $requete = $conn->prepare("UPDATE menu_fr set nom = :nom, description=:description, prix=:prix where idMenu = :id");
        $requete->execute($data);
        $requete = $conn->prepare("UPDATE menu_en set nom = :nom, description=:description, prix=:prix where idMenu = :id");
        $requete->execute($data);
        return true;
    }

    public function supprimerMenu($conn){
        $data = [
            'id' => $this->idMenu,
        ];
        $requete= $conn->prepare("DELETE from menu_fr where idMenu = :id");
        $requete->execute($data);
        return true;
    }

    public function ajouterImage(){
        if($_FILES['img'] != null){
            $fichier = $_FILES['img']['tmp_name'];
            move_uploaded_file($fichier,"images/$this->idMenu.png");
        }
        
    }

    public function supprimerImage(){
        if(file_exists("images/$this->idMenu.png")){
            unlink("images/$this->idMenu.png");
        }
        else{
            echo "
            <div class='container'>
                <div class='text-center pinkie'>
                    <h3>L'image $this->idMenu.png n'existe pas!</h3>
                </div>
            </div>";
        }
    }

}
?>