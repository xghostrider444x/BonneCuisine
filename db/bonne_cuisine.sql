create table if not exists client (
    idClient smallint Primary Key,
    nom    varchar(25),
    prenom varchar(25),
    courriel varchar(25),
    telephone varchar(10)
);

create table if not exists facture (
    idFacture       smallint primary Key,
    noClient        SMALLINT,
    dateLivraison   DATETIME,
    montant         FLOAT,
    commentaire     varchar(250),
    FOREIGN KEY (noClient) REFERENCES client(idClient)
);

create table if not exists commande (
    idCommande  SMALLINT NOT NULL,
    noFacture   SMALLINT,
    noMenu      SMALLINT NOT NULL,
    quantite    SMALLINT,
    PRIMARY KEY (idCommande,noMenu),
    FOREIGN KEY (noFacture) REFERENCES facture(idFacture)
);

create table if not exists usager (
    idUsager SMALLINT not null Primary Key,
    nom      varchar(45),
    motPasse   varchar(50),
    courriel varchar(50)
);

create table if not exists panier (
    idPanier    varchar(20) not null,
    noProduit   SMALLINT NOT NULL,
    quantite    SMALLINT,
    datePanier  DATETIME,
    PRIMARY KEY (idPanier,noProduit)
);
drop table if exists menu_fr;
create table if not exists menu_fr (
    idMenu          smallint AUTO_INCREMENT,
    nom             varchar(45),
    description     varchar(250),
    prix            float,
    FOREIGN KEY (idMenu) REFERENCES panier(noProduit) on UPDATE CASCADE on delete cascade
);
drop table if exists menu_en;
create table if not exists menu_en (
    idMenu  smallint AUTO_INCREMENT,
    nom     varchar(45),
    description     varchar(250),
    prix    float,
    FOREIGN KEY (idMenu) REFERENCES panier(noProduit) on UPDATE CASCADE on delete cascade
);

create table if not exists devise (
    idDevise    SMALLINT    not null    primary Key,
    dateDevise  DATE,
    taux        float
);


INSERT into panier (idPanier,noProduit,quantite,datePanier) VALUE ();
update panier set quantite = 10 where idProduit = 
