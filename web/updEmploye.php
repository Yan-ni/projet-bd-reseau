<?php
    $titre="Hotel - Modification d'un client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
    $id = $_GET['id'];
    $query = "SELECT * FROM personne INNER JOIN employe ON employe.id_emp = personne.id_personne WHERE id_personne='$id'";
    $result = pg_query($dbconn, $query); 
    if (!$result) {
        echo "Une erreur s'est produite.\n";
    }else{

    $row = pg_fetch_row($result);

    $id = $row[0];
    $nom = $row[1];
    $prenom =$row[2];
    $email =$row[4];
    $tel =$row[5];
    $mdp = $row[6];
    $bday =$row[3];
    $adr =$row[7];
    $ville =$row[8];
    $codepsot = $row[9];
    $startdate=$row[11];
    $enddate = $row[12];
    $typecont=$row[13];
    $emploi=$row[14];

?>
<form action="addClient.php" method="get">
    Nom: <input type="text" name="nom" value="<?php echo $nom;?>"><br>
    Prenom: <input type="text" name="prenom" value="<?php echo $prenom;?>"><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>"><br>
    Telephone: <input type="text" name="tel" value=<?php echo $tel;?>><br>
    Date de naissance:<input type="date" id="start" name="bday" value="<?php echo $bday;?>" min="1900-01-01" max="2010-12-31"><br>
    Adresse: <input type="text" name="adr" value="<?php echo $adr;?>"><br>
    Ville: <input type="text" name="ville" value="<?php echo $ville;?>"><br>
    Code postal: <input type="text" name="codepost" value="<?php echo $codepsot;?>"><br>
    Emploi: <input type="text" name="emploi" value="<?php echo $emploi;?>"><br>
    Type d'emploi: <input type="text" name="typecont" value="<?php echo $typecont;?>"><br>
    Date du recrutement: <input type="date" id="start" name="startdate" value="<?php echo $startdate;?>" min="1900-01-01" max="2024-12-31"><br>
    Date de fin de l'emploi: <input type="date" id="start" name="enddate" value="<?php echo $enddate;?>" min="1900-01-01" max="2030-12-31"><br>

    <input type="submit" value="Update">
</form>


<?php
    }
?>

<?php
    include_once "./include/footer.inc.php";
?>