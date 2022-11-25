<?php
    $titre="Tâche";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$query = "SELECT * FROM tache";
$result = pg_query($dbconn, $query);
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
} ?>
<div class="px-5">
    <h2>Information tâches</h2>
    <table class="table table-hover">
        <thead>
            <th>Identifiant</th>
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