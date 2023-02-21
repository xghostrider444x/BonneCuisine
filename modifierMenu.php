<?php
session_start();
if(isset($_SESSION["usager"])){
    include("include/headAdmin.inc.php");
    include("librairie/fonctionAdmin.lib.php");
}
else{
   header("Location:index.php");
}

afficherModifierMenu();



include("include/footAdmin.inc.php");
?>