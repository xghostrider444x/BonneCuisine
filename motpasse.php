<?php
include("librairie/fonction.lib.php");
    include("include/head.inc.php");
    $conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
    if(isset($_GET['action'])){
        if($_GET['action'] == 'resetPassword'){
            if($_POST['newMP'] == $_POST['newMPC']){
                resetPassword($conn,$_GET['id'],$_POST['newMP']);
                header("Location: index.php");
            }
            else{
                echo "
                <div class='pinkie text-center'>
                    <h4>LE nouveau mot de passe est différent dans les deux champs.</h4>
                </div>";
            }
            
        }
    }
    else{
    
    $oldNo = $_GET['no'];
    $newNo = floor(microtime(true) * 1000);
    if(($newNo - $oldNo) > 300000){
        header("location:index.php");
    } 
    }
?>
<?php $id = $_GET['id'];
echo"
<div class='container'>
    <div class='pinkie'>
        <form method='post' action='motpasse.php?action=resetPassword&id=".$id."'>
            <div class='row'>
                <label>Inscrire nouveau mot de passe :</label>
                <input type='text' name='newMP'>
            </div>
            <div class='row'>
                <label>Réinscrire Nouveau mot de passe :</label>
                <input type='text' name='newMPC'>
            </div>
            <br>
            <br>
            <div class='text-center'>
                <input type='submit'>
            </div>
        </form>
    </div>

</div>";
?>

<?php
    include("include/foot.inc.php");
?>