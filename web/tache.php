<?php
    $titre="Tâche";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$query = "SELECT personne.nom, personne.prenom, tache.description, tache.date_heure_début, tache.date_heure_fin, tache.commentaire, tache.realise FROM tache NATURAL JOIN employe_tache INNER JOIN personne ON personne.id_personne = employe_tache.id_emp";
$result = pg_query($dbconn, $query);
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
} ?>
<div class="px-5">
    <h2>Information tâches</h2>
    <div class="tache-add">
        <form action='addTache.php'>
            <button class="btn btn-primary" type="submit" name="submit"><span class=" fw-bold">+</span> Ajouter une tache</button>
        </form>
    </div>
    <table class="table table-hover">
        <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Tache a réaliser</th>
            <th>Date et heure début</th>
            <th>Date et heure fin</th>
            <th>Commentaire</th>
            <th>Statut</th>
        </thead>
        <tbody>
        <?php while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
            <?php foreach ($line as $col_value) { 
                if(strcmp($col_value, "t") == 0) { ?>
                <td>
                    <img style="width: 35px; height: 100%;" src="./assets/images/success.png" alt="done">
                </td>
                <?php } else if (strcmp($col_value, "f") == 0) { ?>
                <td>
                    <img style="width: 35px; height: 100%;" src="./assets/images/fail.png" alt="not done">
                </td>
                <?php } else { ?>
                <td><?php echo $col_value ?></td>
            <?php }} ?>
            </tr>
        <?php } ?>
    </table>
</div>
<?php pg_free_result($result); ?>

<?php
    include_once "./include/footer.inc.php";
?>