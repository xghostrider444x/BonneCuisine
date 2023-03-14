<?php
session_start();   
if(isset($_GET["action"])){
    if($_GET["action"] == "deconexion"){
        session_start();
        session_destroy();    
    }
}
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

$file_contents = file_get_contents('lang/'.$lang.'.json');

$data = json_decode($file_contents,true);

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
                <?php echo $data["index-presentation-1"] ?>
            </p>
            <p>
                <?php echo $data["index-presentation-2"] ?>
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