<?php
session_start();
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
        echo "
        <h1 class='text-center'>Votre Panier</h1>";
        afficherElementPanier($conn,$panier);
    }
    else{
        afficherMessageAucuneCommande();
    }
?>
 
 <?php
 
 if(verifItemPanier($conn,$panier)){
    $checked = (isset($_REQUEST['chk'])) ? 'checked' : '';
    echo 
 "
    <form name='panier' method='post' action='panier.php?action=modifier'>
        <br><div class='container'>
        <div>
            <input type='submit' value='mettre à jour la commande'/>
        </div>
        <div>
            <input type='checkbox' id='chk' ".$checked."> <label> 15$ Livraison</label>
        </div>
    </form>";
    

$prixTotal = calculerSommePanier($conn,$panier,$checked);

echo "
        <div class='container prixPanier' id='menu' >
            <h3>Le total de votre panier est de : ".$prixTotal." $</h3>
        </div>";
echo "

 <form name='confirmation' method='post' >
 <div class='container text-center' id='menu'>
    <p>Merci de magasiner sur notre site. Il ne vous reste qu'a appuiyer sur le bouton pour confirmer la commande.</p>
    <input type='submit' value='envoyer la commande' onclick=getEmail()></input>
 </div>
</form>

 ";
 };
 ?>
 
<?php
if(isset($_SESSION["usager"])){
    include("include/footAdmin.inc.php");
}
else{
   include("include/foot.inc.php");
}
?>