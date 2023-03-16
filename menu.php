<?php
session_start();
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');

$key = "Delxwxim1EX2LrlUvOq8QScd4NyYe2ZTuLc56AvR";

$ch = curl_init('https://api.currencyapi.com/v3/latest?apikey='.$key.'&currencies=EUR%2CUSD%2CCAD');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

$json = curl_exec($ch);
curl_close($ch);

$exchangeRates = json_decode($json, true);

$lang = "fr";
if(isset($_GET["lang"])){
    if($_GET["lang"] == "fr"){
        $lang = "fr";
    }
    elseif($_GET["lang"] == "en"){
        $lang = "en";
    }
}
if(isset($_COOKIE['lang'])){
    setcookie("lang", $lang, time()+365*24*60*60);
}
else{
    setcookie("lang", $lang, time()+365*24*60*60);
}

$file_contents = file_get_contents("lang/".$lang.".json");

$data = json_decode($file_contents,true);
if(isset($_SESSION["usager"])){
    include("librairie/fonctionAdmin.lib.php");
    include("include/headAdmin.inc.php");
    echo "<h2 class='titreMenu text-center'>Nos Menu</h2>";
    afficherMenuAdmin($conn);
}
else{
    include("librairie/fonction.lib.php");
   include("include/head.inc.php");
   echo "<h2 class='titreMenu text-center'>Nos Menu</h2>";
   afficherMenu($conn,$lang,$data["type-argent"],$exchangeRates);
}
?>
   <br><br>
<?php
if(isset($_SESSION["usager"])){
    include("include/footAdmin.inc.php");
}
else{
   include("include/foot.inc.php");
}

?>