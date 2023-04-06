<?php
session_start();
if(isset($_SESSION['usager'])){
    include("include/headAdmin.inc.php");
    include("librairie/fonctionAdmin.lib.php");
}
else{
   header("Location:index.php");
}
$lang = "fr";
if(isset($_GET["lang"])){
    if($_GET["lang"]=="fr"){
        $lang = "fr";
    }
    if($_GET["lang"]=="en"){
        $lang = "en";
    }
}
include("librairie/fonction.lib.php");
include("class/menuClass.php");

$conn;
connexion($conn);

if(isset($_GET['id'])){
    if(isset($_GET["action"])){
        if($_GET["action"]=="modifier"){
            $menu = new Menu($_POST["nom"], $_POST["description"], $_POST["prix"], $_GET["id"]);
            if($menu->modifierMenu($conn,$lang)){
                afficherMessageAvecCSS("Les modification apportées au menu ont été sauvegarder avec succès");
            }
            else{
                afficherMessageAvecCSS("Le fichier image est tros volumineux les modification n'ont pas été apporter");
            }
            
        }

    }
    $requete = "SELECT * from menu_$lang where idMenu = ".$_GET['id']."";
    $resultat = $conn->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetch();
}
echo "
    <div class='container pinkie'>
        <div class='col text-center'>
            <h3 style='border:2px solid black'>Image du menu</h3>
            <img src='images/$ligne->idMenu.png' width='300px' height='160px'/>
        </div>
        <div>
        <div ><span class='text-right'><a href='?lang=fr&id=$ligne->idMenu'>Français </a>/ <a href='?lang=en&id=$ligne->idMenu'>English</a></span></div>
        </div>
        <div class='col'>
            <form method='post' action='modifierUnMenu.php?action=modifier&id=$ligne->idMenu&lang=$lang' enctype='multipart/form-data'>
                    <div class='container'>
                        <h3 class='text-center'>Modifier Caractéristique du menu</h3>
                        <div class='form-group row'>
                            <label for='staticEmail' class='col-sm-2 col-form-label'>Nom</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control' id='staticEmail' name='nom' value='$ligne->nom'>
                            </div>
                        </div>
                    <div class='form-group row'>
                        <label for='staticEmail' class='col-sm-2 col-form-label'>description</label>
                        <div class='col-sm-10'>
                        <input type='text' class='form-control' id='description' name='description' value='$ligne->description'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='inputPassword' class='col-sm-2 col-form-label'>prix</label>
                        <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputPassword' name='prix' value='$ligne->prix'>
                        </div>
                    </div>
                    <br>
                    <div class='form-group row'>
                        <label for='inputPassword' class='col-sm-2 col-form-label'>Image</label>
                        <div id='drop_file_zone'>
                        <div class='text-center'>
                            <p>Glisser et déposer ici</p>
                            <p>ou</p>
                            <p><input type='file' name='img' accept='image/png, image/jpeg'></p>
                        </div>
                    </div>

                    <br>
                    <br>
                    <div class='text-center'>   
                            <input type='submit' value='Modifier'>      
                            <input type='reset' name='reset' value='Annuler'>         
                    </div>
            </form>
        </div>
    </div>
</div>";
?>     
<script type="text/javascript">
const dropZone = document.getElementById('drop_file_zone');
const fileInput = document.getElementsByName('img')[0];

// Empêcher le comportement par défaut de la zone de dépôt
dropZone.addEventListener('dragover', function(e) {
  e.preventDefault();
});

// Récupérer le fichier déposé et le sélectionner dans l'input file
dropZone.addEventListener('drop', function(e) {
  e.preventDefault();

  // Récupérer le fichier déposé
  const file = e.dataTransfer.files[0];

  // Vérifier si le fichier est valide (par exemple, vérifier le type MIME ou l'extension)
  if (file.type !== 'image/jpeg' && file.type !== 'image/png') {
    alert('Le fichier doit être au format JPEG ou PNG.');
    return;
  }

  // Remplir l'input file avec le fichier sélectionné
  fileInput.files = e.dataTransfer.files;
});
</script> 
<?php
include("include/footAdmin.inc.php");
?>