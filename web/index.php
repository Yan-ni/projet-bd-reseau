<?php
    $titre="Accueil";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<div class="container-xl">
    <h2 class="mt-5 mb-3">Bienvenue sur le site de gestion de l'hotel</h2>
    <?php 
    $id = $_SESSION["id_employe"];
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    ?>
    <p>Bienvenue <?php echo $prenom." ".$nom; ?></p>
</div>

<?php
    include_once "./include/footer.inc.php";
?>