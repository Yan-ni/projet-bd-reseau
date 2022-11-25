<?php
    $titre="Employé";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
$result = pg_query($dbconn, "SELECT id_emp, nom, prenom, date_naissance, email, telephone, adresse, ville, code_postal, emploi, type_contrat, date_debut_emploi, date_fin_emploi FROM employe INNER JOIN personne ON id_emp = id_personne");
if (!$result) {
    echo "Une erreur s'est produite.\n";
    exit;
} ?>
<div class="px-5">
    <h2 class="mt-5 mb-3">Information employés</h2>
    <table class="table table-hover">
        <thead>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date de naissance</th>
            <th>eMail</th>
            <th>Telephone</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code postal</th>
            <th>Emploi</th>
            <th>Type de contrat</th>
            <th>Date du début du contrat</th>
            <th>Date de fin du contrat (si CDD)</th>
            <th>update</th>
            <th>delete</th>
        </thead>
        <tbody>
        <?php while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
            <?php foreach ($line as $col_value) { ?>
                <td><?php echo $col_value ?></td>
            <?php } ?>
            <td class="employee-update text-center">
                    <a href="updEmploye.php?id=<?php echo $line[0]; ?>">
                        <img style="width: 35px; height: 100%;" src="./assets/images/edit.png" alt="edit row">
                    </a>
                </td>
                <td class="contact-delete text-center">
                    <a href="suppPersonne.php?id=<?php echo $line[0]; ?>">
                        <img style="width: 35px; height: 100%;" src="./assets/images/delete.png" alt="delete row">
                    </a>
                </td>
            <?php
            echo "\t</tr>\n";
        }
        echo "</table>\n";

        pg_free_result($result);

    ?>
</div>

<?php
    include_once "./include/footer.inc.php";
?>