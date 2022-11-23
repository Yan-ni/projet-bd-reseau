<?php
    $titre="Hotel - Client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$result = pg_query($dbconn, "SELECT id_client, nom, prenom, date_naissance, email, telephone, adresse, ville, code_postal, nombre_carte FROM client INNER JOIN personne ON id_client = id_personne");
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
        <th>Date de naissance</th>
        <th>eMail</th>
        <th>Telephone</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Code postal</th>
        <th>Nombre de carte en posséssion</th>
    </tr>
    <?php
    while ($line = pg_fetch_row($result, null)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        ?>
        <td class="contact-delete">
            <form action='suppPersonne.php?name="<?php echo $line[0]; ?>"' method="post">
                <input type="hidden" name="id" value="<?php echo $line[0]; ?>">
                <input type="submit" name="submit" value="Delete">
            </form>
        </td>
        <?php
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    pg_free_result($result);

?>

<?php
    include_once "./include/footer.inc.php";
?>