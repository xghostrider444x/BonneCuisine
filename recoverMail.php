<?php 
include("librairie/fonction.lib.php");
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
$milliseconds = floor(microtime(true) * 1000);
if (isset($_GET["action"])){
    if($_GET["action"] == "sendRecoverEmail"){
     if($_GET["courriel"] != null){
        $entete = "from:SugarCubeCorner@gmail.com";
     }
    }
}
$mail = $_GET["courriel"];
if(!verifMail($conn,$mail)){
    include("include/head.inc.php");
    echo "
    <div class='container'>
        <div class='pinkie'>
            <h3>Le courriel que vous avez entré est invalide</h3>
        </div>
    </div>";
    include("include/foot.inc.php");
}
else{
$cryptedId = getCryptedId($conn,$mail);
$objet = iconv('utf-8','ISO-8859-1',"Réinitialisé votre mot de passe");

$texte = "Bonjour, \r\n";
$texte .= "Vous avez fait une demande pour réinitialiser votre mot de passe. Pour se faire, cliker sur le lien suivant\r\n";
$texte .= "http:".$_SERVER['HTTP_HOST'].dirname[$_SERVER['REQUEST_URL']]."/motpasse.php?no=$milliseconds&id=$cryptedId \r\n\n";

$texte .= "Attention, ce lien n'est valide que pour les 5 prochaine minutes. Dépassez ce délai, vous devrez faire une nouvelle demande \r\n\n";
$texte .= "Meilleur salutation de la par de l'équipe du Sugar Cube Corner. ";

$texte = iconv('utf-8','ISO-8859-1', $texte);
$texte = wordwrap($texte, 150, "\r\n",true);

if(mail($mail,$objet,$texte,$entete)){
    include("include/head.inc.php");
    echo 
    "<h1 class='text-center'>Merci de votre achat</h1>
    <br><br>
    <div class='pinkie text-center'>
    <p>Un courriel vous a été envoyer dans votre boite mail.</p>

    <p>Retourner a la page principale</p>
    <a href=index.php>Retourner à la page principale</a>
    </div>
    
    ";
    include("include/foot.inc.php");
}
}

?>
