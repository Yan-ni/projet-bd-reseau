<?php
    $titre="Hotel - Client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$query = "SELECT * FROM tache";
$result = pg_query($dbconn, $query);
if ($result) {
    ?>
    <h2>Information tâches:</h2>
    <table>
        <tr>
            <th>Identifiant</th>
            <th>Tache a réaliser</th>
            <th>Date et heure début</th>
            <th>Date et heure fin</th>
            <th>Commentaire</th>
            <th>Statut</th>
        </tr>
        <?php
        while ($line = pg_fetch_row($result, null)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            
            echo "\t</tr>\n";
        }
        echo "</table>\n";

        pg_free_result($result);
    }
?>

<?php
    include_once "./include/footer.inc.php";
?>