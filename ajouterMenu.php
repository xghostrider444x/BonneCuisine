<?php
session_start();
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
}
else{
   header("Location:index.php");
}
include("librairie/fonction.lib.php");
include("class/menuClass.php");
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');

if(isset($_GET["action"])){
    if($_GET["action"]== "ajouter"){
        $verif = true;
        $newMenuFr = new Menu($_POST["nom_fr"],$_POST["description_fr"],$_POST["prix"]);
        $newMenuEn = new Menu($_POST["nom_en"],$_POST["description_en"],$_POST["prix"]);
        if($newMenuFr->ajouterMenu($conn,"fr")&&$newMenuEn->ajouterMenu($conn,"en")){
            afficherMessageAvecCSS("Le menu a bien été ajouté");
        }
        else{
            $newMenu->supprimerMenu($conn);
            afficherMessageAvecCSS("Le fichier Image donner dépasse la limit de 5Mb\n\r Le Menu n'a pas été créée.");
        }


    }
}

?>

<div>
    <form method="post" action="ajouterMenu.php?action=ajouter" enctype="multipart/form-data">
    <div class="container pinkie">
        <h3 class="text-center">Créer un nouveau menu</h3>
        <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
        <input required type="text" class="form-control" id="staticEmail" name="nom_fr" placeholder="nom français" maxlength="50">
        <input required type="text" class="form-control" id="staticEmail" name="nom_en" placeholder="nom englais" maxlength="50">
        </div>
    </div>
    <br>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">description</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="description" name="description_fr" placeholder="description français">
            <input required type="text" class="form-control" id="description" name="description_en" placeholder="description anglais">
        </div>
    </div>
    <br>
    <div class="form-group row">
        <label for="prix" class="col-sm-2 col-form-label">prix</label>
        <div class="col-sm-10">
        <input required type="number" min="0" class="form-control" id="prix" name="prix" placeholder="Prix">
        </div>
    </div>
    <br>
    <div class="form-group row">
        <label for="img" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
        <input required type="file" class="form-control" id="img" name="img" accept="image/png, image/jpeg">
        </div>
    </div>

    <br>
    <br>
    <div class="text-center">   
            <input type="submit" name="submit" value="Créer">      
            <input type="reset" name="reset" value="Annuler">         
    </div>
</div>
    </form>
</div>
<?php
include("include/footAdmin.inc.php");
?>