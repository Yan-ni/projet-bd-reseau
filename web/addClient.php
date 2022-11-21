<?php
    $titre="Hotel - Ajout de clients";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<form action="client.php" method="post">
Nom: <input type="text" name="nom"><br>
Prenom: <input type="text" name="prenom"><br>
E-mail: <input type="text" name="email"><br>
Telephone: <input type="text" name="tel"><br>
Date de naissance:<input type="date" id="start" name="bday" min="1900-01-01" max="2010-12-31"><br>
Adresse: <input type="text" name="adr"><br>
Ville: <input type="text" name="ville"><br>

<input type="submit">
</form>

<?php
    $nom = $_POST['nom'];
    $prenom =$_POST['prenom'];
    $email =$_POST['email'];
    $tel =$_POST['tel'];
    $bday =$_POST['bday'];
    $adr =$_POST['adr'];
    $ville =$_POST['ville'];
    $query = "INSERT INTO personne(nom,prenom,date_naissance,email,telephone,adresse,ville) VAlUES($nom,$prenom,$email,$bday,$adr,$ville)";

    $result = pg_query($query); 
?>

<?php
    include_once "./include/footer.inc.php";
?>