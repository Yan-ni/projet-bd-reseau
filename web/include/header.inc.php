<!DOCTYPE html>
<head>
    <title>Hotel - <?php echo $titre; ?></title>
    <meta charset="utf-8"/>
    <meta name="author" content="LAIGNEL DUVAL Corentin, KHEDDAR Anis"/>
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="date" content="<?php echo date("Y-m-d"); ?>"/>
    <meta name="location" content="CY Cergy Paris Université"/>
    <link rel="stylesheet" href="./assets/styles/bootstrap.min.css"/>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-xl">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Hotel</span>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo strcmp($titre, "Accueil") == 0 ? "active" : ""?>" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strcmp($titre, "Client") == 0 ? "active" : ""?>" href="client.php">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strcmp($titre, "Employé") == 0 ? "active" : ""?>" href="employe.php">Employés</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strcmp($titre, "Réservation") == 0 ? "active" : ""?>" href="reserv.php">Réservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo strcmp($titre, "Tâche") == 0 ? "active" : ""?>" href="tache.php">Tâches</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php include_once "idf.conf.inc.php"; ?>
            <?php
            $dbconn = pg_connect("host=$host port=5432 dbname=$dbname user=$dbuser password=$dbpass");
            if (!$dbconn) {
                echo "Une erreur s'est produite a la connexion.\n";
                exit;
            }
            ?>
    </header>