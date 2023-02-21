<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="css/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <!-- JavaScript Bundle with Popper -->
    <script src="JavaScript/fonctionjs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <title>Bonne Cuisine</title>
</head>
<body id="body" style="background-image: url('images/Sugar_Cube_Corner.jpeg'); ">
<div class='position-sticky fixed-top'>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:lightgreen;" >
  <div class="container-fluid">
    <a class="navbar-brand nav-icon-menu" href="index.php">
    <img src="images/Knife.webp" style="width: 60px;">    
    <b>Bonne Cuisine</b>
    <img src="images/Knife.webp" style="width: 60px;"> 
    </a>
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" href="menu.php">Menu</a>
        <a class="nav-link active" href="ajouterMenu.php">Ajouter un Menu </a>
        <a class="nav-link active" href="#">Modifier un Menu</a>
        <a class="nav-link active" href="#">Supprimer un Menu</a>
        
      </div>
      
    </div>
      
    <div class="d-flex panierIcon">
      <a class="nav-link" href="panier.php"><img src="images/panierIcon.png" style="width:30px;">Panier<img src="images/panierIcon.png" style="width:30px;"></a>
    </div>
  </div>
</nav>
</div>

<div class="container-expand-lg d-flex justify-content-center food-images-container">
    <img src="images/FoodBanner.jpeg" class="foodImg object-fit-lg-contain border rounded">
    <img src="images/1.png" class="foodImg object-fit-lg-contain border rounded">
    <img src="images/2.png" class="foodImg object-fit-lg-contain border rounded">
    <img src="images/3.png" class="foodImg object-fit-lg-contain border rounded">
    <img src="images/4.png" class="foodImg object-fit-lg-contain border rounded">
</div>
</body>
</html>