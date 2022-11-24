<!DOCTYPE html>
<head>
    <title><?php echo $titre; ?></title>
    <meta charset="utf-8"/>
    <meta name="author" content="LAIGNEL DUVAL Corentin, KHEDDAR Anis"/>
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="date" content="<?php echo date("Y-m-d"); ?>"/>
    <meta name="location" content="CY Cergy Paris Université"/>
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
    <header>
        <nav>
            <div>
                <ul>
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="client.php">Clients</a>
                    </li>
                    <li>
                        <a href="employe.php">Employés</a>
                    </li>
                    <li>
                        <a href="reserv.php">Réservations</a>
                    </li>
                    <li>
                        <a href="tache.php">Tâches</a>
                    </li>
                </ul>
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