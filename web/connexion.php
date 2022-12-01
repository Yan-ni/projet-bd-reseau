<?php
    $titre="Hotel - Connexion";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>

<?php
    session_start();
    $id=$_POST["id"];
    $pass=$_POST["pass"];
    $valider=$_POST["valider"];

    echo "$pass";
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    echo "$hash\n";
    $erreur="";

    $mdp=password_verify($pass,$hash);

    echo "$mdp\n";
    if(isset($valider)){

        $sel="SELECT * from personne WHERE id_personne='$id' LIMIT 1";
        $result=pg_query($dbconn,$sel);
        while ($line = pg_fetch_row($result, null)) { ?>
            <tr>
                <?php foreach ($line as $col_value) { ?>
                <td><?php echo $col_value ?></td>
                <?php } ?>
            <?php } 
        /*if(count($tab)>0){
            $_SESSION["id_personne"]=ucfirst(strtolower($tab[0]["prenom"]))." ".strtoupper($tab[0]["nom"]);
            $_SESSION["autoriser"]="oui";
            header("location:session.php");
        }
        else
        $erreur="Mauvais login ou mot de passe!";*/
    }
?>

<h1>Authentification [ <a href="inscription.php">Créer un compte</a> ]</h1>
<div class="erreur"><?php echo $erreur ?></div>
<form name="fo" method="post" action="">
<input type="text" name="id" placeholder="Identifiant" /><br />
<input type="password" name="pass" placeholder="Mot de passe" /><br />
<input type="submit" name="valider" value="S'authentifier" />
</form>

<?php
    include_once "./include/footer.inc.php";
?>