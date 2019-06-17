
DROP DATABASE IF EXISTS base_lumhome;
CREATE DATABASE base_lumhome CHARACTER SET utf8 COLLATE utf8_bin;
DROP USER IF EXISTS 'serveur';
CREATE USER 'serveur' IDENTIFIED BY 'qmhd"rfhb1A$64!';
GRANT SELECT,INSERT,DELETE,UPDATE ON base_lumhome.* TO serveur;
USE base_lumhome;
-- REM **************************************************************************
-- REM Base : BASE_LUMHOME
-- REM Auteur : Mathieu VALENTIN
-- REM Group : G2B
-- REM Date de Mise à Jour : 08/10/2019
-- REM **************************************************************************

-- REM ************************* DROP *******************************************
DROP TABLE IF EXISTS CGU;
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
	couleur VARCHAR(6),
	adresseMac CHAR(17) NOT NULL,
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

-- REM ***** CREATE TABLE CGU
CREATE TABLE CGU (
	id_cgu INT(100) PRIMARY KEY AUTO_INCREMENT,
    partie LONGTEXT NOT NULL,
	texte LONGTEXT NOT NULL
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

-- REM ***** QUESTIONS
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 1 : Objet"," Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla imperdiet odio at vehicula. Praesent tincidunt diam sed sollicitudin ornare. Mauris ac rutrum elit. Fusce accumsan enim vitae nulla sagittis fermentum. Aenean in nunc porttitor, rhoncus dolor eu, aliquam est. Phasellus faucibus, enim id imperdiet ornare, nunc metus faucibus justo, eget posuere sapien libero ac orci. In lectus tellus, eleifend non ex a, commodo posuere nisi. Etiam ligula libero, viverra in varius at, bibendum a orci. Aenean quis lacus at arcu aliquet maximus at sit amet leo. Vivamus sit amet urna et dui vehicula malesuada vitae id leo. Nulla at nisl lectus. Sed congue facilisis diam non fringilla. Donec ut vulputate massa. Etiam lacinia erat ac erat laoreet laoreet. Integer porttitor massa ut erat finibus, in pharetra nibh finibus.

Donec gravida placerat massa eget egestas. Cras scelerisque mi et ipsum iaculis, id tempor eros mollis. Aliquam libero turpis, vestibulum pharetra eros at, posuere aliquet diam. Suspendisse potenti. Cras tortor felis, egestas id metus lacinia, tincidunt scelerisque enim. Sed ultrices dui a blandit luctus. Donec eu massa sem.

Phasellus gravida laoreet placerat. Vivamus bibendum in metus eget dapibus. Donec ac justo sollicitudin, convallis ex a, pharetra tortor. Curabitur sagittis lacinia accumsan. Vivamus non justo bibendum tortor ornare aliquet et eget lorem. Suspendisse consequat diam quis consectetur tempus. Nunc ante metus, varius a augue at, suscipit pharetra dolor. Sed et odio ligula. Nulla commodo nibh diam, ut iaculis odio porta in. Etiam malesuada dui ac ex semper, a dignissim mi ultricies. Fusce ornare tincidunt maximus. Etiam vulputate molestie diam, et lobortis lectus pretium in. Nulla facilisis sapien eget felis molestie aliquam. Pellentesque placerat metus vitae purus scelerisque dapibus. Mauris sit amet metus sit amet tellus suscipit gravida. Suspendisse suscipit elementum aliquam. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 2 : Mentions légales"," Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla imperdiet odio at vehicula. Praesent tincidunt diam sed sollicitudin ornare. Mauris ac rutrum elit. Fusce accumsan enim vitae nulla sagittis fermentum. Aenean in nunc porttitor, rhoncus dolor eu, aliquam est. Phasellus faucibus, enim id imperdiet ornare, nunc metus faucibus justo, eget posuere sapien libero ac orci. In lectus tellus, eleifend non ex a, commodo posuere nisi. Etiam ligula libero, viverra in varius at, bibendum a orci. Aenean quis lacus at arcu aliquet maximus at sit amet leo. Vivamus sit amet urna et dui vehicula malesuada vitae id leo. Nulla at nisl lectus. Sed congue facilisis diam non fringilla. Donec ut vulputate massa. Etiam lacinia erat ac erat laoreet laoreet. Integer porttitor massa ut erat finibus, in pharetra nibh finibus.

Donec gravida placerat massa eget egestas. Cras scelerisque mi et ipsum iaculis, id tempor eros mollis. Aliquam libero turpis, vestibulum pharetra eros at, posuere aliquet diam. Suspendisse potenti. Cras tortor felis, egestas id metus lacinia, tincidunt scelerisque enim. Sed ultrices dui a blandit luctus. Donec eu massa sem.

Phasellus gravida laoreet placerat. Vivamus bibendum in metus eget dapibus. Donec ac justo sollicitudin, convallis ex a, pharetra tortor. Curabitur sagittis lacinia accumsan. Vivamus non justo bibendum tortor ornare aliquet et eget lorem. Suspendisse consequat diam quis consectetur tempus. Nunc ante metus, varius a augue at, suscipit pharetra dolor. Sed et odio ligula. Nulla commodo nibh diam, ut iaculis odio porta in. Etiam malesuada dui ac ex semper, a dignissim mi ultricies. Fusce ornare tincidunt maximus. Etiam vulputate molestie diam, et lobortis lectus pretium in. Nulla facilisis sapien eget felis molestie aliquam. Pellentesque placerat metus vitae purus scelerisque dapibus. Mauris sit amet metus sit amet tellus suscipit gravida. Suspendisse suscipit elementum aliquam. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 3 : Définitions","Nullam sollicitudin non justo mattis facilisis. Curabitur et ornare urna, at malesuada velit. Sed condimentum turpis quis lorem laoreet, non ornare mi pulvinar. Etiam at ligula ut tortor rhoncus luctus ut vitae mi. Nam vehicula sem quis eros suscipit, sed auctor turpis laoreet. Nulla auctor ut leo quis blandit. Donec non dolor a urna aliquam volutpat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In cursus elementum eleifend. Aliquam mattis augue sed lacus rhoncus, eget dapibus diam auctor. Ut nibh orci, interdum a mattis id, auctor sit amet sapien. Praesent mattis suscipit arcu, a semper sem lobortis id. Vivamus eget aliquam ipsum. Duis rhoncus turpis tortor, vitae pulvinar neque dignissim eget. Donec vulputate orci eget sollicitudin finibus. Vivamus eu nisi sit amet libero finibus volutpat. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 4 : accès aux services","Nullam sollicitudin non justo mattis facilisis. Curabitur et ornare urna, at malesuada velit. Sed condimentum turpis quis lorem laoreet, non ornare mi pulvinar. Etiam at ligula ut tortor rhoncus luctus ut vitae mi. Nam vehicula sem quis eros suscipit, sed auctor turpis laoreet. Nulla auctor ut leo quis blandit. Donec non dolor a urna aliquam volutpat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In cursus elementum eleifend. Aliquam mattis augue sed lacus rhoncus, eget dapibus diam auctor. Ut nibh orci, interdum a mattis id, auctor sit amet sapien. Praesent mattis suscipit arcu, a semper sem lobortis id. Vivamus eget aliquam ipsum. Duis rhoncus turpis tortor, vitae pulvinar neque dignissim eget. Donec vulputate orci eget sollicitudin finibus. Vivamus eu nisi sit amet libero finibus volutpat. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 5 : Propriété intellectuelle","Nullam sollicitudin non justo mattis facilisis. Curabitur et ornare urna, at malesuada velit. Sed condimentum turpis quis lorem laoreet, non ornare mi pulvinar. Etiam at ligula ut tortor rhoncus luctus ut vitae mi. Nam vehicula sem quis eros suscipit, sed auctor turpis laoreet. Nulla auctor ut leo quis blandit. Donec non dolor a urna aliquam volutpat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In cursus elementum eleifend. Aliquam mattis augue sed lacus rhoncus, eget dapibus diam auctor. Ut nibh orci, interdum a mattis id, auctor sit amet sapien. Praesent mattis suscipit arcu, a semper sem lobortis id. Vivamus eget aliquam ipsum. Duis rhoncus turpis tortor, vitae pulvinar neque dignissim eget. Donec vulputate orci eget sollicitudin finibus. Vivamus eu nisi sit amet libero finibus volutpat. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 6 : Données personnelles","Phasellus gravida laoreet placerat. Vivamus bibendum in metus eget dapibus. Donec ac justo sollicitudin, convallis ex a, pharetra tortor. Curabitur sagittis lacinia accumsan. Vivamus non justo bibendum tortor ornare aliquet et eget lorem. Suspendisse consequat diam quis consectetur tempus. Nunc ante metus, varius a augue at, suscipit pharetra dolor. Sed et odio ligula. Nulla commodo nibh diam, ut iaculis odio porta in. Etiam malesuada dui ac ex semper, a dignissim mi ultricies. Fusce ornare tincidunt maximus. Etiam vulputate molestie diam, et lobortis lectus pretium in. Nulla facilisis sapien eget felis molestie aliquam. Pellentesque placerat metus vitae purus scelerisque dapibus. Mauris sit amet metus sit amet tellus suscipit gravida. Suspendisse suscipit elementum aliquam. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 7 : Responsabilité et force majeure","Phasellus gravida laoreet placerat. Vivamus bibendum in metus eget dapibus. Donec ac justo sollicitudin, convallis ex a, pharetra tortor. Curabitur sagittis lacinia accumsan. Vivamus non justo bibendum tortor ornare aliquet et eget lorem. Suspendisse consequat diam quis consectetur tempus. Nunc ante metus, varius a augue at, suscipit pharetra dolor. Sed et odio ligula. Nulla commodo nibh diam, ut iaculis odio porta in. Etiam malesuada dui ac ex semper, a dignissim mi ultricies. Fusce ornare tincidunt maximus. Etiam vulputate molestie diam, et lobortis lectus pretium in. Nulla facilisis sapien eget felis molestie aliquam. Pellentesque placerat metus vitae purus scelerisque dapibus. Mauris sit amet metus sit amet tellus suscipit gravida. Suspendisse suscipit elementum aliquam. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 8 : Liens hypertextes","Donec gravida placerat massa eget egestas. Cras scelerisque mi et ipsum iaculis, id tempor eros mollis. Aliquam libero turpis, vestibulum pharetra eros at, posuere aliquet diam. Suspendisse potenti. Cras tortor felis, egestas id metus lacinia, tincidunt scelerisque enim. Sed ultrices dui a blandit luctus. Donec eu massa sem. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 9 : Évolution du contrat","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla imperdiet odio at vehicula. Praesent tincidunt diam sed sollicitudin ornare. Mauris ac rutrum elit. Fusce accumsan enim vitae nulla sagittis fermentum. Aenean in nunc porttitor, rhoncus dolor eu, aliquam est. Phasellus faucibus, enim id imperdiet ornare, nunc metus faucibus justo, eget posuere sapien libero ac orci. In lectus tellus, eleifend non ex a, commodo posuere nisi. Etiam ligula libero, viverra in varius at, bibendum a orci. Aenean quis lacus at arcu aliquet maximus at sit amet leo. Vivamus sit amet urna et dui vehicula malesuada vitae id leo. Nulla at nisl lectus. Sed congue facilisis diam non fringilla. Donec ut vulputate massa. Etiam lacinia erat ac erat laoreet laoreet. Integer porttitor massa ut erat finibus, in pharetra nibh finibus. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 10 : Durée","Donec gravida placerat massa eget egestas. Cras scelerisque mi et ipsum iaculis, id tempor eros mollis. Aliquam libero turpis, vestibulum pharetra eros at, posuere aliquet diam. Suspendisse potenti. Cras tortor felis, egestas id metus lacinia, tincidunt scelerisque enim. Sed ultrices dui a blandit luctus. Donec eu massa sem. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 11 : Droit applicable et juridiction compétente","Donec gravida placerat massa eget egestas. Cras scelerisque mi et ipsum iaculis, id tempor eros mollis. Aliquam libero turpis, vestibulum pharetra eros at, posuere aliquet diam. Suspendisse potenti. Cras tortor felis, egestas id metus lacinia, tincidunt scelerisque enim. Sed ultrices dui a blandit luctus. Donec eu massa sem. ");
INSERT INTO CGU(partie,texte) VALUES("ARTICLE 12 : Publication par l'Utilisateur","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla imperdiet odio at vehicula. Praesent tincidunt diam sed sollicitudin ornare. Mauris ac rutrum elit. Fusce accumsan enim vitae nulla sagittis fermentum. Aenean in nunc porttitor, rhoncus dolor eu, aliquam est. Phasellus faucibus, enim id imperdiet ornare, nunc metus faucibus justo, eget posuere sapien libero ac orci. In lectus tellus, eleifend non ex a, commodo posuere nisi. Etiam ligula libero, viverra in varius at, bibendum a orci. Aenean quis lacus at arcu aliquet maximus at sit amet leo. Vivamus sit amet urna et dui vehicula malesuada vitae id leo. Nulla at nisl lectus. Sed congue facilisis diam non fringilla. Donec ut vulputate massa. Etiam lacinia erat ac erat laoreet laoreet. Integer porttitor massa ut erat finibus, in pharetra nibh finibus. ");

-- REM ***** UTILISATEUR
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.matico@gmail.com","Hmatico","admin",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.mairie@gmail.com","Hmatico","maire",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.promoteur@gmail.com","Hmatico","promoteur",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.user@gmail.com","Hmatico","user",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) VALUES("h.maintenance@gmail.com","Hmatico","maintenance",'$argon2i$v=19$m=1024,t=2,p=2$MFExUmJVRHlVYk1GaHNreA$7aRpebR+chLtj8IZVl+lZit/gQA9Snxz7keCVYXQVuQ',"0000",false);
INSERT INTO UTILISATEUR(adresseMail, nomUser,type, mdpUser,pin,actif) 
VALUES("stats@gmail.com","Stats","user",'$argon2i$v=19$m=1024,t=2,p=2$QTJKc2E2NDQybm4ybXpnVw$tWL2WwvjXyBjymda5359XMihs+BFhF8bTcpwrxiWYaU',"0000",false);

