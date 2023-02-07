<?php
    include("include/head.inc.php");
    include("librairie/fonction.lib.php");
    $conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');

    if(isset($_COOKIE['panier'])){
        $panier = $_COOKIE["panier"]; 
        setcookie("panier", $panier, time()+3*60*60);
    }
    else{
        $panier = uniqid("exemple");
         setcookie("panier", $panier, time()+3*60*60); 
    }

    if(isset($_GET["id"])){
        if($_GET["action"] == "ajouter"){
            $idProduit = $_GET["id"];
            
            if(verifIfItemInPanier($conn,$panier,$idProduit)){
               
                AddTenToItemPanier($conn,$panier,$idProduit);
            }
            else{
                
                addItemToPanier($conn,$idProduit,$panier);
            }
            
        }
        if($_GET["action"] == "suprimer"){
            $idProduit = $_GET["id"];
            supprimerItemPanier($conn,$idProduit,$panier);
        }
    }

    if(isset($_GET["action"])){
        if($_GET["action"] == "modifier"){
            for( $i = 1; $i < 6; $i++){
            if(!empty($_POST["quantite$i"])){       
                   updatePanier($conn,$_POST["quantite$i"],$i,$panier);       
            }
        }
        }
        if($_GET["action"] == "envoyer"){

        }
    }

    if(verifItemPanier($conn,$panier)){
        echo "<h1 class='text-center'>Votre Panier</h1>";
        afficherElementPanier($conn,$panier);
    }
    else{
        afficherMessageAucuneCommande();
    }
?>
 
 <?php
 if(verifItemPanier($conn,$panier)){
    echo 
 "
 <br><div class='container'>
    <div>
        <input type='submit' value='mettre à jour la commande'/>
    </div>
 </div>
</form>";
calculerSommePanier($conn,$panier);
echo "
<form method='post' action='sendEmail.php?action='envoyer''></form>
 <div class='container text-center' id='menu'>
    <p>Merci de magasiner sur notre site. Il ne vous reste qu'a appuiyer sur le bouton pour confirmer la commande.</p>
    <input type='submit' value='envoyer la commande'>
 </div>

 ";
 };
 ?>
<?php
include("include/foot.inc.php");
?>