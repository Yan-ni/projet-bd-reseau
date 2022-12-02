<?php
    $titre="Ajout de réservation";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>
<?php
    $query = "SELECT id_personne, nom, prenom FROM client INNER JOIN personne ON personne.id_personne = client.id_client";
    $pers = pg_query($dbconn, $query);
    $query = "SELECT numero_porte FROM porte WHERE type_porte = 'chambre'";
    $cham = pg_query($dbconn, $query);


?>
<div class="container">
    <h2 class="mt-5 mb-3">Ajouter une réservation</h2>
    <form action="addReserv.php" method="get">
        <input type="hidden" class="form-control" name="id">
        <div>
            <label for="personne" class="form-label">Client</label>
            <select name="personne">
                    <?php while ($line = pg_fetch_row($pers, null)) { ?>
                        <option value="<?php echo $line[0] ?>"><?php echo $line[1]." ".$line[2]; ?></option>
                    <?php 
                }
                ?>
            </select>
        </div>    
        <div>
            <label for="chambre" class="form-label">Chambre</label>
            <select name="chambre">
                    <?php while ($line = pg_fetch_row($cham, null)) { ?>
                        <option value="<?php echo $line[0] ?>"><?php echo "Numéro ".$line[0]; ?></option>
                    <?php 
                }
                ?>
            </select>
        </div>
        <div>
            <label for="nbpers" class="form-label">Nombre de personnes</label>
            <input type="text" class="form-control" name="nbpers">
        </div>
        <div>
            <label for="datedebut" class="form-label">Date début</label>
            <input type="date" class="form-control" name="datedebut">
        </div>
        <div>
            <label for="datefin" class="form-label">Date fin</label>
            <input type="date" class="form-control" name="datefin">
        </div>
        <div>
            <label for="comm" class="form-label">Prix</label>
            <input type="text" class="form-control" name="prix">
        <div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </div>
    </form>
</div>

<?php
        $query = "SELECT numero_res FROM reservation ORDER BY numero_res DESC LIMIT 1";
        $result = pg_query($dbconn, $query); 
        if(!$result) {
                echo "Une erreur s'est produite dans la table personne.\n";
        }
        $row = pg_fetch_row($result);
        $numreserv = $row[0]+1;

        $numreserv = intval($row[0]+1);
        
        $comp = 0;
        if(!empty($_GET['personne'])){
            $comp++;
        }
        if(!empty($_GET['datedebut'])){
            $comp++;
        }
        if(!empty($_GET['datefin'])){
            $comp++;
        }
        if(!empty($_GET['chambre'])){
            $comp++;
        }
        if(!empty($_GET['prix'])){
            $comp++;
        }
        if(!empty($_GET['nbpers'])){
            $comp++;
        }
        
        if($comp == 6){

                $chambre = $_GET['chambre'];
                $datedebut =$_GET['datedebut'];
                $datefin =$_GET['datefin'];
                $nbpers =$_GET['nbpers'];
                $pers = $_GET['personne'];
                $prix = $_GET['prix'];
                $query = "INSERT INTO reservation VAlUES('$numreserv','$chambre','$nbpers','$datedebut','$datefin','$prix','0','$pers')";
                $result = pg_query($dbconn, $query); 
                if (!$result) {
                        echo "Une erreur s'est produite dans la table reservation.\n";
                }else{
                        echo "<p>Ajout d'une reservation réussit.</p>";
                }
                
                echo "yes";
        }

?>

<?php
        include_once "./include/footer.inc.php";
?>