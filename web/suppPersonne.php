<?php
    $titre="Hotel - Suppression personne";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php

$id = $_GET['id'];
/*if(str_starts_with($id, 'EM')) {*/

    /*** Suprression d'un employé ***/
   /* echo "<p>Suppression d'un employé</p>";

    $query = "DELETE FROM employe_tache WHERE id_emp= '$id'";
    $result = pg_query($dbconn, $query);
    if ($result) {
        echo "<p>Suppression dans la table employe_tache reussie.</p>\n";

    }else{
        echo "<p>Echec de la supression dans la table employe_tache reussie..</p>\n";
    }

    $query = "DELETE FROM employe WHERE id_emp= '$id'";
}
elseif(str_starts_with($id, 'CL')){*/

    /*** Suprression d'un client ***/
    /*echo "<p>Suppression d'un client</p>";

    $query = "DELETE FROM fidelite WHERE id_client= '$id'";
    $result = pg_query($dbconn, $query);
    if ($result) {
        echo "<p>Suppression dans la table fidelite reussie.</p>\n";

    }else{
        echo "<p>Echec de la supression dans la table fidelite reussie..</p>\n";
    }

    $query = "DELETE FROM reservation WHERE id_client= '$id'";
    $result = pg_query($dbconn, $query);
    if ($result) {
        echo "<p>Suppression dans la table reservation reussie.</p>\n";

    }else{
        echo "<p>Echec de la supression dans la table reservation reussie..</p>\n";
    }

    $query = "DELETE FROM client_activite WHERE id_client= '$id'";
    $result = pg_query($dbconn, $query);
    if ($result) {
        echo "<p>Suppression dans la table client_activite reussie.</p>\n";

    }else{
        echo "<p>Echec de la supression dans la table client_activite reussie..</p>\n";
    }

    $query = "DELETE FROM client WHERE id_client= '$id'";
}
$query2 = "DELETE FROM personne_carte WHERE id_personne= '$id'";
$result2 = pg_query($dbconn, $query2);
if ($result) {
    echo "<p>Suppression dans la table personne_carte reussie.</p>\n";

}else{
    echo "<p>Echec de la supression dans la table personne_carte.</p>\n";
}

$result = pg_query($dbconn, $query);

if ($result) {
    echo "<p>Suppression dans la table employe/client reussie.</p>\n";

}else{
    echo "<p>Echec de la supression dans la table employe/client.</p>\n";
}*/
$query = "DELETE FROM personne WHERE id_personne= '$id'";
$result = pg_query($dbconn, $query);
if ($result) {
    echo "<p>Suppression dans la table personne reussie.</p>\n";

}else{
    echo "<p>Echec de la supression dans la table personne reussie..</p>\n";
}
?>

<?php
    include_once "./include/footer.inc.php";
?>