-- REM ***** HABITAT
INSERT INTO `habitat` (`idHabitat`, `nomHabitat`, `numero`, `rue`, `complement`, `ville`, `codePostal`, `fk_proprietaire`) VALUES
(1, 'Maison de Mathieu', '12', 'rue de pierre', NULL, 'best ville', 12345, 'h.user@gmail.com');

-- REM ***** PIECE
INSERT INTO `piece` (`idPiece`, `type`, `nom`, `fk_habitat`) VALUES
(1, 'Detente', 'Cuisine', 1),
(2, 'Noel', 'Chambre', 1);

-- REM ***** CEMAC
INSERT INTO `cemac` (`numeroSerie`, `adresseMac`, `type`, `panne`, `fk_piece`) VALUES
('A02B01', '01:82:C2:70:01:7B', 'ampoule', 0, 1),
('A02B00', '01:82:C2:70:01:7B', 'moteur', 0, 1);

-- REM ***** SCENARIO
INSERT INTO `scenario` (`nom`, `dateDebut`, `dateFin`, `statut`, `scenario`, `type`, `fk_proprietaire`) VALUES
('Cuisine Detente', NULL, NULL, 0, 'Allume la cuisine et detente', 'Detente', 'h.user@gmail.com'),
('Noel dans le salon', NULL, NULL, 1, '', 'Noel', 'h.user@gmail.com');

