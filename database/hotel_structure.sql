--
-- Ensemble des requetes DDL et des INSERT INTO du projet
--

--
-- Author: KHEDDAR Anis - LAIGNEL DUVAL Corentin
-- 

--
-- CREATE TYPE
--

CREATE TYPE TYPE_PORTE AS ENUM('chambre', 'piscine', 'salle de sécurité', 'stockage', 'cuisine', 'administration');

CREATE TYPE TYPE_ACCES AS ENUM('cuisinier','securité','nettoyage');

CREATE TYPE TYPE_EMPLOI AS ENUM('agent de sécurité', 'agent d''entretien', 'administration', 'cuisiner', 'serveur');

CREATE TYPE TYPE_CONTRAT AS ENUM('CDI', 'CDD');

--
-- CREATE TABLE
--

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

CREATE TABLE porte (
	numero_porte INTEGER PRIMARY KEY,
	type_porte TYPE_PORTE NOT NULL,
	occupe BOOLEAN,
	propre BOOLEAN
);

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

--
-- FOREIGN KEY
--

ALTER TABLE ONLY public.carte
    ADD CONSTRAINT carte_numero_porte_fkey FOREIGN KEY (numero_porte) REFERENCES public.porte(numero_porte) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.carte_porte
    ADD CONSTRAINT carte_porte_numero_carte_fkey FOREIGN KEY (numero_carte) REFERENCES public.carte(numero_carte) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.carte_porte
    ADD CONSTRAINT carte_porte_numero_porte_fkey FOREIGN KEY (numero_porte) REFERENCES public.porte(numero_porte) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.client_activite
    ADD CONSTRAINT client_activite_id_activite_fkey FOREIGN KEY (id_activite) REFERENCES public.activite(id_activite) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.client_activite
    ADD CONSTRAINT client_activite_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.personne(id_personne) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.employe
    ADD CONSTRAINT employe_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.personne(id_personne) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.employe_tache
    ADD CONSTRAINT employe_tache_id_emp_fkey FOREIGN KEY (id_emp) REFERENCES public.employe(id_emp) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.employe_tache
    ADD CONSTRAINT employe_tache_id_tache_fkey FOREIGN KEY (id_tache) REFERENCES public.tache(id_tache) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.fidelite
    ADD CONSTRAINT fidelite_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.personne_carte
    ADD CONSTRAINT personne_carte_id_personne_fkey FOREIGN KEY (id_personne) REFERENCES public.personne(id_personne) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.personne_carte
    ADD CONSTRAINT personne_carte_numero_carte_fkey FOREIGN KEY (numero_carte) REFERENCES public.carte(numero_carte) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.client(id_client) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

--
-- INSERT INTO
--

