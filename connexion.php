<?php 
include("librairie/fonction.lib.php");
$conn;
connexion($conn);
session_start();
$lang = "fr";
$file_contents = file_get_contents('lang/'.$lang.'.json');
$data = json_decode($file_contents,true);
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
}
else{
   include("include/head.inc.php");
}


if(isset($_GET["action"])){
    if($_GET["action"] == "connexion"){
        $mp = $_POST["mp"];
        $couriel = $_POST["email"];
        if(verifUsager($conn,$couriel,$mp)){
            $_SESSION["usager"] = $couriel;
            header('Location:index.php');
        }
        else{
            echo "
            <div class='container'>
                <div class='pinkie'>
                    <h3>Le mot de passe ou l'adresse courriel est invalide</h3>
                </div>
            
            </div>";
        }
    }
    
}

?>

<div>
    <div class="container pinkie">
    <form method="post" action="connexion.php?action=connexion">
    
        <h3 class="text-center">Connexion</h3>
    
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="staticEmail" name="email" placeholder="Email@gmail.com" Max="50">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword" name="mp" placeholder="Password" Max="50">
            </div>
        </div>
        <br>
        <br>
        <div class="text-center">   
                <input type="submit" name="submit" value="Connexion">      
                <input type="reset" name="reset" value="Annuler">         
        </div> 
        </form>
        <form method="post" name='lostPassword'>
            <div class="text-center">
                <input type="submit" onclick="getEmailForPassword()" value="Mot de passe oublier"></input>
            </div>
        </form>
    </div>
   
</div>

<?php
include("include/foot.inc.php");
?>