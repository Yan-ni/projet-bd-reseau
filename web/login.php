<?php
if(isset($_POST["id_employe"]) && isset($_POST["mdp"]))
{
	$id = $_POST["id_employe"];
	$mdp = $_POST["mdp"];

	if(strlen($id) == 0 || strlen($mdp) == 0)
	{
		header("Location: /login.php");
		exit();
	}

	include_once "include/idf.conf.inc.php";
	$dbconn = pg_connect("host=$host port=5432 dbname=$dbname user=$dbuser password=$dbpass");
	if (!$dbconn) {
		echo "Une erreur s'est produite a la connexion.\n";
		exit;
	}

	$result = pg_prepare($dbconn, "get_employe", "SELECT id_personne, mdp, nom, prenom FROM personne WHERE id_personne = $1");
	$result = pg_execute($dbconn, "get_employe", array($id));
	$result = pg_fetch_assoc($result);

	if(!$result)
	{
		header("Location: /login.php");
		exit();
	}

	$nom = $result["nom"];
	$prenom = $result["prenom"];

	if(strcmp($result["mdp"], hash("sha256", $mdp)) == 0)
	{
		session_start();
		$_SESSION["id_employe"] = $id;
		$_SESSION["nom"] = $nom;
		$_SESSION["prenom"] = $prenom;
		header("Location: /index.php");
		exit();
	}
	$test = "connecté";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/styles/bootstrap.min.css">
	<title>Login</title>
</head>
<body style="min-height: 100vh;" class="d-flex align-items-center justify-content-center">
	<div class="w-50 p-4 shadow rounded">
		<h1>Login</h1>
		<form action="login.php" method="post" class="form">
			<div class="mb-3">
				<label for="id_employe" class="form-label">ID employé</label>
				<input id="id_employe" type="text" name="id_employe" class="form-control" placeholder="EM000000">
			</div>

			<div class="mb-3">
				<label for="mdp" class="form-label">mot de passe</label>
				<input id="mdp" type="password" name="mdp" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">login</button>
		</form>
	</div>
</body>
</html>