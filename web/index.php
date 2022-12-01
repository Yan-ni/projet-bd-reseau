<?php
    $titre="Accueil";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<pre>
    <?php print_r($_SESSION["id_employe"]); ?>
</pre>

<?php
    include_once "./include/footer.inc.php";
?>