CREATE TABLE personne (
	id_personne CHAR(8) PRIMARY KEY, 
	nom VARCHAR(25) NOT NULL,
	prenom VARCHAR(25) NOT NULL,
	date_naissance DATE NOT NULL,
	email VARCHAR(50) NOT NULL,
	telephone CHAR(10) NOT NULL,
	MDP CHAR(64) NOT NULL,
	adresse VARCHAR(25) NOT NULL,
	ville VARCHAR(25) NOT NULL,
	code_postal CHAR(5) NOT NULL
);

CREATE TYPE TYPE_PORTE AS ENUM('chambre', 'piscine', 'salle de sécurité', 'stockage', 'cuisine', 'administration');

CREATE TABLE porte (
	numero_porte INTEGER PRIMARY KEY,
	type_porte TYPE_PORTE NOT NULL,
	occupe BOOLEAN,
	propre BOOLEAN
);

CREATE TYPE TYPE_ACCES AS ENUM('cuisinier','securité','nettoyage');

CREATE TABLE carte (
	numero_carte INTEGER PRIMARY KEY,
	acces TYPE_ACCES NOT NULL,
	perdu BOOLEAN DEFAULT FALSE,
	numero_porte INTEGER REFERENCES porte(numero_porte)
);

CREATE TABLE personne_carte (
	id_personne char(8) REFERENCES personne(id_personne),
	numero_carte INTEGER REFERENCES carte(numero_carte),
	PRIMARY KEY(id_personne, numero_carte)
);

CREATE TABLE carte_porte (
	numero_carte INTEGER REFERENCES carte(numero_carte),
	numero_porte INTEGER REFERENCES porte(numero_porte),
	date_ouverture DATE NOT NULL,
	statut_ouverture INTEGER NOT NULL,
	PRIMARY KEY(numero_carte, numero_porte)
);

CREATE TYPE TYPE_EMPLOI AS ENUM('agent de sécurité', 'agent d''entretien', 'administration', 'cuisiner', 'serveur');
CREATE TYPE TYPE_CONTRAT AS ENUM('CDI', 'CDD');

CREATE TABLE employe (
	id_emp CHAR(8) PRIMARY KEY REFERENCES personne(id_personne) CHECK (id_emp LIKE 'EM%'),
	emploi TYPE_EMPLOI NOT NULL,
	date_debut_emploi DATE NOT NULL,
	date_fin_emploi DATE,
	type_contrat TYPE_CONTRAT NOT NULL
);

CREATE TABLE tache (
	id_tache CHAR(8) NOT NULL PRIMARY KEY,
	description VARCHAR(500) NOT NULL,
	date_heure_début TIMESTAMP,
	date_heure_fin TIMESTAMP,
	Commentaire VARCHAR(500),
	realise BOOLEAN NOT NULL
);

CREATE TABLE employe_tache (
	id_emp CHAR(8) REFERENCES employe(id_emp),
	id_tache CHAR(8) REFERENCES tache(id_tache),
	PRIMARY KEY(id_emp, id_tache)
);

CREATE TABLE client (
	id_client CHAR(8) PRIMARY KEY REFERENCES personne(id_personne) CHECK (id_client LIKE 'CL%'),
	nombre_carte INTEGER
);

CREATE TABLE fidelite (
	id_fidelite CHAR(8) PRIMARY KEY,
	points INTEGER NOT NULL DEFAULT 0,
	date_fidelite DATE NOT NULL,
	id_client CHAR(8) REFERENCES client(id_client)
);

CREATE TABLE reservation (
	numero_res INTEGER PRIMARY key,
	numero_chmb INTEGER NOT NULL,
	nombre_personnes INTEGER NOT NULL,
	date_debut DATE NOT NULL,
	date_fin DATE NOT NULL,
	prix_TTC FLOAT NOT NULL,
	paye BOOLEAN NOT NULL DEFAULT FALSE,
	id_client CHAR(8) REFERENCES client(id_client)
);

CREATE TABLE activite (
	id_activite CHAR(8) PRIMARY KEY,
	nom_activite VARCHAR(25) NOT NULL,
	description VARCHAR(500),
	date_activite DATE,
	heure_debut TIME,
	heure_fin TIME,
	prix FLOAT NOT NULL DEFAULT 0
);

CREATE TABLE client_activite (
	id_client CHAR(8) REFERENCES client(id_client),
	id_activite CHAR(8) REFERENCES activite(id_activite),
	PRIMARY KEY(id_client, id_activite)
);