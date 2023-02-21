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
        $newMenu = new menuclass($_POST["nom"],$_POST["description"],$_POST["prix"]);
        $newMenu->ajouterMenu($conn);
        $file = $_POST["img"];
        $newMenu->ajouterImage($file);
    }
}

?>

<div>
    <form method="post" action="ajouterMenu.php?action=ajouter">
    <div class="container pinkie">
        <h3 class="text-center">Créer un nouveau menu</h3>
        <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="staticEmail" name="nom" placeholder="nom">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">description</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="description" name="description" placeholder="description">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">prix</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPassword" name="prix" placeholder="Prix">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
        <input type="file" class="form-control" id="inputPassword" name="img" accept="image/png, image/jpeg">
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