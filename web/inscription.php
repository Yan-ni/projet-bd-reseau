<?php
    $titre="Inscription";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>



<div class="container">
    <h2 class="mt-5 mb-3">Ajouter un client</h2>
    <form class="row g-3" method="post">
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
        <div class="col-md-2">
            <label for="codepost" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp">
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </div>
    </form>
</div>

<?php
$query = "SELECT id_personne FROM personne WHERE id_personne LIKE 'CL%' ORDER BY id_personne DESC LIMIT 1";

$result = pg_query($dbconn, $query); 
if(!$result) {
        echo "Une erreur s'est produite dans la table personne.\n";
}
$row = pg_fetch_row($result);

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


$comp = 0;
if(isset($_POST['nom'])){
        if (ctype_alpha($_POST['nom']) /*&& is_string($_GET['nom'])*/){
                $comp++;
        }else{
                echo "<p>Mauvais format pour le nom</p>";
        }
}
if(isset($_POST['prenom'])){
        if(ctype_alpha($_POST['prenom']) /*&& is_string($_GET['prenom'])*/){
                $comp++;
        }else{
                echo "<p>Mauvais format pour le prenom</p>";
        }
}
if(isset($_POST['email'])){
        if(/*is_string($_GET['email']) && */str_contains($_POST['email'],'@')){
                $comp++;
        }else{
                echo "<p>Mauvais format pour l'adrresse email</p>";
        }
}
if(isset($_POST['tel'])){
        if(is_numeric($_POST['tel'])){
                $comp++;
        }else{
                echo "<p>Mauvais format pour le teléphone</p>";
        }
}
if(isset($_POST['bday']) ){
        if(is_string($_POST['bday'])){
                $comp++;
        }else{
                echo "<p>Mauvais format pour la date de naissance</p>";
        }
}
if(isset($_POST['adr'])){
        if(!is_null($_POST['adr'])/* && is_string($_GET['adr'])*/){
                $comp++;
        }else{
                echo "<p>Mauvais format pour l'adresse</p>";
        }
}
if(isset($_POST['ville'])){
        if(ctype_alpha($_POST['ville']) /*&& is_string($_GET['ville'])*/){
                $comp++;
        }else{
                echo "<p>Mauvais format pour la ville</p>";
        }
}
if(isset($_POST['codepost']) ){
        if(is_numeric($_POST['codepost'])){
                $comp++;
        }else{
                echo "<p>Mauvais format pour le code postal</p>";
        }
}
if(isset($_POST['mdp'])){
    if(!empty($_POST['mdp'])/* && is_string($_GET['adr'])*/){
            $comp++;
    }else{
            echo "<p>Mauvais format pour l'adresse</p>";
    }
}
if($comp == 9){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $bday = $_POST['bday'];
    $adr = $_POST['adr'];
    $ville = $_POST['ville'];
    $codepsot = $_POST['codepost'];
    $mdp = $_POST['mdp'];
    $mdp =  password_hash($mdp, PASSWORD_DEFAULT);

    $query = "INSERT INTO personne VAlUES('$id','$nom','$prenom','$bday','$email','$tel','$mdp','$adr','$ville','$codepsot')";
    $result = pg_query($dbconn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table personne.\n";
    }
    $query = "INSERT INTO client VAlUES('$id','0')";
    $result = pg_query($dbconn, $query); 
    if (!$result) {
            echo "Une erreur s'est produite dans la table client.\n";
    }
    echo "Votre identifiant est $id";
}
?>

<?php
    include_once "./include/footer.inc.php";
?>