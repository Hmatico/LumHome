﻿USE base_lumhome;
-- REM **************************************************************************
-- REM Base : BASE_LUMHOME
-- REM Auteur : Mathieu VALENTIN
-- REM Group : G2B
-- REM Date de Mise à Jour : 08/10/2019
-- REM **************************************************************************

-- REM ************************* DROP *******************************************
DROP TABLE IF EXISTS QUESTIONS;
DROP TABLE IF EXISTS STATS ;
DROP TABLE IF EXISTS PARAMETRE ;
DROP TABLE IF EXISTS SCENARIO_CEMAC ;
DROP TABLE IF EXISTS CEMAC ;
DROP TABLE IF EXISTS SCENARIO ;
DROP TABLE IF EXISTS PIECE ;
DROP TABLE IF EXISTS HABITAT ;
DROP TABLE IF EXISTS UTILISATEUR ;

-- DROP SEQUENCE IF EXISTS UTILISATEUR_SEQ;
-- DROP SEQUENCE IF EXISTS HABITAT_SEQ;
-- DROP SEQUENCE IF EXISTS PIECE_SEQ;
-- DROP SEQUENCE IF EXISTS SCENARIO_SEQ;
-- DROP SEQUENCE IF EXISTS CEMAC_SEQ;
-- DROP SEQUENCE IF EXISTS PARAMETRE_SEQ;
-- -- REM ************************* FIN DROP ***************************************

-- -- REM ************************* SEQUENCES **************************************
-- CREATE SEQUENCE UTILISATEUR_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- CREATE SEQUENCE HABITAT_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- CREATE SEQUENCE PIECE_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- CREATE SEQUENCE SCENARIO_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- CREATE SEQUENCE CEMAC_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- CREATE SEQUENCE PARAMETRE_SEQ START WITH 0 INCREMENTS BY 1 NOCACHE NOCYCLE
-- ;
-- REM ************************* FIN SEQUENCES **********************************