INSERT INTO personne (id_personne,nom,prenom,date_naissance,email,telephone,mdp,adresse,ville,code_postal)
	VALUES
	('CL000001','Bilbrook','Von','1901-06-10','vbilbrook6@instagram.com'	'8923636839'	'eG8mHy5vraqOP68xmStcLgZ9Q9QSVCSIYDVx/v9Qz+UUgjoQMMPBznlha1Yt','660 Glendale Terrace','Armação de Pêra','82578'),
	('CL000002','Wigsell','Alameda','1951-04-18','awigsell8@ucoz.ru'	'3755228580'	'42dbjcUeECBR5JA6LwLch3vhxXDlGOfTH3iXpBgdD84Gdr5UhdudO1z8kwTk','6 Oak Center','Martingança-Gare','21495'),
	('CL000003','Klagges','Cyb','1936-01-04','cklagges9@msu.edu'	'2159328299'	'/GSdedRTLPJl1LeyOQ1AjWKxgIbGklmv5f+QZQ9F6i4hCwY9SP68VzJz/QDb','5538 Merchant Junction','Tomteboda','78119'),
	('CL000004','Garton','Aubrie','1956-03-17','agartona@i2i.jp','9321073942','0rV6f6c4MLVnuGR4ZUgCAScMe6fjBjtqEeK+isYl6XYQDEEA/SZqeXZ4j+7S','731 Hanson Place','Khoronk’','34832'),
	('CL000005','Tesh','Galen','1939-02-15','gteshb@arizona.edu','4571611591','QHfGPwamBkRs/7EyBKgM3ZwhPh6mkzJALm9zHA45nJYuVGxel236x2ZhGV7X','5134 Petterle Lane','Katsuyama','50123'),
	('CL000006','Loseke','Cobbie','1903-12-10','closekec@gravatar.com','5187261999','nnHf/b47zbeXNxXaN6w6KH4vXhWsEuaYIcxeXPOlwiiOHHByOP3W54r7vBaD','3580 Judy Drive','Kabala','37329'),
	('CL000007','Cuxson','Randal','1967-09-19','rcuxsond@qq.com','5456912444','LGOb/tAp0gKx6AonxBRQVVW06i4f582HPJM5RCL7lnflWzFMQYv5ML0TsokA','89 Mendota Point','São Fidélis','67985'),
	('CL000008','Beetles','Maurita','1925-07-21','mbeetlese@behance.net','8116977097','ivjXSZReOnsxSesLpp5iZLOjLil7SBg+p68CqeodWRjBK9uDof68G1+xWFRp','307 Tennyson Terrace','Abang','41566'),
	('CL000009','Senechell','Garold'	'1978-07-03','gsenechellf@constantcontact.com','5184549498','Ho88cXOU+FgqDhYI/BOz4uq/D3yTZkrQWdGjMr9gbrZT5OU2I6rl1qqQLSq9','78 Mayer Avenue','Il’ichëvo','96783'),
	('CL000010','Creffeild','Orlando','1922-10-23','ocreffeildg@edublogs.org','6391176185','78c3gGivy1s7oZqaV8RQ2UqO5B5BPg0ML1H+O3IX6iIehBmEbaWiBatYm58B','54945 Mccormick Alley','Cential','94108'),
	('CL000011','Luthwood','Steffie','1958-03-06','sluthwoodh@privacy.gov.au','6761021156','3X1WUGPLyz5mislQFnLx2s2s54qG4uKsHoQKRMCFRcRKd/dtTgDqAgExltfK','9 Union Park','Agarsin','79838'),
	('CL000012','Edmott','Terrell','1920-10-14','tedmotti@oaic.gov.au','3852651015','xc99Uaj7VMi+WrnDfxY2FMIq8TBRYHCn3jSpvBzcK0R5e9o4UvQ6avQgubtE','8 Fair Oaks Plaza','Sheshan','47808'),
	('EM000001','Fingleton','Sharai','1940-03-21','sfingleton0@trellian.com','9406635542','Vew7SEhC4YPaAHG8RJTEtdclp5CHuyZBkz/Cf2Pi04Loeqn07qLmDgscdCS7','348 Park Meadow Crossing','Santa Tecla','69238'),
	('EM000002','Vasnetsov','Karia','1955-04-02','kvasnetsov6@google.pl','8011042345','6q2MyCVFRE3SZHXfqE6cpoqKzo9c3DjRmSe0gGLOCsO/7zfwuRelqOBMIG5N','702 Schlimgen Lane','Las Varillas','27380'),
	('EM000003','Schustl','Jessie','1951-12-10','jschustl8@cnn.com','5425787374','Gzh/lrDznDVa27R4m2SeuQmWPpemoDy70az0ZfzNSFCx6thm3b4n9av8Qrq5','54 Sutherland Way','Kutao','43148'),
	('EM000004','Brandone','Huntington','1994-03-23','hbrandone9@wikimedia.org','2947911997','yeH0X+MOE0d+NOgBwrBsFWj5LAbBvn4EROwXG0+hBEGijJYPZzPZJU6buB1D','45 Bluestem Trail','Velyka Lepetykha','20539'),
	('EM000005','Pfeffle','Skelly','1998-06-23','spfefflea@europa.eu','1474264128','3J1XpppfTOcw/DFUy9jIjF6EifUBZmp+t6C9VX66yzNkRAt8uy0+z/tHS0t5','48 Farragut Junction','Youcheng','88871'),
	('EM000006','Benediktovich','Goldia','1930-04-10','gbenediktovichb@mit.edu','9775223032','ID5vV6OmAyW+2ACS5jBVzqgIJKvuiVtS/P5y+onySXQQQ+QFGFhpOAozd6Dx','32750 Vernon Park','Błaszki','56698'),
	('EM000007','Fydoe','Xever','1930-10-05'	'xfydoec@kickstarter.com','5575892936','s7iR61OJFN/ZqYgyrMKaxr/WjxINi+kVUFkWYj/h8/k+4M07i9AZSbAc7ZjA','58 Di Loreto Point','Lidun','68566'),
	('EM000008','Montier','Marne','1982-11-11','mmontierd@state.gov','7028554703','0Ess7dT/skFTj9vPiAQ21KerEv9+rQs7oA0H0VjlVvtgGhWfFMmv1VJ0UQRs','6824 Chinook Plaza','Reno','29055'),
	('EM000009','Farnan','Reed','1909-02-10','rfarnane@utexas.edu','8061406228','9EkQS7VWc7a22lGAZ57oHmXgcKxrhzpeC+TN4/04ULh80EHEixl7UGSXAZcG','2 Nobel Circle','Kaavi','11184'),
	('EM000010','Begg','Pablo','1999-04-05','pbeggf@webs.com','4965872121','sD+T4362WNUNysBOrELb3SwWXYZ/nLZuICAdXmQsXJHXWj/Su6N4xPNjgtu6','67583 Pond Avenue','Västerås','66643'),
	('EM000011','Slegg','Llywellyn','1955-04-21','lsleggg@icio.us','1513710573','nOgTa68yfhliBtAg2S7yQUrdPVvhgFWjNJVUA8i68xJBKnXhz4rsRpnrvJsW','12 Elgar Plaza','Soutelo','97027'),
	('EM000012','Meade','Vikky','1958-06-25','vmeadeh@jigsy.com','7647391267','Z4hMfPurnFgiEOsIf1RgQD9hig+wPm7EEFs0dk71AWhYI3X6MPNZaAcUhrpl','9 Menomonie Pass','Carregado','57886'),
	('EM000013','Tunsley','Byram','1961-11-29','btunsleyi@bbc.co.uk','5617518358','w5X2hOt+uCvXrJWTgk8/63BmTi/yKAQOU5UdztfN28ARsmnRMjNq0Eg2UkaJ','833 Golf View Center','Kozhva','23908'),
	('EM000014','Giddy','Bartlet','1900-05-31','bgiddyj@comcast.net','3388694373','dH2u1sjnN6Xpog2xjUgww4T4ag+YVIQRMeyh++pSTn9S9eRUfIM+pRthkUGP','73 Pepper Wood Plaza','Åstorp','70033'),
	('EM000015','Bamlett','Leese','1962-08-21','lbamlett7@elegantthemes.com','4833926432','A2tdLl8rRAUtRnx7HR8uImXpfUDFaUCIADWS4oa6G1/hadLYBVt7w4W5WsDM','57096 Burning Wood Point','Bicesse','86162'),
	('EM000016','Dickerson','Lyn','1972-03-16','ldickerson5@businessweek.com','1712439276','nEUp5flhIwLc5bhYbWstCcmz55z6kW2bWXsFb7U8EBEggRhGzqD1orwveZfY','58 Susan Point','Tungi','88771'),
	('CL000013','Gayleee','Cayla','1930-07-11','cgayle7@abc.net.au','9391550196','0bKvV9zE6Tm1/pL/HMkiQgO95kdRUc2X/rsDFwgggZAZHBZqA3ryZtO112dB','1 Green Park','Bogorame','98473'),
	('CL000014','Seal','Denys','1950-09-18','dseal5@dedecms.com','1468414148','gY3OAr8lULfLdevdXXOeAl5FGVl/hE27r2ampuw9fvg+VjVmJd8pMm2MQ27i','0 Waxwing Point','Subulussalam','65743'),
	('CL000015','test','test','2010-12-01','test@test','0102030405','$2y$10$p1js1forEilk/REMecbaHeS7flW9v8d/JyB6KM.A6Lc.WBbNbzTCO','oui','non','12345');

