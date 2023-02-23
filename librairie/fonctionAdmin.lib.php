<?php 
function afficherMenuAdmin($conn){
    $requete = "SELECT * from menu_fr;";
        $resultat = $conn->query($requete);
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while($ligne = $resultat->fetch( ))
        {
            echo "<div class='container text-center' style='border:2px solid black; padding:10px; background-color: lightpink;'>
            <div class='row'>
                <div class='col'>
                    <img src='images/".$ligne->idMenu.".png'>
                </div>
                <div class='col'>
                    <ul style='list-style-type: none;'>
                        <li><b>Nom : </b>".$ligne->nom."</li>
                        <li><b>Description : </b>".$ligne->description."</li>
                        <li><b>Prix : </b>".$ligne->prix." $ CAD </li>
                    </ul>
                </div>
            </div>
        </div>
        "; 
        }
        $resultat->closeCursor( );
}

function afficherModifierMenu($conn){
    $requete = "SELECT * from menu_fr;";
        $resultat = $conn->query($requete);
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while($ligne = $resultat->fetch( ))
        {
            echo "<div class='container text-center' style='border:2px solid black; padding:10px; background-color: lightpink;'>
            <div class='row'>
                <div class='col'>
                    <img src='images/".$ligne->idMenu.".png'>
                </div>
                <div class='col'>
                    <ul style='list-style-type: none;'>
                        <li><b>Nom : </b>".$ligne->nom."</li>
                        <li><b>Description : </b>".$ligne->description."</li>
                        <li><b>Prix : </b>".$ligne->prix." $ CAD </li>
                    </ul>
                </div>
                <div class='col'>
                    <a href='modifierUnMenu.php?id=".$ligne->idMenu."' method'post'>Modifier le Menu</a>
                </div>
            </div>
        </div>
        "; 
        }
        $resultat->closeCursor( );

}

function afficherTableSupprimerMenu($conn){
    $requete = "SELECT * from menu_fr;";
        $resultat = $conn->query($requete);
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while($ligne = $resultat->fetch( )){
            echo "
                <tr>
                    <td><input type='checkbox' name='menu".$ligne->idMenu."'></td>
                    <td>$ligne->nom</td>
                    <td>$ligne->description</td>
                    <td>$ligne->prix $</td>
                </tr>
            ";
        }
}
?>