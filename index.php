<?php

if(isset($_GET["action"])){
    if($_GET["action"] == "deconexion"){
        session_start();
        session_destroy();    
    }
}
session_start();
    if(isset($_SESSION["usager"])){
        include("include/headAdmin.inc.php");
    }
    else{
       include("include/head.inc.php");
    }
    
?>
<div class="container">
    <br>
    <div id="textBlock">
            <p>
                Bienvenue cher amateur de cuisine.
            </p>
            <p>
                Sur se site vous trouverer des informations sur la cuisine.
                Il vous sera possible aussi de passer des commandes et acheter du matériel de cuisine. 
            </p>
    </div>
</div>

<?php
if(isset($_SESSION["usager"])){
    include("include/footAdmin.inc.php");
}
else{
   include("include/foot.inc.php");
}
?>