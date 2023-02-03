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

    if(verifItemPanier($conn,$panier)){
        echo "<h1>Votre Panier</h1>";
        $requete = "SELECT * from menu_fr,panier where menu_fr.idMenu = panier.noProduit;";
        afficherElementPanier($conn,$requete,$panier);
        echo calculerSommePanier($conn,$panier);
    }
    else{
        afficherMessageAucuneCommande();
    }
?>
 
 <?php 
 echo 
 "
 <br><div class='container'>
    <a href='panier.php?action=modifier' id='updatePanier'>Mettre a jour la commande</a>
 </div>";

 
 
 
 
 
 ?>
<?php
include("include/foot.inc.php");
?>