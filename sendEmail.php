<?php 

include("include/head.inc.php");
include("librairie/fonction.lib.php");
$conn;
connexion($conn);

if(isset($_COOKIE['panier'])){
    $panier = $_COOKIE["panier"]; 
    setcookie("panier", $panier, time()+3*60*60);
}
else{
    $panier = uniqid("exemple");
     setcookie("panier", $panier, time()+3*60*60); 
}




if (isset($_GET["action"])){
    if($_GET["action"] == "envoyer"){
     if($_GET["courriel"] != null){
        $entete = "from:SugarCubeCorner@gmail.com";
     }
    }
}
$mail = $_GET["courriel"];
$checked = $_GET["livraison"];
$prixTotal = calculerSommePanier($conn,$panier,$checked);
$objet = iconv('utf-8','ISO-8859-1',"Reçu de commande");

$texte = "Bonjour, \r\nNous vous remercion d'avoir commandé via notre service de traiteur Bonne Cuisine.\r\nVoici la description de votre commande :\r\n\n";
$texte .= afficherElementPourCourriel($conn,$panier);
$texte .= "\r\n\nLe prix total de votre commande est de : $prixTotal $\r\n";

$texte .= "Un de nos employer va entrer en contact avec vous d'ici peut.";

$texte = iconv('utf-8','ISO-8859-1', $texte);
$texte = wordwrap($texte, 70, "\r\n",true);

if(mail($mail,$objet,$texte,$entete)){
    echo 
    "<h1 class='text-center'>Merci de votre achat</h1>
    <br><br>
    <div class='pinkie text-center'>
    <p>Votre commande a été passé avec succès</p>
    <p>Retourner a la page principale</p>
    <a href=index.php>Retourner à la page principale</a>
    </div>
    ";
    deletePanier($conn,$panier);
}

include("include/foot.inc.php");

?>
