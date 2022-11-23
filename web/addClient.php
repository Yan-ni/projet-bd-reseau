<?php
    $titre="Hotel - Ajout de clients";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<form action="addClient.php" method="get">
Nom: <input type="text" name="nom"><br>
Prenom: <input type="text" name="prenom"><br>
E-mail: <input type="text" name="email"><br>
Telephone: <input type="text" name="tel"><br>
Date de naissance:<input type="date" id="start" name="bday" min="1900-01-01" max="2010-12-31"><br>
Adresse: <input type="text" name="adr"><br>
Ville: <input type="text" name="ville"><br>
Code postal: <input type="text" name="codepost"><br>

<input type="submit">
</form>

<?php
    if(isset($_GET['nom']) && is_string($_GET['nom'])){
        echo "<p>isset nom</p>";
    }
    if(isset($_GET['prenom']) && is_string($_GET['prenom'])){
        echo "<p>isset prenom</p>";
    }
    if(isset($_GET['email']) && is_string($_GET['email']) && str_contains($_GET['email'],'@')){
        echo "<p>isset email</p>";
    }
    if(isset($_GET['tel']) && is_numeric($_GET['tel'])){
        echo "<p>isset tel</p>";
    }
    if(isset($_GET['bday']) && is_string($_GET['bday'])){
        echo "<p>isset bday</p>";
    }
    if(isset($_GET['adr']) && is_string($_GET['adr'])){
        echo "<p>isset adr</p>";
    }
    if(isset($_GET['ville']) && is_string($_GET['ville'])){
        echo "<p>isset ville</p>";
    }
    if(isset($_GET['codepost']) && is_numeric($_GET['codepost'])){
        echo "<p>isset code postal</p>";
    }

         /*
        $nom = $_GET['nom'];
        $prenom =$_GET['prenom'];
        $email =$_GET['email'];
        $tel =$_GET['tel'];
        $bday =$_GET['bday'];
        $adr =$_GET['adr'];
        $ville =$_GET['ville'];
        //$query = "INSERT INTO personne(nom,prenom,date_naissance,email,telephone,adresse,ville) VAlUES($nom,$prenom,$email,$bday,$adr,$ville)";
        echo "<p>isset</p>";
        //$result = pg_query($query); 
*/
?>

<?php
    include_once "./include/footer.inc.php";
?>