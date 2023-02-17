<?php
$conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
session_start();
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
   afficherMenu($conn);
}
?>
<div >
    <?php 
        echo "<br><br>";
    ?>
</div>
<?php
if(isset($_SESSION["usager"])){
    include("include/footAdmin.inc.php");
}
else{
   include("include/foot.inc.php");
}

?>