-- REM ************************* TABLES *****************************************
-- REM ***** CREATE TABLE UTILISATEUR
CREATE TABLE UTILISATEUR (
    adresseMail VARCHAR(30),
    nomUser VARCHAR (30) NOT NULL,
    prenomUser VARCHAR(30) ,
    adresseFacturation INT(11),
    type VARCHAR(20) NOT NULL,
    mdpUser VARCHAR(125) NOT NULL,
    pin VARCHAR(4) NOT NULL,
	actif BOOLEAN NOT NULL,
    numeroCarte BIGINT(16),
	cryptogramme INT(3),
	dateExpiration DATE
)ENGINE=InnoDB  CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE HABITAT
CREATE TABLE HABITAT (
	idHabitat INT(11) NOT NULL AUTO_INCREMENT,
	nomHabitat VARCHAR(20) NOT NULL,
    numero VARCHAR(11) NOT NULL,
	rue VARCHAR(50) NOT NULL,
    complement VARCHAR(255),
	ville VARCHAR(50) NOT NULL,
	codePostal INT(5) NOT NULL,
    fk_proprietaire VARCHAR(30),
	PRIMARY KEY (idHabitat)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE PIECE
CREATE TABLE PIECE (
	idPiece INT(11) NOT NULL AUTO_INCREMENT,
	type VARCHAR(20) NOT NULL,
    nom VARCHAR(20) NOT NULL,
    fk_habitat INT(11),
	PRIMARY KEY (idPiece)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE SCENARIO
CREATE TABLE SCENARIO (
	nom VARCHAR(20),
    dateDebut TIMESTAMP,
    dateFin TIMESTAMP,
    statut BOOLEAN NOT NULL,
    scenario VARCHAR(30) NOT NULL,
    type VARCHAR(30) NOT NULL,
	fk_proprietaire VARCHAR(30)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE CEMAC
CREATE TABLE CEMAC (
    numeroSerie VARCHAR(30),
	etat INT(1),
	intensite INT(11),
	couleur INT(6),
	adresseMac CHAR(12) NOT NULL,
	type VARCHAR(10) NOT NULL,
	panne BOOLEAN NOT NULL,
    fk_piece INT(11)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE PARAMETRE
CREATE TABLE PARAMETRE (
	type VARCHAR(20),
    fk_CeMAC VARCHAR(30),
	valeur VARCHAR(20) NOT NULL
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE STATS
CREATE TABLE STATS (
	fk_habitat INT(11),
    dateStat DATE,
	nbrHeuresInutiles INT(11)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE SCENARIO_CEMAC
CREATE TABLE SCENARIO_CEMAC (
    fk_scenario VARCHAR(20),
    fk_CeMAC VARCHAR(30),
    valeurIntensite INT(11),
    valeurCouleur CHAR(6)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ***** CREATE TABLE QUESTIONS
CREATE TABLE QUESTIONS (
	id_question INT(100) PRIMARY KEY AUTO_INCREMENT,
    question LONGTEXT NOT NULL,
	reponse LONGTEXT NOT NULL
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_bin;

-- REM ************************* FIN TABLES *************************************

-- REM ************************* CONSTRAINTS ************************************
-- REM ***** UTILISATEUR
ALTER TABLE UTILISATEUR ADD CONSTRAINT PK_UTILISATEUR PRIMARY KEY (adresseMail)
;
ALTER TABLE CEMAC ADD CONSTRAINT PK_CEMAC PRIMARY KEY (numeroSerie)
;
ALTER TABLE PARAMETRE ADD CONSTRAINT PK_PARAMETRE PRIMARY KEY (type)
;
ALTER TABLE SCENARIO ADD CONSTRAINT PK_SCENARIO PRIMARY KEY (nom)
;
ALTER TABLE SCENARIO_CEMAC ADD CONSTRAINT PK_SCENARIO_CEMAC PRIMARY KEY (fk_scenario, fk_CeMAC)
;

-- REM ***** HABITAT
ALTER TABLE HABITAT ADD CONSTRAINT FK_HABITAT_UTILISATEUR FOREIGN KEY (fk_proprietaire) REFERENCES UTILISATEUR(adresseMail) ON DELETE CASCADE
;
-- REM ***** PIECE
ALTER TABLE PIECE ADD CONSTRAINT FK_PIECE_HABITAT FOREIGN KEY (fk_habitat) REFERENCES HABITAT(idHabitat) ON DELETE CASCADE
;

-- REM ***** SCENARIO
ALTER TABLE SCENARIO ADD CONSTRAINT FK_SCENARIO_UTILISATEUR FOREIGN KEY (fk_proprietaire) REFERENCES UTILISATEUR(adresseMail) ON DELETE CASCADE
;

-- REM ***** CEMAC
ALTER TABLE CEMAC ADD CONSTRAINT FK_CEMAC_PIECE FOREIGN KEY (fk_piece) REFERENCES PIECE(idPiece) ON DELETE CASCADE
;

-- REM ***** PARAMETRE
ALTER TABLE PARAMETRE ADD CONSTRAINT FK_PARAMETRE_CEMAC FOREIGN KEY (fk_CeMAC) REFERENCES CEMAC(numeroSerie) ON DELETE CASCADE
;

-- REM ***** STATS
ALTER TABLE STATS ADD CONSTRAINT FK_STATS_HABITAT FOREIGN KEY (fk_habitat) REFERENCES HABITAT(idHabitat) ON DELETE CASCADE
;

-- REM ***** SCENARIO_CEMAC
ALTER TABLE SCENARIO_CEMAC ADD CONSTRAINT FK_SCENARIO_CEMAC_SCENARIO FOREIGN KEY (fk_scenario) REFERENCES SCENARIO(nom) ON DELETE CASCADE
;
ALTER TABLE SCENARIO_CEMAC ADD CONSTRAINT FK_SCENARIO_CEMAC_CEMAC FOREIGN KEY (fk_CeMAC) REFERENCES CEMAC(numeroSerie) ON DELETE CASCADE
;

-- REM ************************* FIN CONSTRAINTS ********************************

-- REM ************************* DATAS ******************************************

-- REM ***** QUESTIONS
INSERT INTO QUESTIONS(question,reponse) VALUES("Comment je peux créer mon compte ?","Pour créer  votre compte, vous devez renseigner votre adresse email et choisir un mot de passe respectant le format imposé. Vous devez ensuite renseigner le numéro de série du CeMAC préalablement acheté.");
INSERT INTO QUESTIONS(question,reponse) VALUES("Comment puis-je me procurer un CeMAC ?","Les capteurs CeMAC sont disponibles sur le site de DomISEP à l'adresse suivante : www.domisep.fr/products/");
INSERT INTO QUESTIONS(question,reponse) VALUES("Je ne retrouve plus les identifiants de mon compte, que dois-je faire ?","Veuillez en informer l'administrateur du site via l'onglet 'Contactez-nous'. Certaines informations personnelles seront requises pour votre identification.");
INSERT INTO QUESTIONS(question,reponse) VALUES("Comment modifier les informations de mon compte ?","Connectez vous avec vos identifiants actuels et allez dans l'onglet 'Mon Compte' afin de modifier les données de votre compte.");
INSERT INTO QUESTIONS(question,reponse) VALUES("Mon CeMAC est en panne ou cassé que faire ?","Veuillez en informer l'administrateur du site via l'onglet 'Contactez-nous'. Un professionnel sera mis à votre disposition pour vérifier votre installation. Il effectuera les réparations nécessaires.");
INSERT INTO QUESTIONS(question,reponse) VALUES("Je suis promoteur immobilier, comment mettre en place les installations chez les locataires ?","Veuillez contacter l'administrateur du site via l'onglet 'Contactez-nous' pour mettre en place l'installation des produits.");




-- REM ***** UTILISATEUR
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.admin@gmail.com","Hmatico","admin",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.mairie@gmail.com","Hmatico","maire",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.promoteur@gmail.com","Hmatico","promoteur",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.user@gmail.com","Hmatico","user",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.maintenance@gmail.com","Hmatico","maintenance",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);

-- REM ***** HABITAT
INSERT INTO PARAMETRE VALUES ();
INSERT INTO PARAMETRE VALUES ();

-- REM ***** PIECE
INSERT INTO PIECE VALUES ();

-- REM ***** SCENARIO
INSERT INTO SCENARIO VALUES ();

-- REM ***** CEMAc
INSERT INTO CEMAC VALUES ();

-- REM ***** PARAMETRE
INSERT INTO PARAMETRE VALUES ();

-- REM ***** SCENARIO_UTILISATEUR
INSERT INTO SCENARIO_UTILISATEUR VALUES ();

-- REM ***** SCENARIO_CEMAC
INSERT INTO SCENARIO_CEMAC VALUES ();
-- REM ************************* FIN DATAS **************************************