<?php
session_start();
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
}
else{
   header("Location:index.php");
}
include("librairie/fonctionAdmin.lib.php");
include("class/menuClass.php");
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');

if(isset($_GET["action"])){
    if($_GET["action"] == "supprimer"){
        $requete = "SELECT * from menu_fr;";
        $resultat = $conn->query($requete);
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while($ligne = $resultat->fetch( )){
            if(isChecked('menu',$ligne->idMenu)){
                
            }
        }
    }
}
?>
<div class="container pinkie">
<div class="text-center">
    <h3>Supprimer un menu</h3>
</div>
<form method="post" action="action=supprimer" >
    <table class="table table-bordered table-dark">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
        </tr>
    </thead>
    <tbody>
        <?php afficherTableSupprimerMenu($conn); ?>
    </tbody>
    </table>
    <div class="text-center">   
            <input type="submit" name="submit" value="Supprimer">      
            <input type="reset" name="reset" value="Annuler">         
    </div>
</form>
</div>