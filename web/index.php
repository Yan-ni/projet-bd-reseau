<?php
    $titre="Accueil";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<div>
    <h2 class="mt-5 mb-3">Bienvenue sur le site de gestion de l'hotel</h2>
    <?php 
    $id=$_SESSION["id_employe"];
    $query = "SELECT nom, prenom FROM personne WHERE id_personne ='$id' ";
    $tab = pg_query($dbconn, $query);
    $pers = pg_fetch_row($tab, null);
    ?>
    <p>Bienvenue <?php echo $pers[0]." ".$pers[1] ;?></p>
</div>

<?php
    include_once "./include/footer.inc.php";
?>