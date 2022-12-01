<?php
    $titre="Ajout de clients";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<div class="container">
    <h2 class="mt-5 mb-3">Ajouter un client</h2>
    <form class="row g-3" action="addClient.php" method="get">
        <input type="hidden" class="form-control" name="id">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control" name="prenom">
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="col-md-4">
            <label for="tel" class="form-label">Telephone</label>
            <input type="tel" class="form-control" name="tel">
        </div>
        <div class="col-md-4">
            <label for="bday" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" name="bday" min="1900-01-01" max="2010-12-31">
        </div>
        <div class="col-md-8">
            <label for="adr" class="form-label">Address</label>
            <input type="text" class="form-control" name="adr">
        </div>
        <div class="col-md-2">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville">
        </div>
        <div class="col-md-2">
            <label for="codepost" class="form-label">Code postal</label>
            <input type="text" class="form-control" name="codepost">
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </div>
    </form>
</div>

<?php

        $pers = 'CL';
        if(str_starts_with($pers,'CL')){
                $query = "SELECT id_personne FROM personne WHERE id_personne LIKE 'CL%' ORDER BY id_personne DESC LIMIT 1";
        }
        if(str_starts_with($pers,'EM')){
                $query = "SELECT id_personne FROM personne WHERE id_personne LIKE 'EM%' ORDER BY id_personne DESC LIMIT 1";
        }
        $result = pg_query($dbconn, $query); 
        if(!$result) {
                echo "Une erreur s'est produite dans la table personne.\n";
        }
        $row = pg_fetch_row($result);
        if(str_starts_with($pers,'EM')){
                $id = intval(explode("M", $row[0])[1])+1;
                if($id<9)
                        $id = 'EM00000'.$id;
                if($id>=10 && $id<=99)
                        $id = 'EM0000'.$id;
                if($id>=100 && $id<=999)
                        $id = 'EM000'.$id;
                if($id>=1000 && $id<=9999)
                        $id = 'EM00'.$id;
                if($id>=10000 && $id<=99999)
                        $id = 'EM0'.$id;
                if($id>=100000 && $id<=999999)
                        $id = 'EM'.$id;
        }
        if(str_starts_with($pers,'CL')){
                $id = intval(explode("L", $row[0])[1])+1;
                if($id<9)
                        $id = 'CL00000'.$id;
                if($id>=10 && $id<=99)
                        $id = 'CL0000'.$id;
                if($id>=100 && $id<=999)
                        $id = 'CL000'.$id;
                if($id>=1000 && $id<=9999)
                        $id = 'CL00'.$id;
                if($id>=10000 && $id<=99999)
                        $id = 'CL0'.$id;
                if($id>=100000 && $id<=999999)
                        $id = 'CL'.$id;
        }

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
        if($comp == 8){
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
                
        }

?>

<?php
        include_once "./include/footer.inc.php";
?>