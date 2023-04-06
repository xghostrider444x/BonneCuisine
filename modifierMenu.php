<?php
session_start();
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
    include("librairie/fonctionAdmin.lib.php");
}
else{
   header("Location:index.php");
}
include("librairie/fonction.lib.php");
include("class/menuClass.php");
$conn;
connexion($conn);

afficherModifierMenu($conn);
echo "<br><br>";


include("include/footAdmin.inc.php");
?>