INSERT INTO client (id_client, nombre_carte) 
	VALUES
	('CL000001',3),
	('CL000002',5),
	('CL000003',2),
	('CL000004',0),
	('CL000005',2),
	('CL000006',0),
	('CL000007',3),
	('CL000008',3),
	('CL000009',3),
	('CL000010',0),
	('CL000011',0),
	('CL000012',1),
	('CL000013',3),
	('CL000014',3),
	('CL000015',0);	

INSERT INTO employe (id_emp, date_debut_emploi, date_fin_emploi, type_contrat, emploi) 
	VALUES
	('EM000002','2013-10-26','2017-09-28','CDD','administration'),
	('EM000003','2012-06-19','','CDI','agent d''entretien'),
	('EM000004','2011-05-24','','CDI','agent d''entretien'),
	('EM000005','2014-01-12','','CDI','agent d''entretien'),
	('EM000006','2013-12-04','2015-05-12','CDD','agent d''entretien'),
	('EM000007','2012-07-18','2022-03-09','CDD','agent d''entretien'),
	('EM000008','2012-06-22','2016-01-13','CDD','agent d''entretien'),
	('EM000009','2010-06-14','','CDI','cuisinier'),
	('EM000010','2011-12-26','','CDI','cuisinier'),
	('EM000011','2012-01-02','','CDI','serveur'),
	('EM000012','2010-11-06','2015-11-16','CDD','cuisinier'),
	('EM000013','2011-12-20','2016-04-28','CDD','cuisinier'),
	('EM000014','2011-05-11','2023-04-09','CDD','serveur'),
	('EM000015','2010-07-05','','CDI','administration'),
	('EM000016','2012-04-14','2017-04-01','CDD','administration');

