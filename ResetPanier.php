<?php 
 $conn = new PDO('mysql:host=localhost; dbname=Bonne_Cuisine; charset=utf8','root','infoMac420');
 $deleteRequest = "drop table panier";

 $result = $conn->exec($deleteRequest);

 $createRequest = "create table if not exists panier (
    idPanier    varchar(20) not null,
    noProduit   SMALLINT NOT NULL,
    quantite    SMALLINT,
    datePanier  DATETIME,
    PRIMARY KEY (idPanier,noProduit)
);";

 $result = $conn->exec($createRequest);
?>