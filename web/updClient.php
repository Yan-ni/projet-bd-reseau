<?php
    $titre="Hotel - Modification d'un client";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
    $id = $_GET['id'];
    if(str_starts_with($id, 'CL')) {
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

    }elseif(str_starts_with($id, 'EM')){
        $query = "SELECT * FROM personne INNER JOIN employe ON employe.id_emp = personne.id_personne WHERE id_personne='$id'";
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
        $startdate=$row[11];
        $enddate = $row[12];
        $typecont=$row[13];
        $emploi=$row[14];
    }

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
Date du recrutement: <input type="date" id="start" name="startdate" value="<?php echo $startdate;?>" min="1900-01-01" max="2024-12-31"><br>
Date de fin de l'emploi: <input type="date" id="start" name="enddate" value="<?php echo $enddate;?>" min="1900-01-01" max="2030-12-31"><br>
Type d'emploi: <input type="text" name="typecont" value="<?php echo $typecont;?>"><br>
Emploi: <input type="text" name="emploi" value="<?php echo $emploi;?>"><br>
Nombre de carte: <input type="text" name="nbcarte" value="<?php echo $nbcarte;?>"><br>

<input type="submit">
</form>

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
        if(!is_null($_GET['adr'])/* && is_string($_GET['adr'])*/){
            $comp++;
        }else{
            echo "<p>Mauvais format pour l'adresse</p>";
        }
    }
    if(isset($_GET['ville'])){
        if(ctype_alpha($_GET['ville']) /*&& is_string($_GET['ville'])*/){
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
    /*
    if($comp == 8){
        
        $id = "CL000000";
        $mdp = "BUr0n6uGmfjFxQ7xwkxANj8WKznQmGO2tJVwKxCfct22nvfLAwG0Tg4bNEQpymZ6";
        $nom = $_GET['nom'];
        $prenom =$_GET['prenom'];
        $email =$_GET['email'];
        $tel =$_GET['tel'];
        $bday =$_GET['bday'];
        $adr =$_GET['adr'];
        $ville =$_GET['ville'];
        $codepsot = $_GET['codepost'];
        $query = "INSERT INTO personne VAlUES('$id','$nom','$prenom','$bday','$email','$tel','$mdp','$adr','$ville','$codepsot')";
        $result = pg_query($dbconn, $query); 
        if (!$result) {
            echo "Une erreur s'est produite dans la table personne.\n";
        }
        $query = "INSERT INTO client VAlUES('$id','0')";
        $result = pg_query($dbconn, $query); 
        if (!$result) {
            echo "Une erreur s'est produite dans la table client.\n";
        }else{
            echo "<p>Ajout d'un client réussit.</p>";
        }
        
    }*/

?>

<?php
    include_once "./include/footer.inc.php";
?>