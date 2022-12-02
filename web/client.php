<?php
    $titre="Client";
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
<div class="px-5">
    <h2 class="mt-5 mb-3">Information clients</h2>
    <div class="client-add">
        <form action='addClient.php'>
            <button class="btn btn-primary" type="submit" name="submit"><span class=" fw-bold">+</span> Ajouter un client</button>
        </form>
    </div>
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
            <th>Nombre de carte</th>
            <th>Update</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
                <?php foreach ($line as $col_value) { ?>
                <td><?php echo $col_value ?></td>
                <?php } ?>

                <td class="client-update text-center">
                    <a href="updClient.php?id=<?php echo $line[0]; ?>">
                        <img style="width: 35px; height: 100%;" src="./assets/images/edit.png" alt="edit row">
                    </a>
                </td>
                <td class="personne-delete text-center">
                    <a href="suppPersonne.php?id=<?php echo $line[0]; ?>">
                        <img style="width: 35px; height: 100%;" src="./assets/images/delete.png" alt="delete row">
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php pg_free_result($result); ?>

    <?php
    $query = "SELECT id_client, nom, prenom, date_fidelite, points FROM personne INNER JOIN client ON client.id_client = personne.id_personne NATURAL JOIN fidelite";
    $result = pg_query($dbconn, $query);
    if (!$result) {
        echo "Une erreur s'est produite.\n";
        exit;
    } ?>
    <h2>Information fidélité</h2>
    <table class="table">
        <thead>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date fidélité</th>
            <th>Points fidélité</th>
        </thead>
        <tbody>
            <?php while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
                <?php foreach ($line as $col_value) { ?>
                <td><?php echo $col_value?></td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php pg_free_result($result); ?>

<?php
    include_once "./include/footer.inc.php";
?>