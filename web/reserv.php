<?php
    $titre="Réservation";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$result = pg_query($dbconn, "SELECT id_client, nom, prenom, numero_res, numero_chmb, nombre_personnes,date_debut,date_fin, prix_ttc, paye FROM reservation NATURAL JOIN client INNER JOIN personne ON id_client = id_personne;");
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
}
?>
<div class="px-5">
    <h2 class="mt-5 mb-3">Réservations</h2>
    <table class="table table-hover">
        <thead>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Numéro de réservation</th>
            <th>Numéro de chambre</th>
            <th>Nombre de personne</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Prix</th>
            <th>Payé</th>
        </thead>
        <tbody>
        <?php while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
            <?php foreach ($line as $col_value) { 
                if (strcmp($col_value, "t") == 0) { ?>
                <td>
                    <span>
                        <img style="width: 35px; height: 100%;" src="./assets/images/success.png" alt="paid">
                    </span>
                </td>
                <?php } else if (strcmp($col_value, "f") == 0) { ?>
                <td>
                    <span>
                        <img style="width: 35px; height: 100%;" src="./assets/images/fail.png" alt="not paid">
                    </span>
                </td>
                <?php } else { ?>
                <td><?php echo $col_value ?></td>
            <?php }} ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php pg_free_result($result); ?>

<?php
    include_once "./include/footer.inc.php";
?>