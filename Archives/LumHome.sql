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