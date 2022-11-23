<?php
    $titre="Hotel - Ajout";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
    $nom = $_GET['nom'];
    echo $nom;
    $prenom =$_GET['prenom'];
    echo $prenom;
    $email =$_GET['email'];
    echo $email;
    $tel =$_GET['tel'];
    echo $tel;
    $bday =$_GET['bday'];
    echo $bday;
    $adr =$_GET['adr'];
    echo $adr;
    $ville =$_GET['ville'];
    echo $ville;
    $query = "INSERT INTO personne(nom,prenom,date_naissance,email,telephone,adresse,ville) VAlUES($nom,$prenom,$email,$bday,$adr,$ville)";
    if (pg_query($pgsql_conn,$query)){   
        echo "saved";
    }else{
        echo "error insering data";
    }
?>


<?php
    include_once "./include/footer.inc.php";
?>