-- REM ***** SCENARIO_CEMAC
INSERT INTO `scenario_cemac` (`fk_scenario`, `fk_CeMAC`, `valeurIntensite`, `valeurCouleur`) VALUES
('Cuisine Detente', 'A02B01', 70, '123456'),
('Noel dans le salon', 'A02B00', 12, '753654');

-- REM ***** STATS
INSERT INTO `stats` (`fk_habitat`,`dateStat`,`nbrHeuresInutiles`) VALUES
('1','2018-6-1','14'),
('1','2018-6-2','10'),
('1','2018-6-3','2'),
('1','2018-6-4','7'),
('1','2018-6-5','21'),
('1','2018-6-6','14'),
('1','2018-6-7','14'),
('1','2018-6-8','13'),
('1','2018-6-9','13'),
('1','2018-6-10','5'),
('1','2018-6-11','2'),
('1','2018-6-12','0'),
('1','2018-6-13','5'),
('1','2018-6-14','5'),
('1','2018-6-15','12'),
('1','2018-6-16','13'),
('1','2018-6-17','7'),
('1','2018-6-18','7'),
('1','2018-6-19','18'),
('1','2018-6-20','12'),
('1','2018-6-21','22'),
('1','2018-6-22','0'),
('1','2018-6-23','15'),
('1','2018-6-24','7'),
('1','2018-6-25','5'),
('1','2018-6-26','11'),
('1','2018-6-27','1'),
('1','2018-6-28','0'),
('1','2018-6-29','6'),
('1','2018-6-30','0'),
('1','2018-7-1','13'),
('1','2018-7-2','12'),
('1','2018-7-3','15'),
('1','2018-7-4','2'),
('1','2018-7-5','15'),
('1','2018-7-6','14'),
('1','2018-7-7','0'),
('1','2018-7-8','18'),
('1','2018-7-9','2'),
('1','2018-7-10','0'),
('1','2018-7-11','2'),
('1','2018-7-12','4'),
('1','2018-7-13','6'),
('1','2018-7-14','12'),
('1','2018-7-15','21'),
('1','2018-7-16','0'),
('1','2018-7-17','1'),
('1','2018-7-18','19'),
('1','2018-7-19','1'),
('1','2018-7-20','17'),
('1','2018-7-21','14'),
('1','2018-7-22','0'),
('1','2018-7-23','6'),
('1','2018-7-24','13'),
('1','2018-7-25','0'),
('1','2018-7-26','9'),
('1','2018-7-27','7'),
('1','2018-7-28','10'),
('1','2018-7-29','10'),
('1','2018-7-30','14'),
('1','2018-7-31','15'),
('1','2018-8-1','16'),
('1','2018-8-2','9'),
('1','2018-8-3','9'),
('1','2018-8-4','1'),
('1','2018-8-5','5'),
('1','2018-8-6','27'),
('1','2018-8-7','10'),
('1','2018-8-8','22'),
('1','2018-8-9','9'),
('1','2018-8-10','7'),
('1','2018-8-11','15'),
('1','2018-8-12','1'),
('1','2018-8-13','6'),
('1','2018-8-14','6'),
('1','2018-8-15','16'),
('1','2018-8-16','11'),
('1','2018-8-17','14'),
('1','2018-8-18','14'),
('1','2018-8-19','27'),
('1','2018-8-20','5'),
('1','2018-8-21','8'),
('1','2018-8-22','16'),
('1','2018-8-23','0'),
('1','2018-8-24','16'),
('1','2018-8-25','17'),
('1','2018-8-26','22'),
('1','2018-8-27','14'),
('1','2018-8-28','13'),
('1','2018-8-29','11'),
('1','2018-8-30','10'),
('1','2018-8-31','24'),
('1','2018-9-1','7'),
('1','2018-9-2','12'),
('1','2018-9-3','0'),
('1','2018-9-4','2'),
('1','2018-9-5','9'),
('1','2018-9-6','10'),
('1','2018-9-7','9'),
('1','2018-9-8','18'),
('1','2018-9-9','2'),
('1','2018-9-10','8'),
('1','2018-9-11','6'),
('1','2018-9-12','21'),
('1','2018-9-13','7'),
('1','2018-9-14','20'),
('1','2018-9-15','5'),
('1','2018-9-16','36'),
('1','2018-9-17','17'),
('1','2018-9-18','17'),
('1','2018-9-19','19'),
('1','2018-9-20','9'),
('1','2018-9-21','16'),
('1','2018-9-22','19'),
('1','2018-9-23','2'),
('1','2018-9-24','15'),
('1','2018-9-25','7'),
('1','2018-9-26','27'),
('1','2018-9-27','31'),
('1','2018-9-28','10'),
('1','2018-9-29','9'),
('1','2018-9-30','12'),
('1','2018-10-1','13'),
('1','2018-10-2','25'),
('1','2018-10-3','4'),
('1','2018-10-4','16'),
('1','2018-10-5','17'),
('1','2018-10-6','26'),
('1','2018-10-7','0'),
('1','2018-10-8','17'),
('1','2018-10-9','15'),
('1','2018-10-10','8'),
('1','2018-10-11','1'),
('1','2018-10-12','21'),
('1','2018-10-13','12'),
('1','2018-10-14','5'),
('1','2018-10-15','13'),
('1','2018-10-16','2'),
('1','2018-10-17','24'),
('1','2018-10-18','17'),
('1','2018-10-19','15'),
('1','2018-10-20','28'),
('1','2018-10-21','2'),
('1','2018-10-22','13'),
('1','2018-10-23','13'),
('1','2018-10-24','5'),
('1','2018-10-25','0'),
('1','2018-10-26','2'),
('1','2018-10-27','1'),
('1','2018-10-28','2'),
('1','2018-10-29','18'),
('1','2018-10-30','14'),
('1','2018-10-31','16'),
('1','2018-11-1','25'),
('1','2018-11-2','14'),
('1','2018-11-3','10'),
('1','2018-11-4','6'),
('1','2018-11-5','0'),
('1','2018-11-6','15'),
('1','2018-11-7','9'),
('1','2018-11-8','6'),
('1','2018-11-9','15'),
('1','2018-11-10','24'),
('1','2018-11-11','0'),
('1','2018-11-12','4'),
('1','2018-11-13','10'),
('1','2018-11-14','13'),
('1','2018-11-15','19'),
('1','2018-11-16','2'),
('1','2018-11-17','11'),
('1','2018-11-18','5'),
('1','2018-11-19','15'),
('1','2018-11-20','8'),
('1','2018-11-21','7'),
('1','2018-11-22','6'),
('1','2018-11-23','2'),
('1','2018-11-24','9'),
('1','2018-11-25','16'),
('1','2018-11-26','19'),
('1','2018-11-27','5'),
('1','2018-11-28','11'),
('1','2018-11-29','0'),
('1','2018-11-30','9'),
('1','2018-12-1','0'),
('1','2018-12-2','15'),
('1','2018-12-3','5'),
('1','2018-12-4','12'),
('1','2018-12-5','9'),
('1','2018-12-6','4'),
('1','2018-12-7','23'),
('1','2018-12-8','1'),
('1','2018-12-9','11'),
('1','2018-12-10','22'),
('1','2018-12-11','26'),
('1','2018-12-12','5'),
('1','2018-12-13','4'),
('1','2018-12-14','19'),
('1','2018-12-15','12'),
('1','2018-12-16','11'),
('1','2018-12-17','17'),
('1','2018-12-18','11'),
('1','2018-12-19','8'),
('1','2018-12-20','17'),
('1','2018-12-21','6'),
('1','2018-12-22','8'),
('1','2018-12-23','14'),
('1','2018-12-24','7'),
('1','2018-12-25','9'),
('1','2018-12-26','12'),
('1','2018-12-27','0'),
('1','2018-12-28','8'),
('1','2018-12-29','6'),
('1','2018-12-30','8'),
('1','2018-12-31','9'),
('1','2019-1-1','9'),
('1','2019-1-2','2'),
('1','2019-1-3','13'),
('1','2019-1-4','12'),
('1','2019-1-5','12'),
('1','2019-1-6','7'),
('1','2019-1-7','4'),
('1','2019-1-8','11'),
('1','2019-1-9','16'),
('1','2019-1-10','0'),
('1','2019-1-11','15'),
('1','2019-1-12','24'),
('1','2019-1-13','22'),
('1','2019-1-14','5'),
('1','2019-1-15','21'),
('1','2019-1-16','25'),
('1','2019-1-17','18'),
('1','2019-1-18','10'),
('1','2019-1-19','0'),
('1','2019-1-20','13'),
('1','2019-1-21','8'),
('1','2019-1-22','24'),
('1','2019-1-23','19'),
('1','2019-1-24','10'),
('1','2019-1-25','16'),
('1','2019-1-26','19'),
('1','2019-1-27','12'),
('1','2019-1-28','5'),
('1','2019-1-29','18'),
('1','2019-1-30','22'),
('1','2019-1-31','6'),
('1','2019-2-1','12'),
('1','2019-2-2','13'),
('1','2019-2-3','24'),
('1','2019-2-4','15'),
('1','2019-2-5','13'),
('1','2019-2-6','24'),
('1','2019-2-7','12'),
('1','2019-2-8','22'),
('1','2019-2-9','11'),
('1','2019-2-10','25'),
('1','2019-2-11','16'),
('1','2019-2-12','16'),
('1','2019-2-13','13'),
('1','2019-2-14','8'),
('1','2019-2-15','5'),
('1','2019-2-16','18'),
('1','2019-2-17','9'),
('1','2019-2-18','0'),
('1','2019-2-19','17'),
('1','2019-2-20','13'),
('1','2019-2-21','18'),
('1','2019-2-22','1'),
('1','2019-2-23','16'),
('1','2019-2-24','20'),
('1','2019-2-25','4');

-- REM ***** PARAMETRE
INSERT INTO PARAMETRE VALUES ();
-- REM ************************* FIN DATAS **************************************