INSERT INTO COPY porte (numero_porte, type_porte, occupe, propre) 
	VALUES
	(1,'chambre','',''),
	(2,'chambre','',''),
	(3,'chambre','',''),
	(4,'chambre','',''),
	(5,'chambre','',''),
	(6,'chambre','',''),
	(7,'chambre','',''),
	(8,'chambre','',''),
	(9,'cuisine','f','f');

INSERT INTO carte (numero_carte, acces, perdu, numero_porte) 
	VALUES
	(1,'cuisinier','f',1),
	(2,'cuisinier','f',2),
	(3,'cuisinier','f',3),
	(4,'cuisinier','f',4),
	(5,'cuisinier','f',5),
	(6,'cuisinier','f',6),
	(7,'cuisinier','f',7),
	(8,'cuisinier','f',8);

INSERT INTO activite (id_activite, nom_activite, description, date_activite, heure_debut, heure_fin, prix) 
	VALUES
	('0000001','Soirée karaoké','Passsez une soirée a chanter des classique de musique !','2022-05-14','20:00:00','23:00:00',0),
	('0000002','Jet ski','Sortie en jet ski pour tout débutant','2022-08-21','14:00:00','16:30:00',30);

INSERT INTO fidelite (id_fidelite, points, date_fidelite, id_client) 
	VALUES
	('4',61,'2021-01-14','CL000001');

INSERT INTO reservation (numero_res, numero_chmb, nombre_personnes, date_debut, date_fin, prix_ttc, paye, id_client) 
	VALUES
	(7,6,4,'2022-04-07','2022-07-17',313.18,'f','CL000001'),
	(9,4,2,'2022-05-15','2022-06-11',251.79,'t','CL000002'),
	(10,4,1,'2022-05-05','2022-06-20',350.18,'t','CL000003'),
	(8,1,2,'2022-04-09','2022-07-17',532.98,'f','CL000013'),
	(6,5,3,'2022-04-13','2022-06-24',226.35,'t','CL000014');

INSERT INTO tache (id_tache, description, date_heure_début, date_heure_fin, commentaire, realise)
	VALUES
	('00000001','Nettoyer la chambre 502','2022-11-14 07:00:00','2022-11-14 07:30:00','','f'),
	('00000002','Réparer la chasse d eau des toilettes de la salle de  bain de la chambre 131','2022-11-14 07:00:00','2022-11-14 08:00:00','En attente de l arrivé de la piece manquante pour la réparation','f'),
	('00000003','Réceptionner les colis','2022-11-14 11:00:00','2022-11-14 12:00:00','','t');

INSERT INTO employe_tache (id_emp, id_tache) 
	VALUES
	('EM000003','00000001'),
	('EM000004','00000002'),
	('EM000015','00000003');

INSERT INTO carte_porte (numero_carte, numero_porte, heure_ouverture, statut_ouverture) 
	VALUES
	(1,1,'2022-11-25 00:00:00',0);

