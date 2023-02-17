<?php 
include("librairie/fonction.lib.php");
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');

if(isset($_GET["action"])){
    if($_GET["action"] == "connexion"){
        $mp = $_POST["mp"];
        $couriel = $_POST["email"];
        if(verifUsager($conn,$couriel,$mp)){
            session_start();
            $_SESSION["usager"] = $couriel;
            header('Location:index.php');
        }
    }
    
}
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
}
else{
   include("include/head.inc.php");
}
?>

<div>
    <div class="container pinkie">
    <form method="post" action="connexion.php?action=connexion">
    
        <h3 class="text-center">Connexion</h3>
    
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