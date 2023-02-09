<?php 

function connection($bd){
    $bd = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
    return $bd;
}
//---------------------------------------------------------------------------------------------------------------------------//


// -------- Cette section comporte les fonction qui servira a effectuer des modification sur la table panier. ------- //
// Fonction qui ajoute un élément a la table panier.
function addItemToPanier($conn,$idProduit,$panier){
    $date = date("'d-m-y h:i:s'");
    $insertRequest = "INSERT into panier (idPanier,noProduit,quantite,datePanier) VALUE ('$panier',$idProduit,10,$date);";
    $result = $conn->exec($insertRequest);
}
//---------------------------------------------------------------------------------------------------------------------------//

// Fonction qui ajoute 10 a la quantité de personne si l'élément existe deja dans le panier.
function addTenToItemPanier($conn,$panier,$idProduit){
    $requete = "select * from panier where noProduit = $idProduit and idPanier = '$panier'";
    $resultat = $conn->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $ligne = $resultat->fetch();
    $request = "update panier set quantite =($ligne->quantite + 10)  where noProduit = $idProduit";
    $result = $conn->exec($request);
}

// Fonction qui supprime un élément du panier d'achat.
function supprimerItemPanier($conn,$idProduit,$panier){
    $requete = "DELETE from panier where noProduit = $idProduit and idPanier ='$panier'";
    $result = $conn->exec($requete);
}

function updatePanier($conn,$quantite,$id,$panier){
    if($quantite == null){
        supprimerItemPanier($conn,$id,$panier);
    }
    else{
        $requete = "UPDATE Panier set quantite = $quantite where idPanier = '$panier' and noProduit = $id";
        $resultat = $conn->exec($requete);
    }
    }
    
//---------------------------------------------------------------------------------------------------------------------------//

// ------- Cette section contient les fonction qui effectue des vérification sur des éléments des tables. ------ //à

// Cette fonction vérifie si il y a un exemplaire du produit ajouter dans le panier.
function verifIfItemInPanier($conn,$panier,$idProduit){
    $requete = "SELECT * from panier where idPanier = '$panier' and noProduit = $idProduit;";
    $resultat = $conn->query($requete);
    $ammount = $resultat->fetchAll();
    if(count($ammount) == 0 ){
        return false;
    }
    else{
        return true;
    }
}
// Fonction qui vérifie si un ou plusieur produit est dans le panier.
function verifItemPanier($conn,$panier){
    $requete = "SELECT * from panier where idPanier = '$panier';";
    $resultat = $conn->query($requete);
    $ammount = $resultat->fetchAll();
    if(count($ammount) == 0 ){
        return false;
    }
    else{
        return true;
    }
}

// ------ Cette section comporte les fonctions qui font de l'affichage a l'écran ------- //
function afficherElementPanier($conn,$panier){
    $requete = "SELECT * from menu_fr,panier where menu_fr.idMenu = panier.noProduit;";
    $resultat = $conn->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    echo "<form method='post' action='panier.php?action=modifier'>";
    while($ligne = $resultat->fetch())
        { 
            if($ligne->idPanier == $panier){
                $idMenu = $ligne->idMenu;
                echo "
            <div>
            <br>
                <div class='container' id='menu'>
                    <div class='col'>
                    <p><b>Menu :</b>".$ligne->nom."</p>
                    <p>Nombre de personnes : <input name='quantite$idMenu' id='amount$idMenu' type='number' value='".$ligne->quantite."'/></p>      
                    <a href='panier.php?action=suprimer&id=$idMenu'>Suprimer ce menu</a>
                    </div>
                </div>
            </div>";
            }
            
        }
    
}

// Cette fonction affiche un message si aucune commande n'est dans le panier.
function afficherMessageAucuneCommande(){
    echo 
    "<div class='container text-center'>
        <div id='menu' class='fixed-center;'>
        <p style='font-size: 30px'>Vous n'avez aucune commande dans votre panier</p>
        </div>
    </div>";
}

// Cette fonction affiche le menu des élément pouvant être commander. 
function afficherMenu($conn){
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
                    <a href='panier.php?action=ajouter&id=".$ligne->idMenu."' method'post'>Ajouter à la commande ...</a>
                </div>
            </div>
        </div>
        "; 
        }
        $resultat->closeCursor( );
}

function calculerSommePanier($conn,$panier){
    $requete = "SELECT noProduit, quantite, prix  from panier,menu_fr where panier.noProduit = menu_fr.idMenu and idPanier = '$panier' order by noProduit ";
    $total = 0;
    foreach($conn->query($requete) as $row){
        $taxe = 1.1485;
        $totalParProduit = ($row['quantite'] * $row['prix'] ) * $taxe;
        $total = $total + $totalParProduit;
    }
    

    return $total;

}

function afficherElementPourCourriel($conn,$panier){
    $requete = "SELECT * from menu_fr,panier where menu_fr.idMenu = panier.noProduit and idPanier = '$panier';";
    $resultat = $conn->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $texteFinal = "";
    while($ligne = $resultat->fetch())
        { 
            if($ligne->idPanier == $panier){
             $texte = "Menu : $ligne->nom  \r\n Nombre de personnes : $ligne->quantite \r\n\n\n";
                $texteFinal = "$texteFinal  $texte";
            } 
        }
        return $texteFinal;
}


?>
