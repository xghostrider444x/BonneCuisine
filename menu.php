<?php
    include("include/head.inc.php");
    include("librairie/fonction.lib.php");
    $conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
?>
<h2 class="titreMenu text-center">Nos Menu</h2>

<div >
    <?php 
        afficherMenu($conn);
        echo "<br><br>";
    ?>
</div>

<?php
include("include/foot.inc.php");
?>