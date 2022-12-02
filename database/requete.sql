--
-- Ensemble des requetes sql dans le code du site
--

--
-- Author: KHEDDAR Anis - LAIGNEL DUVAL Corentin
-- 

--
-- Requete dans addClient.php
--
-- Obtention du dernier id d'un client dans la table personne
SELECT id_personne FROM personne WHERE id_personne LIKE 'CL%' ORDER BY id_personne DESC LIMIT 1

-- Obtention du dernier id d'un employé dans la table personne
SELECT id_personne FROM personne WHERE id_personne LIKE 'EM%' ORDER BY id_personne DESC LIMIT 1

-- Insertion d'une nouvelle personne
INSERT INTO personne VAlUES('$id','$nom','$prenom','$bday','$email','$tel','$mdp','$adr','$ville','$codepsot')

-- Insertion d'un nouveau client
INSERT INTO client VAlUES('$id','0')

--
--Requete dans addReserv.php
--

-- Obtention des nom et prénom de tout les clients
SELECT id_personne, nom, prenom FROM client INNER JOIN personne ON personne.id_personne = client.id_client

-- Obtention de tout les numéro de porte
SELECT numero_porte FROM porte WHERE type_porte = 'chambre'

-- Obtention du dernier id de reservation
SELECT numero_res FROM reservation ORDER BY numero_res DESC LIMIT 1

-- Insertion dans la table reservation
INSERT INTO reservation VAlUES('$numreserv','$chambre','$nbpers','$datedebut','$datefin','$prix','0','$pers')

--
-- Requete dans addTache.php
--

-- Obtention de tout les id des employes
SELECT id_personne FROM employe INNER JOIN personne ON personne.id_personne = employe.id_emp

-- Obtention du dernier id de la table tache
SELECT id_tache FROM tache ORDER BY id_tache DESC LIMIT 1

-- Insertion d'une nouvelle tache
INSERT INTO tache VAlUES('$id','$description','$datedebut','$datefin','$comm','0')

-- Assignation d'une tache a un employé
INSERT INTO employe_tache VAlUES('$pers','$id')

--
-- Requete dans client.php
--

-- Obtention de toutes les informations des clients
SELECT id_client, nom, prenom, date_naissance, email, telephone, adresse, ville, code_postal, nombre_carte FROM client INNER JOIN personne ON id_client = id_personne

-- Obtention des information des clients ayant une fidélité a l'hotel
SELECT id_client, nom, prenom, date_fidelite, points FROM personne INNER JOIN client ON client.id_client = personne.id_personne NATURAL JOIN fidelite

--
-- Requete dans employe.php
--

-- Obtention de toutes les informations des employés
SELECT id_emp, nom, prenom, date_naissance, email, telephone, adresse, ville, code_postal, emploi, type_contrat, date_debut_emploi, date_fin_emploi FROM employe INNER JOIN personne ON id_emp = id_personne

--
-- Requete dans index.php
--

-- Nom et prenom de l'employé connecté au site
SELECT nom, prenom FROM personne WHERE id_personne ='$id' 

--
-- Requete dans login.php
--

-- Obtention de l'id et du mdppour se connecter
SELECT id_personne, mdp FROM personne WHERE id_personne = $1

--
-- Requete dans reserv.php
--

-- Obtention des information de réservation
SELECT id_client, nom, prenom, numero_res, numero_chmb, nombre_personnes,date_debut,date_fin, prix_ttc, paye FROM reservation NATURAL JOIN client INNER JOIN personne ON id_client = id_personne;

--
-- Requete dans suppPersonne.php
--

-- Suppression d'une personne
DELETE FROM personne WHERE id_personne= '$id'

--
-- Requete dans tache.php
--

-- Obtention des information sur une tache a réaliser
SELECT personne.nom, personne.prenom, tache.description, tache.date_heure_début, tache.date_heure_fin, tache.commentaire, tache.realise FROM tache NATURAL JOIN employe_tache INNER JOIN personne ON personne.id_personne = employe_tache.id_emp

--
-- Requete dans updClient.php
--

-- Modification d'une personne
UPDATE personne SET nom='$nom', prenom='$prenom',date_naissance='$bday',email='$email',telephone='$tel',adresse='$adr',ville='$ville',code_postal='$codepsot' WHERE id_personne = '$id'

-- Modification d'un client
UPDATE client SET nombre_carte='$nbcarte' WHERE id_client='$id'

-- Obtention des information d'un client
SELECT * FROM personne INNER JOIN client ON client.id_client = personne.id_personne WHERE id_personne='$id'

--
-- Requete dans updEmploye.php
--

-- Modification d'une personne
UPDATE personne SET nom='$nom', prenom='$prenom',date_naissance='$bday',email='$email',telephone='$tel',adresse='$adr',ville='$ville',code_postal='$codepsot' WHERE id_personne = '$id'

-- Modification d'un employe
UPDATE employe SET date_debut_emploi='$startdate', date_fin_emploi='$enddate', type_contrat='$typecont', emploi='$emploi' WHERE id_emp='$id'

-- Obtention des information d'un employe
SELECT * FROM personne INNER JOIN employe ON employe.id_emp = personne.id_personne WHERE id_personne='$id'