<?php 
include("include/head.inc.php");
include("librairie/fonction.lib.php");
$conn;
connexion($conn);

if(isset($_GET["action"])){
    if($_GET["action"] == "ajouter"){
        $nom = $_POST["nom"];
        $mp = password_hash($_POST["mp"],PASSWORD_DEFAULT);
        $couriel = $_POST["email"];
        ajouterUtilisateur($conn,$nom,$couriel,$mp);
    }
}
?>

<div>
    
    <form method="post" action="ajouterUsager.php?action=ajouter">
    <div class="container pinkie">
        <h3 class="text-center">Créer un Utilisateur</h3>
        <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="staticEmail" name="nom" placeholder="nom">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="staticEmail" name="email" placeholder="Email@gmail.com">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword" name="mp" placeholder="Password">
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
include("include/foot.inc.php");
?>