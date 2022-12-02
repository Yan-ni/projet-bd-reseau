<?php
    $titre="Ajout de tache";
    $description="Site de projet de base de donnée réseau";
    include_once "./include/header.inc.php";
?>
<?php
    $query = "SELECT id_personne FROM employe INNER JOIN personne ON personne.id_personne = employe.id_emp";
    $result = pg_query($dbconn, $query);


?>
<div class="container">
    <h2 class="mt-5 mb-3">Ajouter une tâche</h2>
    <form action="addTache.php" method="get">
        <input type="hidden" class="form-control" name="id">
        <div>
            <select name="personne">
                    <?php while ($line = pg_fetch_row($result, null)) { ?>
                    <?php foreach ($line as $col_value) { ?>
                        <option value="<?php echo $col_value ?>"><?php echo $col_value ?></option>
                    <?php }
                }
                ?>
            </select>
        </div>    
        <div>
            <label for="description" class="form-label">Description</label>
            <input type="textarea" class="form-control" name="description">
        </div>
        <div>
            <label for="datedebut" class="form-label">Date et heure du début</label>
            <input type="datetime-local" class="form-control" name="datedebut">
        </div>
        <div>
            <label for="datefin" class="form-label">Date et heure du début</label>
            <input type="datetime-local" class="form-control" name="datefin">
        </div>
        <div>
            <label for="comm" class="form-label">Commentaire</label>
            <input type="textarea" class="form-control" name="comm">
        <div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </div>
    </form>
</div>

<?php
        $query = "SELECT id_tache FROM tache ORDER BY id_tache DESC LIMIT 1";
        $result = pg_query($dbconn, $query); 
        if(!$result) {
                echo "Une erreur s'est produite dans la table personne.\n";
        }
        $row = pg_fetch_row($result);
        $id = $row[0]+1;

        $id = intval($row[0]+1);
        $id = str_pad($id, 8, '0', STR_PAD_LEFT);
        
        $comp = 0;
        if(!empty($_GET['description'])){
            $comp++;
        }
        if(!empty($_GET['datedebut'])){
            $comp++;
        }
        if(!empty($_GET['datefin'])){
            $comp++;
        }
        if(!empty($_GET['comm'])){
            $comp++;
        }
        if(!empty($_GET['personne'])){
            $comp++;
        }
        
        if($comp == 5){

                $description = $_GET['description'];
                $datedebut =$_GET['datedebut'];
                $datefin =$_GET['datefin'];
                $comm =$_GET['comm'];
                $pers = $_GET['personne'];
                $query = "INSERT INTO tache VAlUES('$id','$description','$datedebut','$datefin','$comm','0')";
                $result = pg_query($dbconn, $query); 
                if (!$result) {
                        echo "Une erreur s'est produite dans la table tache.\n";
                }
                $query = "INSERT INTO employe_tache VAlUES('$pers','$id')";
                $result = pg_query($dbconn, $query); 
                if (!$result) {
                        echo "Une erreur s'est produite dans la table employe_tache.\n";
                }else{
                        echo "<p>Ajout d'une tache réussit.</p>";
                }
                
        }

?>

<?php
        include_once "./include/footer.inc.php";
?>