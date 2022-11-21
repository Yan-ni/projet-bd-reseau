<?php
    $titre="Hotel - Employé";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$result = pg_query($dbconn, "SELECT * FROM employe");
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
}

echo "<table>\n";
    while ($line = pg_fetch_array($result, null)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "<td>";
            echo "<form action='function.php' method='get'>";
            echo "<input type='submit'>";
            echo "</form>";
        echo "<td>";
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    pg_free_result($result);

?>

<?php
    include_once "./include/footer.inc.php";
?>