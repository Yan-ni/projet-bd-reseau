<?php
    $titre="Hotel - Modification d'un client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
    $comp = 0;
    if(isset($_GET['nom'])){
        if (ctype_alpha($_GET['nom'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le nom</p>";
        }
    }
    if(isset($_GET['prenom'])){
        if(ctype_alpha($_GET['prenom'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le prenom</p>";
        }
    }
    if(isset($_GET['email'])){
        if(str_contains($_GET['email'],'@')){
            $comp++;
        }else{
            echo "<p>Mauvais format pour l'adrresse email</p>";
        }
    }
    if(isset($_GET['tel'])){
        if(is_numeric($_GET['tel'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le teléphone</p>";
        }
    }
    if(isset($_GET['bday']) ){
        if(is_string($_GET['bday'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour la date de naissance</p>";
        }
    }
    if(isset($_GET['adr'])){
        if(!empty($_GET['adr'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour l'adresse</p>";
        }
    }
    if(isset($_GET['ville'])){
        if(!empty($_GET['ville'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour la ville</p>";
        }
    }
    if(isset($_GET['codepost']) ){
        if(is_numeric($_GET['codepost'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le code postal</p>";
        }
    }
    if(isset($_GET['nbcarte']) ){
        if(is_numeric($_GET['nbcarte'])){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le nombre de carte</p>";
        }
    }
    if($comp == 9){
        $id = $_GET['id'];
        $nom = $_GET['nom'];
        $prenom =$_GET['prenom'];
        $email =$_GET['email'];
        $tel =$_GET['tel'];
        $bday =$_GET['bday'];
        $adr =$_GET['adr'];
        $ville =$_GET['ville'];
        $codepsot = $_GET['codepost'];
        $nbcarte = $_GET['nbcarte'];
        $query = "UPDATE personne SET nom='$nom', prenom='$prenom',date_naissance='$bday',email='$email',telephone='$tel',adresse='$adr',ville='$ville',code_postal='$codepsot' WHERE id_personne = '$id'";
        $result = pg_query($dbconn, $query); 
        if (!$result) {
            echo "Une erreur s'est produite dans la table personne.\n";
        }
        $query = "UPDATE client SET nombre_carte='$nbcarte' WHERE id_client='$id'";
        $result = pg_query($dbconn, $query); 
        if (!$result) {
            echo "Une erreur s'est produite dans la table client.\n";
        }else{
            echo "<p>Modification du client réussit.</p>";
        }
        
    }


    if(isset($_GET['id'])){
        $id = $_GET['id'];
       
            $query = "SELECT * FROM personne INNER JOIN client ON client.id_client = personne.id_personne WHERE id_personne='$id'";
            $result = pg_query($dbconn, $query); 
            if (!$result) {
                echo "Une erreur s'est produite.\n";
            }

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
            $nbcarte=$row[11];        

        ?>
        <div class="container">
            <h2 class="mt-5 mb-3">Modifier un client</h2>
            <form class="row g-3" action="updClient.php" method="get">
                <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">
                <div class="col-md-5">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom;?>">
                </div>
                <div class="col-md-5">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom;?>">
                </div>
                <div class="col-md-2">
                    <label for="nbcarte" class="form-label">Nombre de cartes</label>
                    <input type="text" class="form-control" name="nbcarte" value="<?php echo $nbcarte;?>">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
                <div class="col-md-4">
                    <label for="tel" class="form-label">Telephone</label>
                    <input type="tel" class="form-control" name="tel" value="<?php echo $tel;?>">
                </div>
                <div class="col-md-4">
                    <label for="bday" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" name="bday" value="<?php echo $bday;?>" min="1900-01-01" max="2010-12-31">
                </div>
                <div class="col-md-8">
                    <label for="adr" class="form-label">Address</label>
                    <input type="text" class="form-control" name="adr" value="<?php echo $adr;?>">
                </div>
                <div class="col-md-2">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" name="ville" value="<?php echo $ville;?>">
                </div>
                <div class="col-md-2">
                    <label for="codepost" class="form-label">Code postal</label>
                    <input type="text" class="form-control" name="codepost" value="<?php echo $codepsot;?>">
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Modifier">
                </div>
            </form>
        </div>

<?php

    }



?>

<?php
    include_once "./include/footer.inc.php";
?>