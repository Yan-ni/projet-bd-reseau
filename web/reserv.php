<?php
    $titre="Hotel - Réservation";
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
<table>
    <tr>
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
    </tr>
    <?php
    while ($line = pg_fetch_row($result, null)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        /*?>
        <td class="contact-delete">
            <form action='suppPersonne.php?name="<?php echo $line[0]; ?>"' method="post">
                <input type="hidden" name="id" value="<?php echo $line[0]; ?>">
                <input type="submit" name="submit" value="Delete">
            </form>
        </td>
        <?php*/
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    pg_free_result($result);

?>

<?php
    include_once "./include/footer.inc.php";
?>