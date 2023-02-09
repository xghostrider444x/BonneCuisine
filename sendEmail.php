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




if (isset($_GET["action"])){
    if($_GET["action"] == "envoyer"){
     if($_GET["courriel"] != null){
        $entete = "from:".$_GET["courriel"]."";
     }
    }
}
$mail = "202130878@collegealma.ca";

$prixTotal = calculerSommePanier($conn,$panier);
$objet = "Reçu de commande";
$texte= "
<p>Bonjour</p>
<br><br>
<p>Nous vous remercion d'avoir commandé via notre service de traiteur Bonne Cuisine.</p>
<br>
<p>Voici la description de votre commande</p>
<div>
<br><br>


<p>Le prix total de votre commande est de : ".$prixTotal."$</p>
</div>
<div>
<p>Un de nos employer va entrer en contact avec vous d'ici peut.</p>
</div>
";


if(mail($mail,$objet,$texte,$entete)){
    echo "$prenom le couriel est bien transmis";
}






include("include/foot.inc.php");

?>
