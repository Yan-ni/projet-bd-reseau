<?php
    $titre="Ajout de clients";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<div class="container">
    <h2 class="mt-5 mb-3">Ajouter un client</h2>
    <form class="row g-3" action="addClient.php" method="get">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom">
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="prenom">
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
        </div>
        <div class="col-md-4">
            <label for="tel" class="form-label">Telephone</label>
            <input type="tel" class="form-control" id="tel">
        </div>
        <div class="col-md-4">
            <label for="bday" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="bday" min="1900-01-01" max="2010-12-31">
        </div>
        <div class="col-md-8">
            <label for="adr" class="form-label">Address</label>
            <input type="text" class="form-control" id="adr">
        </div>
        <div class="col-md-2">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville">
        </div>
        <div class="col-md-2">
            <label for="codepost" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="codepost">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
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
                
        }

?>

<?php
        include_once "./include/footer.inc.php";
?>