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
                if($_POST["quantite$i"] < 1){
                    echo "suprimer";
                    supprimerItemPanier($conn,$i,$panier);
                }
                else{
                   updatePanier($conn,$_POST["quantite$i"],$i,$panier); 
                }

                 
            }
            
        }
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
 if(verifItemPanier($conn,$panier)){
    echo 
 "
 <br><div class='container'>
    <input type='submit' value='mettre à jour la commande'/>
 </div>
 </form>";
 };
 

 
 
 
 
 
 ?>
<?php
include("include/foot.inc.php");
?>