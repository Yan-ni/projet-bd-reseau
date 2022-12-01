<?php
    $titre="Hotel - Modification d'un client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<h2>Modification d'un client</h2>
<?php
    $comp = 0;
    if(isset($_GET['nom'])){
        if (ctype_alpha($_GET['nom']) /*&& is_string($_GET['nom'])*/){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le nom</p>";
        }
    }
    if(isset($_GET['prenom'])){
        if(ctype_alpha($_GET['prenom']) /*&& is_string($_GET['prenom'])*/){
            $comp++;
        }else{
            echo "<p>Mauvais format pour le prenom</p>";
        }
    }
    if(isset($_GET['email'])){
        if(/*is_string($_GET['email']) && */str_contains($_GET['email'],'@')){
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
        if(!empty($_GET['adr'])/* && is_string($_GET['adr'])*/){
            $comp++;
        }else{
            echo "<p>Mauvais format pour l'adresse</p>";
        }
    }
    if(isset($_GET['ville'])){
        if(!empty($_GET['ville']) /*&& is_string($_GET['ville'])*/){
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
        /*if(str_starts_with($id, 'CL')) {*/
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
        <form action="updClient.php" method="get">
            Nom: <input type="text" name="nom" value="<?php echo $nom;?>"><br>
            Prenom: <input type="text" name="prenom" value="<?php echo $prenom;?>"><br>
            E-mail: <input type="text" name="email" value="<?php echo $email;?>"><br>
            Telephone: <input type="text" name="tel" value=<?php echo $tel;?>><br>
            Date de naissance:<input type="date" id="start" name="bday" value="<?php echo $bday;?>" min="1900-01-01" max="2010-12-31"><br>
            Adresse: <input type="text" name="adr" value="<?php echo $adr;?>"><br>
            Ville: <input type="text" name="ville" value="<?php echo $ville;?>"><br>
            Code postal: <input type="text" name="codepost" value="<?php echo $codepsot;?>"><br>
            Nombre de carte: <input type="text" name="nbcarte" value="<?php echo $nbcarte;?>"><br>
            <input type="hidden" name="id" value="<?php echo $id;?>"><br>

            <input type="submit" value="Update">
        </form>

<?php

    }



?>

<?php
    include_once "./include/footer.inc.php";
?>