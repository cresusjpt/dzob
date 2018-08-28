/*
SQLyog Professional v12.09 (64 bit)
MySQL - 10.1.16-MariaDB : Database - dzob_poweramc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dzob_poweramc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dzob_poweramc`;

/*Table structure for table `action` */

DROP TABLE IF EXISTS `action`;

CREATE TABLE `action` (
  `CODE_ACTION` varchar(25) NOT NULL,
  `LIB_ACTION` varchar(100) NOT NULL,
  PRIMARY KEY (`CODE_ACTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `action` */

insert  into `action`(`CODE_ACTION`,`LIB_ACTION`) values ('CREATE','Enregistrement'),('DELETE','Suppression'),('PRINT','Impression'),('SELECT','Consultation'),('UPDATE','Modification');

/*Table structure for table `avoir` */

DROP TABLE IF EXISTS `avoir`;

CREATE TABLE `avoir` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_AYANTDROIT` int(11) NOT NULL,
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_AYANTDROIT`,`REFERENCE_PATRIMOINE`),
  KEY `FK_AVOIR3` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_AVOIR` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `immobilier` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_AVOIR2` FOREIGN KEY (`ID_PERSONNE`, `ID_AYANTDROIT`) REFERENCES `ayant_droit` (`ID_PERSONNE`, `ID_AYANTDROIT`),
  CONSTRAINT `FK_AVOIR3` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `mobilier` (`REFERENCE_PATRIMOINE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `avoir` */

/*Table structure for table `ayant_droit` */

DROP TABLE IF EXISTS `ayant_droit`;

CREATE TABLE `ayant_droit` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_AYANTDROIT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(100) DEFAULT NULL,
  `SEXE` varchar(1) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `ADRESSE` varchar(200) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_AYANTDROIT`),
  KEY `ID_AYANTDROIT` (`ID_AYANTDROIT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ayant_droit` */

insert  into `ayant_droit`(`ID_PERSONNE`,`ID_AYANTDROIT`,`NOM`,`PRENOM`,`SEXE`,`TELEPHONE`,`ADRESSE`,`DATE_NAISSANCE`) values (0,1,'QUENUM','Oremione','M','11455803','LOME','2018-08-02'),(0,2,'GAME','RIO','F','11455803','LOME','2009-11-13');

/*Table structure for table `classeur` */

DROP TABLE IF EXISTS `classeur`;

CREATE TABLE `classeur` (
  `ID_CLASSEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CLASSEUR` varchar(50) NOT NULL,
  `DATE_CLASSEUR` date NOT NULL,
  PRIMARY KEY (`ID_CLASSEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `classeur` */

insert  into `classeur`(`ID_CLASSEUR`,`NOM_CLASSEUR`,`DATE_CLASSEUR`) values (1,'CONTRAT DE VENTE','2018-04-01'),(2,'HERITAGE','2016-05-28'),(3,'SUCCESION','2018-08-18');

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(100) DEFAULT NULL,
  `SEXE` varchar(1) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `ADRESSE` varchar(200) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `TYPE_CLIENT` enum('PHYSIQUE','MORALE') NOT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`ID_CLIENT`),
  KEY `ID_CLIENT` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `client` */

insert  into `client`(`ID_PERSONNE`,`ID_CLIENT`,`NOM`,`PRENOM`,`SEXE`,`TELEPHONE`,`ADRESSE`,`DATE_NAISSANCE`,`TYPE_CLIENT`) values (0,1,'client','test','M','11225544','ATTIEGOU','2018-01-01','MORALE'),(0,2,'BAT','TOGO','M','44558899','lome','2018-01-25','MORALE'),(0,3,'KOKOUVI','AFIAVI','M','11225544','BE','1995-01-01','PHYSIQUE'),(0,4,'PAUL','WALKER','F','95864712','lome','2018-08-25','MORALE');

/*Table structure for table `contenir` */

DROP TABLE IF EXISTS `contenir`;

CREATE TABLE `contenir` (
  `ID_DOC` int(11) NOT NULL,
  `ID_META` int(11) NOT NULL,
  PRIMARY KEY (`ID_DOC`,`ID_META`),
  KEY `FK_CONTENIR` (`ID_META`),
  CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`ID_META`) REFERENCES `metadonnee` (`ID_META`),
  CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`ID_DOC`) REFERENCES `document` (`ID_DOC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contenir` */

/*Table structure for table `courrier` */

DROP TABLE IF EXISTS `courrier`;

CREATE TABLE `courrier` (
  `REFERENCE` varchar(11) NOT NULL,
  `ACTEUR_COURRIER` varchar(250) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_PRIORITE` int(11) NOT NULL,
  `ID_TYPECOURRIER` int(11) NOT NULL,
  `DATE` date NOT NULL,
  `OBJET_COURRIER` varchar(200) NOT NULL,
  `CONTENU_COURRIER` text,
  PRIMARY KEY (`REFERENCE`),
  KEY `FK_ASSOCIATION_9` (`ID_PRIORITE`),
  KEY `FK_ENVOYER3` (`ID_PERSONNE`),
  KEY `FK_ETRE_DE` (`ID_TYPECOURRIER`),
  CONSTRAINT `FK_ASSOCIATION_9` FOREIGN KEY (`ID_PRIORITE`) REFERENCES `priorite_courrier` (`ID_PRIORITE`),
  CONSTRAINT `FK_ENVOYER` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `utilisateur` (`ID_PERSONNE`),
  CONSTRAINT `FK_ENVOYER2` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `client` (`ID_PERSONNE`),
  CONSTRAINT `FK_ENVOYER3` FOREIGN KEY (`ID_PERSONNE`) REFERENCES `ayant_droit` (`ID_PERSONNE`),
  CONSTRAINT `FK_ETRE_DE` FOREIGN KEY (`ID_TYPECOURRIER`) REFERENCES `type_courrier` (`ID_TYPECOURRIER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `courrier` */

insert  into `courrier`(`REFERENCE`,`ACTEUR_COURRIER`,`ID_PERSONNE`,`ID_PRIORITE`,`ID_TYPECOURRIER`,`DATE`,`OBJET_COURRIER`,`CONTENU_COURRIER`) values ('REF','JEANPAUL AHIABOU',0,1,2,'2018-08-18','DEMANDE DE PARRAINAGE',NULL),('REF01','JEANPAUL AHIABOU',0,1,1,'2018-09-01','DEMANDE DE PARRAINAGE 2',NULL),('REF010','JEANPAUL AHIABOU',0,1,1,'2018-08-30','DEMANDE DE PARRAINAGE 3','Un contenu aussi farfelu que je le suis');

/*Table structure for table `document` */

DROP TABLE IF EXISTS `document`;

CREATE TABLE `document` (
  `ID_DOC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOSSIER` int(11) NOT NULL,
  `TITRE_DOC` varchar(50) NOT NULL,
  `DESCRIPTION_DOC` varchar(5000) NOT NULL,
  `DATE_DOC` date NOT NULL,
  `DATE_EFFECTIVE` date DEFAULT NULL,
  `CREATEUR` varchar(50) NOT NULL,
  `SOURCE` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_DOC`),
  KEY `ID_DOSSIER` (`ID_DOSSIER`),
  CONSTRAINT `document_ibfk_1` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `document` */

insert  into `document`(`ID_DOC`,`ID_DOSSIER`,`TITRE_DOC`,`DESCRIPTION_DOC`,`DATE_DOC`,`DATE_EFFECTIVE`,`CREATEUR`,`SOURCE`) values (1,3,'sdsdsd','dsdsdsdsdsd','2018-08-24','2018-08-24','dsdsdsds','uploads/documents/sdsdsd_2018-08-24.accdb'),(2,1,'prions','prions ensemble avant de dormir','2018-08-24','2018-08-24','prieur','uploads/documents/prions_2018-08-24.docx'),(4,1,'COMPTE RENDU','Compte rendu de la reunion entre la collectivité AGBASSOU et le notaire en présence de la sécretaire et de la banque atlantique togo','2018-08-30','2018-08-24','jeanpaul','uploads/documents/COMPTE RENDU_2018-08-24.docx'),(5,10,'again companies','agoin','2018-08-30','2018-08-25','jeanpaul','uploads/documents/again companies_2018-08-25.pdf');

/*Table structure for table `dossier` */

DROP TABLE IF EXISTS `dossier`;

CREATE TABLE `dossier` (
  `ID_DOSSIER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLASSEUR` int(11) NOT NULL,
  `ID_PERSONNE` int(11) DEFAULT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `DOS_ID_DOSSIER` int(11) DEFAULT NULL,
  `LIBELLE_DOSSIER` varchar(50) NOT NULL,
  `COMMENTAIRE_DOSSIER` varchar(500) NOT NULL,
  `DATE_CREATION` date NOT NULL,
  `DATE_DMDOSSIER` datetime DEFAULT NULL,
  `FRAIS_DOSSIER` float(10,4) NOT NULL,
  `ETAT_DOSSIER_TRAITEMENT` tinyint(1) NOT NULL,
  `STATUT_DOSSIER` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_DOSSIER`),
  KEY `FK_CLASSER` (`ID_CLASSEUR`),
  KEY `FK_DETENIR` (`ID_PERSONNE`,`ID_CLIENT`),
  KEY `FK_PARENTER_DOSSIER` (`DOS_ID_DOSSIER`),
  CONSTRAINT `FK_CLASSER` FOREIGN KEY (`ID_CLASSEUR`) REFERENCES `classeur` (`ID_CLASSEUR`),
  CONSTRAINT `FK_DETENIR` FOREIGN KEY (`ID_PERSONNE`, `ID_CLIENT`) REFERENCES `client` (`ID_PERSONNE`, `ID_CLIENT`),
  CONSTRAINT `FK_PARENTER_DOSSIER` FOREIGN KEY (`DOS_ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `dossier` */

insert  into `dossier`(`ID_DOSSIER`,`ID_CLASSEUR`,`ID_PERSONNE`,`ID_CLIENT`,`DOS_ID_DOSSIER`,`LIBELLE_DOSSIER`,`COMMENTAIRE_DOSSIER`,`DATE_CREATION`,`DATE_DMDOSSIER`,`FRAIS_DOSSIER`,`ETAT_DOSSIER_TRAITEMENT`,`STATUT_DOSSIER`) values (1,1,NULL,2,NULL,'contrat de vente gr','je suis pas cool','2018-01-01',NULL,1455.0000,0,'NICHT'),(2,1,NULL,3,1,'contrat sarl','sais plus quoi ecrire','2018-01-01','2018-08-22 16:18:27',19500.0000,0,'dude'),(3,1,NULL,2,NULL,'news','dsdsdsdsds very cool','2018-01-01',NULL,15000.0000,0,'NICHT dude'),(4,1,NULL,3,NULL,'ggfgfg','je suis un lion de la tribu de judée','2018-01-01','2018-08-22 16:15:55',15500.0000,0,'NICHT'),(5,2,NULL,2,NULL,'frere','bien','2018-01-01',NULL,14500.0000,0,'NICHT dude'),(6,2,NULL,3,NULL,'fleuriste','bien','2018-01-01',NULL,10000.0000,0,'NICHT'),(7,2,NULL,1,2,'sarl','bien','2018-01-01','0000-00-00 00:00:00',17000.0000,0,'NICHT'),(8,2,NULL,2,3,'terminé','bien','2018-01-01',NULL,9500.0000,1,'NICHT'),(9,2,NULL,3,2,'ENTREPRISE KOKOUVI','','2018-08-18',NULL,145000.0000,0,'ANCIEN'),(10,2,NULL,4,NULL,'DIRECTORY AGAIN','QUOI DUIRE DE PLIS','2018-08-23',NULL,474700.0000,0,'cree');

/*Table structure for table `droits` */

DROP TABLE IF EXISTS `droits`;

CREATE TABLE `droits` (
  `ID_DROITS` int(11) NOT NULL AUTO_INCREMENT,
  `ETAT_DROIT` tinyint(1) NOT NULL,
  `LIBELLE_DROIT` varchar(100) NOT NULL,
  `COMMENTAIRE_DROIT` varchar(500) DEFAULT NULL,
  `DATE_DROIT` date NOT NULL,
  `DATE_DM` date DEFAULT NULL,
  PRIMARY KEY (`ID_DROITS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `droits` */

/*Table structure for table `evenement` */

DROP TABLE IF EXISTS `evenement`;

CREATE TABLE `evenement` (
  `ID_EVENEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `LIBELLE_EVENEMENT` varchar(200) NOT NULL,
  `COMMENTAIRE_EVENEMENT` varchar(5000) DEFAULT NULL,
  `DATE_EVENEMENT` date NOT NULL,
  `ETAT_EVENEMENT` tinyint(1) NOT NULL,
  `DATE_REALISATION` date DEFAULT NULL,
  PRIMARY KEY (`ID_EVENEMENT`),
  KEY `FK_SURVENIR2` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_SURVENIR` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `immobilier` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_SURVENIR2` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `mobilier` (`REFERENCE_PATRIMOINE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `evenement` */

/*Table structure for table `fichier` */

DROP TABLE IF EXISTS `fichier`;

CREATE TABLE `fichier` (
  `ID_FICHIER` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE` varchar(11) NOT NULL,
  `NOM_FICHIER` varchar(30) NOT NULL,
  `FORMAT_FICHIER` varchar(10) DEFAULT NULL,
  `DATE_EFFECTIVE` date DEFAULT NULL,
  `CREATEUR` varchar(500) NOT NULL,
  `SOURCE` varchar(500) NOT NULL,
  PRIMARY KEY (`ID_FICHIER`),
  KEY `FK_JOINTURE` (`REFERENCE`),
  CONSTRAINT `FK_JOINTURE` FOREIGN KEY (`REFERENCE`) REFERENCES `courrier` (`REFERENCE`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `fichier` */

insert  into `fichier`(`ID_FICHIER`,`REFERENCE`,`NOM_FICHIER`,`FORMAT_FICHIER`,`DATE_EFFECTIVE`,`CREATEUR`,`SOURCE`) values (1,'REF','jhjjjh',NULL,NULL,'',''),(2,'REF01','nom DU FICHIER creer','png',NULL,'',''),(3,'REF010','bien vue','jpg',NULL,'',''),(4,'REF01','JENA','jpg',NULL,'',''),(5,'REF010','JENAPAUL','jpg',NULL,'',''),(6,'REF01','PETER CLARK','jpg',NULL,'',''),(7,'REF01','PETER CLARK','jpg',NULL,'',''),(8,'REF01','FICHIER','jpg',NULL,'',''),(9,'REF01','BISE','jpg',NULL,'',''),(10,'REF','sdsdsdsd','jpg',NULL,'',''),(11,'REF01','rriinngg','jpg',NULL,'',''),(12,'REF01','je suis fatigué de testé','pdf',NULL,'',''),(13,'REF','niet','jpg',NULL,'',''),(14,'REF01','ebboui','jpg',NULL,'',''),(15,'REF01','une derniere pour la route','jpg',NULL,'',''),(16,'REF01','une derniere pour la route 2','jpg',NULL,'',''),(17,'REF01','je m\'en fou royalement','jpg',NULL,'',''),(18,'REF01','ayooo','jpg',NULL,'',''),(19,'REF','Je suis en attente de la','jpg','2018-08-27','jeanpaul','uploads\\files\\15353310075b834abfb8eb83.48977536Je_suis_en_attente_de_la_bonne.jpg'),(20,'REF01','encore un autre pou le plaisir','jpg','2018-08-27','jeanpaul','uploads\\files\\15353313235b834bfbc41723.08358206encore_un_autre_pou_le_plaisir.jpg'),(21,'REF','wow c\'est du bleuf','jpg','2018-08-27','jeanpaul','uploads\\files\\15353314385b834c6e8b7104.79080087wow_c\'est_du_bleuf.jpg'),(22,'REF','wow c\'est du bleuf','jpg','2018-08-27','jeanpaul','uploads\\files\\15353314395b834c6f1f0ac4.55744617wow_c\'est_du_bleuf.jpg'),(23,'REF01','reference bien','docx','2018-08-27','jeanpaul','uploads\\files\\15353315535b834ce1342e11.68273920reference_bien.docx'),(24,'REF010','bella vita','docx','2018-08-27','jeanpaul','uploads\\files\\15353316225b834d26186224.82943582bella_vita.docx'),(25,'REF010','bella vita','xlwx','2018-08-27','jeanpaul','uploads\\files\\15353316225b834d267d7553.90116118bella_vita.xlwx'),(26,'REF010','bella vita','sql','2018-08-27','jeanpaul','uploads\\files\\15353316235b834d270b71b8.93477595bella_vita.sql'),(27,'REF010','bella vita','pdf','2018-08-27','jeanpaul','uploads\\files\\15353316235b834d27b4a211.94411626bella_vita.pdf'),(28,'REF01','ET MERDE','docx','2018-08-27','jeanpaul','uploads\\files\\15353325245b8350acdab695.25467741ET_MERDE.docx'),(29,'REF01','nichtter','pdf','2018-08-27','jeanpaul','uploads\\files\\15353326565b835130499ed5.98581801nichtter.pdf'),(30,'REF','jhjjjh14','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327175b83516dbe13e0.51162589jhjjjh14.pdf'),(31,'REF010','multiple','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327955b8351bb28a972.90257869multiple.pdf'),(32,'REF010','multiple','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327955b8351bb9741e6.58653010multiple.pdf'),(33,'REF010','multiple','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327965b8351bc029343.16978544multiple.pdf'),(34,'REF010','multiple','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327965b8351bc6ff354.70353750multiple.pdf'),(35,'REF010','multiple','pdf','2018-08-27','jeanpaul','uploads\\files\\15353327995b8351bf4c4e22.21831928multiple.pdf'),(36,'REF01','nom DU FICHIERrtyy','jpg','2018-08-27','jeanpaul','uploads\\files\\15353329455b835251ac22c8.29919520nom_DU_FICHIERrtyy.jpg'),(37,'REF01','nom DU FICHIERrtyy','jpg','2018-08-27','jeanpaul','uploads\\files\\15353329465b83525257aa76.74913920nom_DU_FICHIERrtyy.jpg'),(38,'REF01','nom DU FICHIERrtyy','jpg','2018-08-27','jeanpaul','uploads\\files\\15353329465b835252b8d4c8.06765723nom_DU_FICHIERrtyy.jpg'),(39,'REF01','nom DU FICHIERrtyy','png','2018-08-27','jeanpaul','uploads\\files\\15353329475b835253622956.50274720nom_DU_FICHIERrtyy.png'),(40,'REF01','nom DU FICHIERrtyy','jpg','2018-08-27','jeanpaul','uploads\\files\\15353329475b835253f2b160.10426726nom_DU_FICHIERrtyy.jpg'),(41,'REF01','nom DU FICHIERvenue','jpg','2018-08-27','jeanpaul','uploads\\files\\15353329485b8352549147c7.73958940nom_DU_FICHIERrtyy.jpg'),(42,'REF','lundi matin','pdf','2018-08-27','jeanpaul','uploads\\files\\15353862815b8422a9f0c1f4.49044302lundi_matin.pdf'),(43,'REF','lundi matin','pdf','2018-08-27','jeanpaul','uploads\\files\\15353862825b8422aa8baed0.53196214lundi_matin.pdf'),(44,'REF','lundi matin','pdf','2018-08-27','jeanpaul','uploads\\files\\15353862855b8422ad811245.82178443lundi_matin.pdf');

/*Table structure for table `finance` */

DROP TABLE IF EXISTS `finance`;

CREATE TABLE `finance` (
  `ID_FINANCE` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `MONTANT` float(10,2) NOT NULL,
  `DATE_FINANCE` date NOT NULL,
  `NATURE_FINANCE` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_FINANCE`),
  KEY `FK_RAPPORTER2` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_RAPPORTER` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `immobilier` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_RAPPORTER2` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `mobilier` (`REFERENCE_PATRIMOINE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `finance` */

/*Table structure for table `fonction_profil` */

DROP TABLE IF EXISTS `fonction_profil`;

CREATE TABLE `fonction_profil` (
  `CODE_PROFIL` varchar(100) NOT NULL,
  `ID_FONCT` int(11) NOT NULL,
  PRIMARY KEY (`CODE_PROFIL`,`ID_FONCT`),
  KEY `FK_FONCTION_PROFIL` (`ID_FONCT`),
  CONSTRAINT `FK_FONCTION_PROFIL` FOREIGN KEY (`ID_FONCT`) REFERENCES `fonctionnalite` (`ID_FONCT`),
  CONSTRAINT `FK_FONCTION_PROFIL2` FOREIGN KEY (`CODE_PROFIL`) REFERENCES `profil` (`CODE_PROFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fonction_profil` */

/*Table structure for table `fonction_user` */

DROP TABLE IF EXISTS `fonction_user`;

CREATE TABLE `fonction_user` (
  `IDPERSONNE` int(11) NOT NULL,
  `IDENTIFIANT` int(11) NOT NULL,
  `ID_FONCT` int(11) NOT NULL,
  PRIMARY KEY (`IDPERSONNE`,`IDENTIFIANT`,`ID_FONCT`),
  KEY `FK_FONCTION_USER` (`ID_FONCT`),
  CONSTRAINT `FK_FONCTION_USER` FOREIGN KEY (`ID_FONCT`) REFERENCES `fonctionnalite` (`ID_FONCT`),
  CONSTRAINT `FK_FONCTION_USER2` FOREIGN KEY (`IDPERSONNE`, `IDENTIFIANT`) REFERENCES `utilisateur` (`ID_PERSONNE`, `IDENTIFIANT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fonction_user` */

insert  into `fonction_user`(`IDPERSONNE`,`IDENTIFIANT`,`ID_FONCT`) values (0,0,1),(0,0,2),(0,0,3),(0,0,4),(0,0,5),(0,0,6),(0,0,7),(0,0,8),(0,0,9),(0,0,10),(0,0,11),(0,0,12),(0,0,13),(0,0,14),(0,0,15),(0,0,16),(0,0,17),(0,0,18),(0,0,19),(0,0,20),(0,0,21),(0,0,22),(0,0,23),(0,0,24),(0,0,25),(0,0,26);

/*Table structure for table `fonctionnalite` */

DROP TABLE IF EXISTS `fonctionnalite`;

CREATE TABLE `fonctionnalite` (
  `ID_FONCT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MENU` int(11) NOT NULL,
  `NAME_FONCT` varchar(50) NOT NULL,
  `LIBEL_FONCT` varchar(120) NOT NULL,
  `FONCT_URL` varchar(50) NOT NULL,
  `CONTROLE_FONCT` varchar(5) NOT NULL,
  `NUM_ORDREFONCT` varchar(15) NOT NULL,
  `DESCRIPTION_FONCT` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`ID_FONCT`),
  KEY `FK_ETRE_DANS` (`ID_MENU`),
  CONSTRAINT `FK_ETRE_DANS` FOREIGN KEY (`ID_MENU`) REFERENCES `menu` (`ID_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `fonctionnalite` */

insert  into `fonctionnalite`(`ID_FONCT`,`ID_MENU`,`NAME_FONCT`,`LIBEL_FONCT`,`FONCT_URL`,`CONTROLE_FONCT`,`NUM_ORDREFONCT`,`DESCRIPTION_FONCT`) values (1,1,'SMChangerMDP','Changement de mot de passe','profile','OUI','1','Page de modification des informations de l\'utilisateur'),(2,2,'SMGestionMenu','Gestion des Menus','menu/index','OUI','1','Gestion du regroupement des fonctionnalités'),(3,2,'SMGestionProfil','Gestion des Profils','profil/index','OUI','3','Gestion des profils des utilisateurs'),(4,2,'SMGestionUtilisateur','Gestion des Utilisateurs','utilisateur/index','OUI','4','Gestion des utilisateurs'),(5,2,'SMGestionDA','Gestion des Droits d\'Accès','gestda/index','OUI','5','Gestion des Droits d\'Accès aux differentes fonctionnalités'),(6,2,'SMParamSysteme','Paramètre Système','param/index','OUI','6','Paramètre Système'),(7,2,'SMJournalSysteme','Journal Système','journal/index','OUI','7','Journal de l\'historique des systèmes'),(8,2,'SMGestionFonct','Gestion des Fonctionnalités','fonctionnalite/index','OUI','2','Gestion des fonctionnalités'),(9,3,'SMAyantDroit','Les Ayants Droits','ayantdroit/index','OUI','1','Les ayants droits des patrimoines'),(10,3,'SMClasseur','Les Classeurs','classeur/index','OUI','2','Les Classeurs'),(11,3,'SMClient','Les Clients','client/index','OUI','3','Les Clients'),(12,3,'SMCourriers','Les Courriers','courrier/index','OUI','4','Les courriers'),(13,3,'SMDocuments','Les Documents','document/index','OUI','5','Les Documents'),(14,3,'SMDossiers','Les Dossiers','dossier/index','OUI','6','Les Dossiers'),(15,3,'SMEvenement','Les Evenements','evenement/index','OUI','7','Les Evenements'),(16,3,'SMFichiers','Les Fichiers','fichier/index','OUI','8','Les Fichiers'),(17,3,'SMFrais','Les Frais de dossiers','frais/index','OUI','9','Les Frais afférents aux dossiers'),(18,3,'SMImmobilier','Les Immobilers','immobiler/index','OUI','10','Les Immobiliers'),(19,3,'SMLivreTraitement','Le Livre des traitements','book/index','OUI','11','Le recueil de tous les traitements'),(20,3,'SMMetadonnee','Les Metadonnées','meta/index','OUI','12','Les metadonnées des documents'),(21,3,'SMMobilier','Les Mobiliers','mobilier/index','OUI','13','Les mobiliers'),(22,3,'SMPrioriteCourrier','Les Priorités de Courriers','priorite-courrier/index','OUI','14','La Priorité des courriers dont dépend le classement'),(23,3,'SMTypeCourrier','Les Types de Courriers','type-courrier/index','OUI','15','Le Type des courriers'),(24,3,'SMTypeMetadonnee','Les Types de Métadonnées','type-meta/index','OUI','16','Les Types de métadonnées'),(25,4,'SMMatrice','Les Modeles d\'actes','modele/index','OUI','1','Les matrices qui permettent la rédaction d\'actes.'),(26,5,'SMEnsemble','Panorama','panorama/index','OUI','1','Vue d\'ensembles des patrimoines');

/*Table structure for table `frais` */

DROP TABLE IF EXISTS `frais`;

CREATE TABLE `frais` (
  `ID_FRAIS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOSSIER` int(11) NOT NULL,
  `MONTANT` float(10,2) NOT NULL,
  `DATE_REGLE` date DEFAULT NULL,
  PRIMARY KEY (`ID_FRAIS`),
  KEY `FK_NECESSITER` (`ID_DOSSIER`),
  CONSTRAINT `FK_NECESSITER` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `frais` */

insert  into `frais`(`ID_FRAIS`,`ID_DOSSIER`,`MONTANT`,`DATE_REGLE`) values (1,9,475.00,'2018-08-30'),(2,1,455000.00,'2018-08-29'),(3,6,14.00,'2018-08-30');

/*Table structure for table `gr_usager` */

DROP TABLE IF EXISTS `gr_usager`;

CREATE TABLE `gr_usager` (
  `ID_DROITS` int(11) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `IDENTIFIANT` int(11) NOT NULL,
  `ID_DOSSIER` int(11) NOT NULL,
  `GR_LIBELLE` varchar(50) NOT NULL,
  `GR_DESCRIPTION` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID_DROITS`,`ID_PERSONNE`,`IDENTIFIANT`,`ID_DOSSIER`),
  KEY `FK_GR_USAGER` (`ID_DOSSIER`),
  KEY `FK_GR_USAGER3` (`ID_PERSONNE`,`IDENTIFIANT`),
  CONSTRAINT `FK_GR_USAGER` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`),
  CONSTRAINT `FK_GR_USAGER2` FOREIGN KEY (`ID_DROITS`) REFERENCES `droits` (`ID_DROITS`),
  CONSTRAINT `FK_GR_USAGER3` FOREIGN KEY (`ID_PERSONNE`, `IDENTIFIANT`) REFERENCES `utilisateur` (`ID_PERSONNE`, `IDENTIFIANT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gr_usager` */

/*Table structure for table `immobilier` */

DROP TABLE IF EXISTS `immobilier`;

CREATE TABLE `immobilier` (
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `ID_IMMOBILIER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSONNE` int(11) DEFAULT NULL,
  `ID_AYANTDROIT` int(11) DEFAULT NULL,
  `DESCRIPTION_IMMO` varchar(5000) NOT NULL,
  `ADRESSE` varchar(200) NOT NULL,
  `LATITUDE` decimal(10,4) DEFAULT NULL,
  `LONGITUDE` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`REFERENCE_PATRIMOINE`,`ID_IMMOBILIER`),
  KEY `FK_ETRE_RESPONSABLE` (`ID_PERSONNE`,`ID_AYANTDROIT`),
  KEY `ID_IMMOBILIER` (`ID_IMMOBILIER`),
  CONSTRAINT `FK_ETRE_RESPONSABLE` FOREIGN KEY (`ID_PERSONNE`, `ID_AYANTDROIT`) REFERENCES `ayant_droit` (`ID_PERSONNE`, `ID_AYANTDROIT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `immobilier` */

insert  into `immobilier`(`REFERENCE_PATRIMOINE`,`ID_IMMOBILIER`,`ID_PERSONNE`,`ID_AYANTDROIT`,`DESCRIPTION_IMMO`,`ADRESSE`,`LATITUDE`,`LONGITUDE`) values ('PAT001',1,NULL,NULL,'UNE DESCRIPTION FACTICE','ATTIEGOU','14.1000','14.0000'),('PAT001',2,0,2,'Une autre description a mettre','LOME','14.4100','14.2560'),('PAT001',3,0,1,'quelle description donner a l\'immobiler requis\r\n','ATTIEGOU','142.2500','145.0250');

/*Table structure for table `livre_traitement` */

DROP TABLE IF EXISTS `livre_traitement`;

CREATE TABLE `livre_traitement` (
  `ID_LT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TRAITEMENT` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_LT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `livre_traitement` */

insert  into `livre_traitement`(`ID_LT`,`NOM_TRAITEMENT`) values (1,'ENREGISTREMENT OTR'),(2,'SIGNATURE');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `ID_MENU` int(11) NOT NULL AUTO_INCREMENT,
  `MEN_ID_MENU` int(11) DEFAULT NULL,
  `NAME_MENU` varchar(50) NOT NULL,
  `LIBEL_MENU` varchar(120) NOT NULL,
  `ICONE_NAME_MENU` varchar(50) DEFAULT 'fa-desktop',
  `CONTROLE` varchar(5) NOT NULL,
  `NUM_ORDREMENU` varchar(15) DEFAULT NULL,
  `MENU_URL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MENU`),
  KEY `FK_PARENTER_MENU` (`MEN_ID_MENU`),
  CONSTRAINT `FK_PARENTER_MENU` FOREIGN KEY (`MEN_ID_MENU`) REFERENCES `menu` (`ID_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`ID_MENU`,`MEN_ID_MENU`,`NAME_MENU`,`LIBEL_MENU`,`ICONE_NAME_MENU`,`CONTROLE`,`NUM_ORDREMENU`,`MENU_URL`) values (1,NULL,'MGestionProfil','Gestion de Profil','fa-user','NON','1',NULL),(2,NULL,'MAdministration','Administration','fa-cogs','OUI','2',NULL),(3,NULL,'MDonneeBase','Données de base','fa-plus','OUI','3',NULL),(4,NULL,'MGestionDossier','Redaction d\'actes','fa-pencil','OUI','4',NULL),(5,NULL,'MGestionPatrimoine','Gestion des Patrimoines','fa-desktop','OUI','5',NULL),(6,NULL,'MRechercheEdition','Recherche et Editions','fa-search','OUI','6',NULL);

/*Table structure for table `metadonnee` */

DROP TABLE IF EXISTS `metadonnee`;

CREATE TABLE `metadonnee` (
  `ID_META` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TYPEMETA` int(11) NOT NULL,
  `META_LIBELLE` varchar(50) NOT NULL,
  `META_CONTENU` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_META`),
  KEY `FK_DEFINIR` (`ID_TYPEMETA`),
  CONSTRAINT `FK_DEFINIR` FOREIGN KEY (`ID_TYPEMETA`) REFERENCES `type_metadonnee` (`ID_TYPEMETA`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `metadonnee` */

insert  into `metadonnee`(`ID_META`,`ID_TYPEMETA`,`META_LIBELLE`,`META_CONTENU`) values (2,2,'PDF','Pour les actes notariaux');

/*Table structure for table `mobilier` */

DROP TABLE IF EXISTS `mobilier`;

CREATE TABLE `mobilier` (
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `ID_MOBILIER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSONNE` int(11) NOT NULL,
  `ID_AYANTDROIT` int(11) NOT NULL,
  `DESCRIPTION_MO` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`REFERENCE_PATRIMOINE`,`ID_MOBILIER`),
  KEY `FK_ETRE_RESPONSABLE2` (`ID_PERSONNE`,`ID_AYANTDROIT`),
  KEY `ID_MOBILIER` (`ID_MOBILIER`),
  CONSTRAINT `FK_ETRE_RESPONSABLE2` FOREIGN KEY (`ID_PERSONNE`, `ID_AYANTDROIT`) REFERENCES `ayant_droit` (`ID_PERSONNE`, `ID_AYANTDROIT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mobilier` */

/*Table structure for table `modele` */

DROP TABLE IF EXISTS `modele`;

CREATE TABLE `modele` (
  `ID_MODELE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_MODELE` varchar(100) NOT NULL,
  `SOURCE_MODELE` varchar(150) DEFAULT NULL,
  `CONTENU_MODELE` text NOT NULL,
  `NB_PARAMETRE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_MODELE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `modele` */

insert  into `modele`(`ID_MODELE`,`NOM_MODELE`,`SOURCE_MODELE`,`CONTENU_MODELE`,`NB_PARAMETRE`) values (1,'QUENUM ANPE DEMANE',NULL,'<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lom&eacute; le, 19 Ao&ucirc;t 2018</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><strong><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">QUENUM Abla</span></strong></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Cel&nbsp;: <u>91 18 88 18</u></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">E-mail&nbsp;:ore.quenum@gmail.com</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><strong><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Monsieur le Ministre de l&rsquo;Enseignement Sup&eacute;rieur et de la Recherche</span></strong></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><strong><u><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Objet</span></u></strong><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">&nbsp;: Demande de Bourse </span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">pour un Master en Chine</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Monsieur le Ministre,</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Le communiqu&eacute; minist&eacute;riel, datant du 12 f&eacute;vrier 2018, de la Direction des Bourses et stages du Minist&egrave;re de l&rsquo;Enseignement Sup&eacute;rieur et de la Recherche a retenu toute mon attention. Je viens, respectueusement, par la pr&eacute;sente d&eacute;poser ma demande de bourse pour faire un master dans une Universit&eacute; Chinoise.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">En effet, je suis titulaire d&rsquo;une Licence en Linguistique &agrave; l&rsquo;Universit&eacute; de Lom&eacute; et &eacute;tudiante en langue Chinoise &agrave; l&rsquo;Institut Confucius de l&rsquo;Universit&eacute; de Lom&eacute;. Durant mon parcours &agrave; l&rsquo;Universit&eacute;, j&rsquo;ai eu &agrave; d&eacute;velopper mes capacit&eacute;s de maitrise des langues indispensables &agrave; la gestion d&rsquo;une entreprise ou la gouvernance d&rsquo;un pays. </span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">J&rsquo;ai &eacute;galement eu l&rsquo;occasion d&rsquo;organiser des enqu&ecirc;tes de satisfaction dans un projet de redynamisation de la strat&eacute;gie commerciale d&rsquo;une entreprise. J&rsquo;ai &eacute;galement eu &agrave; travailler sur mes capacit&eacute;s de maitrise des syst&egrave;mes d&rsquo;information et des applications informatiques.&nbsp; Toutes ces exp&eacute;riences et capacit&eacute;s, me rendent apte &agrave; mener &agrave; bien mon projet de formation en Master si vous m&rsquo;en donner l&rsquo;opportunit&eacute;.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">En plus des t&acirc;ches d&rsquo;assistanat administratives et de secr&eacute;taire que j&rsquo;ai assur&eacute; &agrave; plusieurs reprises, j&rsquo;ai &eacute;galement &eacute;t&eacute; h&ocirc;tesse d&rsquo;accueil gr&acirc;ce &agrave; mon profil et surtout &agrave; mes capacit&eacute;s linguistiques. Toutefois, consciente que la r&eacute;ussite d&rsquo;un projet professionnel ne d&eacute;pend pas seulement de l&rsquo;exp&eacute;rience et des capacit&eacute;s acquises, j&rsquo;ai aussi eu &agrave; c&oelig;ur de d&eacute;velopper des qualit&eacute;s de communication, de dynamisme et d&rsquo;efficacit&eacute; dans le travail en &eacute;quipe.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Patriote et soucieuse de la situation socio-&eacute;conomique de notre pays, je souhaiterais me former davantage afin de pouvoir contribuer et apporter ma pierre &agrave; l&rsquo;essor &eacute;conomique et politique de notre pays.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Dans cette optique, cette bourse qu&rsquo;offre le gouvernement de la R&eacute;publique populaire de Chine en collaboration avec le gouvernement Togolais vient &agrave; point nomm&eacute; pour nous faciliter la t&acirc;che.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\">Je serais heureuse de vous rencontrer pour pr&eacute;senter de fa&ccedil;on plus approfondie les exp&eacute;riences mentionn&eacute;es dans mon CV. Dans l&rsquo;espoir que mon dossier retiendra votre attention et m&rsquo;ouvrira les portes d&rsquo;un nouveau d&eacute;fi, je vous prie d&rsquo;agr&eacute;er, Monsieur le Ministre, mes salutations respectueuses.</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:-0.05pt; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\"><span style=\"font-family:&quot;Arial Narrow&quot;,sans-serif\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QUENUM&nbsp; Abla</strong></span></span></span></span></p>\r\n',7),(2,'LETTRE DE MOTIVATION',NULL,'<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Jean-Paul TOSSOU&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lom&eacute; le 01 Juin 2018</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">El&egrave;ve Ing&eacute;nieur &agrave; l&rsquo;Institut</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Africain d&rsquo;Informatique (IAI-TOGO)</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Tel&nbsp;: 92 10 92 83 </span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#0563c1\"><u><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><a href=\"mailto:tossoujeanpaul641@gmail.com\" style=\"color:#0563c1; text-decoration:underline\">tossoujeanpaul641@gmail.com </a></span></span></u></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">A</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-size:13.5pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Monsieur le Directeur G&eacute;n&eacute;ral</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">SI Consult</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lom&eacute;-TOGO</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><u><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Objet</span></span></u><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">&nbsp;: Demande de stage</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Monsieur le Directeur G&eacute;n&eacute;ral,</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Je viens respectueusement par la pr&eacute;sente aupr&egrave;s de votre haute bienveillance solliciter un stage en informatique dans votre entreprise.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Etudiant en troisi&egrave;me ann&eacute;e de g&eacute;nie logiciel &agrave; l&rsquo;Institut Africain Informatique repr&eacute;sentation du Togo (IAI-TOGO), ce stage d&rsquo;une dur&eacute;e de trois mois, exig&eacute; par notre institut qui devra se d&eacute;rouler du 18 juin au 18 septembre 2018 sera une opportunit&eacute; de nous confronter au milieu professionnel afin de mettre en pratique les connaissances re&ccedil;ues au cours de notre parcours et par la m&ecirc;me occasion de valider notre formation par la r&eacute;daction d&rsquo;un m&eacute;moire.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Je joins &agrave; la pr&eacute;sente demande une lettre de recommandation de l&rsquo;Institut Africain d&rsquo;Informatique repr&eacute;sentation du Togo, ainsi que mon curriculum vitae que je serai heureux de vous commenter lors d&rsquo;un entretien &agrave; votre convenance.</span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Dans cette attente je vous prie de croire, Monsieur le Directeur G&eacute;n&eacute;ral &agrave; l&rsquo;expression de ma profonde consid&eacute;ration.</span></span></span></span></p>\r\n',0);

/*Table structure for table `modifier` */

DROP TABLE IF EXISTS `modifier`;

CREATE TABLE `modifier` (
  `ID_VERSION` int(11) NOT NULL,
  `ID_DOSSIER` int(11) NOT NULL,
  PRIMARY KEY (`ID_VERSION`,`ID_DOSSIER`),
  KEY `FK_MODIFIER` (`ID_DOSSIER`),
  CONSTRAINT `FK_MODIFIER` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`),
  CONSTRAINT `FK_MODIFIER2` FOREIGN KEY (`ID_VERSION`) REFERENCES `versionning` (`ID_VERSION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `modifier` */

/*Table structure for table `patrimoine` */

DROP TABLE IF EXISTS `patrimoine`;

CREATE TABLE `patrimoine` (
  `ID_PATRIMOINE` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE_PATRIMOINE` varchar(50) NOT NULL,
  `NOM_PATRIMOINE` varchar(300) NOT NULL,
  PRIMARY KEY (`ID_PATRIMOINE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `patrimoine` */

insert  into `patrimoine`(`ID_PATRIMOINE`,`REFERENCE_PATRIMOINE`,`NOM_PATRIMOINE`) values (1,'PAT001','ATLANTIQUE PRODUCE');

/*Table structure for table `priorite_courrier` */

DROP TABLE IF EXISTS `priorite_courrier`;

CREATE TABLE `priorite_courrier` (
  `ID_PRIORITE` int(11) NOT NULL AUTO_INCREMENT,
  `NATURE_COURRIER` varchar(50) NOT NULL,
  `CLASSER` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_PRIORITE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `priorite_courrier` */

insert  into `priorite_courrier`(`ID_PRIORITE`,`NATURE_COURRIER`,`CLASSER`) values (1,'PROFESSIONNELLE',1);

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `CODE_PROFIL` varchar(100) NOT NULL,
  `LIBELLE` varchar(200) NOT NULL,
  PRIMARY KEY (`CODE_PROFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profil` */

insert  into `profil`(`CODE_PROFIL`,`LIBELLE`) values ('ADMIN','Administrateurs'),('ASS','ASSISTANAT DE DIRECTION');

/*Table structure for table `recenser` */

DROP TABLE IF EXISTS `recenser`;

CREATE TABLE `recenser` (
  `ID_TRAITEMENT` int(11) NOT NULL,
  `ID_LT` int(11) NOT NULL,
  PRIMARY KEY (`ID_TRAITEMENT`,`ID_LT`),
  KEY `FK_RECENSER` (`ID_LT`),
  CONSTRAINT `FK_RECENSER` FOREIGN KEY (`ID_LT`) REFERENCES `livre_traitement` (`ID_LT`),
  CONSTRAINT `FK_RECENSER2` FOREIGN KEY (`ID_TRAITEMENT`) REFERENCES `traitement` (`ID_TRAITEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `recenser` */

/*Table structure for table `subir` */

DROP TABLE IF EXISTS `subir`;

CREATE TABLE `subir` (
  `ID_TRAITEMENT` int(11) NOT NULL,
  `ID_DOSSIER` int(11) NOT NULL,
  PRIMARY KEY (`ID_TRAITEMENT`,`ID_DOSSIER`),
  KEY `FK_SUBIR` (`ID_DOSSIER`),
  CONSTRAINT `FK_SUBIR` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`),
  CONSTRAINT `FK_SUBIR2` FOREIGN KEY (`ID_TRAITEMENT`) REFERENCES `traitement` (`ID_TRAITEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `subir` */

/*Table structure for table `sys_log` */

DROP TABLE IF EXISTS `sys_log`;

CREATE TABLE `sys_log` (
  `ID_LOG` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_ACTION` varchar(25) NOT NULL,
  `ID_PERSONNE` int(11) DEFAULT NULL,
  `IDENTIFIANT` int(11) NOT NULL,
  `DATE_LOG` datetime NOT NULL,
  `TABLE_LOG` varchar(50) NOT NULL,
  `LIB_LOG` text NOT NULL,
  PRIMARY KEY (`ID_LOG`),
  KEY `FK_EFFECTUER` (`CODE_ACTION`),
  KEY `FK_FAIRE` (`ID_PERSONNE`,`IDENTIFIANT`),
  CONSTRAINT `FK_EFFECTUER` FOREIGN KEY (`CODE_ACTION`) REFERENCES `action` (`CODE_ACTION`),
  CONSTRAINT `FK_FAIRE` FOREIGN KEY (`ID_PERSONNE`, `IDENTIFIANT`) REFERENCES `utilisateur` (`ID_PERSONNE`, `IDENTIFIANT`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `sys_log` */

insert  into `sys_log`(`ID_LOG`,`CODE_ACTION`,`ID_PERSONNE`,`IDENTIFIANT`,`DATE_LOG`,`TABLE_LOG`,`LIB_LOG`) values (2,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(3,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(4,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(5,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(6,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR','::DM_MODIFICATION =  '),(7,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR','::DM_MODIFICATION =  '),(8,'DELETE',1,1,'2018-08-24 16:32:25','UYYYYYY','GFGGFGF'),(9,'SELECT',NULL,0,'2018-08-24 15:58:28','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(10,'SELECT',NULL,0,'2018-08-24 16:03:11','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(11,'SELECT',NULL,0,'2018-08-24 16:03:26','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(12,'SELECT',NULL,0,'2018-08-24 16:03:41','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(13,'SELECT',NULL,0,'2018-08-24 16:04:25','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(14,'SELECT',NULL,0,'2018-08-24 16:27:14','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(15,'SELECT',NULL,0,'2018-08-24 16:27:34','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(16,'SELECT',NULL,7,'2018-08-24 17:37:30','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 5 ::NOM = KOKOUVI ::PRENOM = AFIAVI ::SEXE = F ::TELEPHONE = 4488454 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL = ererer@fere.fr ::USERNAME = kokouvi ::PASSWORD = $2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC ::AUTH_KEY = pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(17,'SELECT',NULL,0,'2018-08-24 18:38:16','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 12547896 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$9/n/0bWKpmVkmTPJynsLXexeq7ZKn0zH8TNQbrYsJThlilMaqa0bG ::AUTH_KEY = zahmPftW7griy-23sWJ9N7Z1aaCUJtzH ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:35:41 '),(18,'SELECT',NULL,0,'2018-08-24 18:44:07','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 12547896 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$9/n/0bWKpmVkmTPJynsLXexeq7ZKn0zH8TNQbrYsJThlilMaqa0bG ::AUTH_KEY = zahmPftW7griy-23sWJ9N7Z1aaCUJtzH ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:35:41 '),(19,'UPDATE',NULL,0,'2018-08-24 18:45:15','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 '),(20,'SELECT',NULL,0,'2018-08-24 18:45:16','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 '),(21,'SELECT',NULL,0,'2018-08-24 20:09:32','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 5 ::NOM = KOKOUVI ::PRENOM = AFIAVI ::SEXE = F ::TELEPHONE = 4488454 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL = ererer@fere.fr ::USERNAME = kokouvi ::PASSWORD = $2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC ::AUTH_KEY = pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(22,'SELECT',NULL,0,'2018-08-25 23:19:26','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 5 ::NOM = KOKOUVI ::PRENOM = AFIAVI ::SEXE = F ::TELEPHONE = 4488454 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL = ererer@fere.fr ::USERNAME = kokouvi ::PASSWORD = $2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC ::AUTH_KEY = pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(23,'SELECT',NULL,0,'2018-08-26 00:03:59','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 5 ::NOM = KOKOUVI ::PRENOM = AFIAVI ::SEXE = F ::TELEPHONE = 4488454 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL = ererer@fere.fr ::USERNAME = kokouvi ::PASSWORD = $2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC ::AUTH_KEY = pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(24,'SELECT',NULL,0,'2018-08-26 00:04:09','MENU','::ID_MENU = 2 ::MEN_ID_MENU =  ::NAME_MENU = MAdministration ::LIBEL_MENU = Administration ::ICONE_NAME_MENU = administration.ico ::CONTROLE = OUI ::NUM_ORDREMENU = 2 ::MENU_URL =  '),(25,'SELECT',NULL,0,'2018-08-26 00:04:22','PROFIL','::CODE_PROFIL = ADMIN ::LIBELLE = Administrateurs '),(26,'SELECT',NULL,0,'2018-08-26 00:04:43','SYS_PARAM','::PARAM_CODE = APPLICATION_LABEL ::PARAM_VALUE = DZOB ::PARAM_DESC = Label à afficher sur le menu principal et autres '),(27,'SELECT',NULL,0,'2018-08-26 00:04:55','SYS_LOG','::ID_LOG = 2 ::CODE_ACTION = SELECT ::ID_PERSONNE =  ::IDENTIFIANT = 0 ::DATE_LOG = 0000-00-00 00:00:00 ::TABLE_LOG = UTILISATEUR ::LIB_LOG =  ::DM_MODIFICATION =  '),(28,'SELECT',0,0,'2018-08-26 00:08:56','SYS_LOG','::ID_LOG = 3 ::CODE_ACTION = SELECT ::ID_PERSONNE =  ::IDENTIFIANT = 0 ::DATE_LOG = 0000-00-00 00:00:00 ::TABLE_LOG = UTILISATEUR ::LIB_LOG =  ::DM_MODIFICATION =  '),(29,'SELECT',0,0,'2018-08-26 10:49:46','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 0 ::NOM = Tossou ::PRENOM = Jeanpaul ::SEXE =  ::TELEPHONE = 92109283 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL =  ::USERNAME = jeanpaul ::PASSWORD = $2y$13$HbFDfBJ6TKxCBhVudY/6Ie86bgCvC2y.obt/5TZZDXApjmIJGQkKm ::AUTH_KEY = HGIp5jhh_PofVm8nLPrnNFwklMQ4N-QT ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(30,'SELECT',0,0,'2018-08-26 10:54:41','UTILISATEUR','::ID_PERSONNE = 1 ::IDENTIFIANT = 1 ::NOM = APPOH ::PRENOM = JUDITH ::SEXE =  ::TELEPHONE = 92109283 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL =  ::USERNAME = juristeappoh ::PASSWORD = $2y$13$Bc9KZrfJVDRzvyaiR1heouVfZEfSlJ1p2Ia2hCk/38y ::AUTH_KEY = ZLr__7wgdP13frXiAKKn4ru__NRsur-4 ::ACCESS_TOKEN =  ::ETAT =  ::DM_MODIFICATION =  '),(31,'UPDATE',0,0,'2018-08-26 10:55:56','UTILISATEUR','::ID_PERSONNE = 1 ::IDENTIFIANT = 1 ::NOM = APPOH ::PRENOM = JUDITH ::SEXE = F ::TELEPHONE = 92109283 ::ADRESSE = LOME ::DATE_NAISSANCE = 2018-08-16 ::EMAIL = judith@judoka.tg ::USERNAME = juristeappoh ::PASSWORD = $2y$13$JawiucVFafNPTgkpuLL4heeYuOi9yi87Od.CojiKjAQ4ss.8WWnoC ::AUTH_KEY = l4W4lb1zGy8-oHC2xSV_s3YdybbKqNdR ::ACCESS_TOKEN =  ::ETAT = INACTIF ::DM_MODIFICATION = 2018-08-26 10:55:56 '),(32,'SELECT',0,0,'2018-08-26 10:55:57','UTILISATEUR','::ID_PERSONNE = 1 ::IDENTIFIANT = 1 ::NOM = APPOH ::PRENOM = JUDITH ::SEXE = F ::TELEPHONE = 92109283 ::ADRESSE = LOME ::DATE_NAISSANCE = 2018-08-16 ::EMAIL = judith@judoka.tg ::USERNAME = juristeappoh ::PASSWORD = $2y$13$JawiucVFafNPTgkpuLL4heeYuOi9yi87Od.CojiKjAQ4ss.8WWnoC ::AUTH_KEY = l4W4lb1zGy8-oHC2xSV_s3YdybbKqNdR ::ACCESS_TOKEN =  ::ETAT = INACTIF ::DM_MODIFICATION = 2018-08-26 10:55:56 '),(33,'SELECT',0,0,'2018-08-26 10:56:33','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 '),(34,'SELECT',0,0,'2018-08-26 11:08:11','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 '),(35,'SELECT',0,0,'2018-08-26 21:48:25','FICHIER','::ID_FICHIER = 2 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIER creer ::FORMAT_FICHIER = png '),(36,'SELECT',0,0,'2018-08-26 21:53:23','FICHIER','::ID_FICHIER = 3 ::REFERENCE = REF010 ::NOM_FICHIER = bien vue ::FORMAT_FICHIER = jpg '),(37,'SELECT',0,0,'2018-08-26 21:57:48','FICHIER','::ID_FICHIER = 3 ::REFERENCE = REF010 ::NOM_FICHIER = bien vue ::FORMAT_FICHIER = jpg '),(38,'SELECT',0,0,'2018-08-27 00:28:50','FICHIER','::ID_FICHIER = 15 ::REFERENCE = REF01 ::NOM_FICHIER = une derniere pour la route ::FORMAT_FICHIER = jpg '),(39,'SELECT',0,0,'2018-08-27 00:30:20','FICHIER','::ID_FICHIER = 16 ::REFERENCE = REF01 ::NOM_FICHIER = une derniere pour la route 2 ::FORMAT_FICHIER = jpg '),(40,'SELECT',0,0,'2018-08-27 00:31:31','FICHIER','::ID_FICHIER = 16 ::REFERENCE = REF01 ::NOM_FICHIER = une derniere pour la route 2 ::FORMAT_FICHIER = jpg '),(41,'SELECT',0,0,'2018-08-27 00:32:06','FICHIER','::ID_FICHIER = 17 ::REFERENCE = REF01 ::NOM_FICHIER = je m\'en fou royalement ::FORMAT_FICHIER = jpg '),(42,'SELECT',0,0,'2018-08-27 00:33:00','FICHIER','::ID_FICHIER = 18 ::REFERENCE = REF01 ::NOM_FICHIER = ayooo ::FORMAT_FICHIER = jpg '),(43,'SELECT',0,0,'2018-08-27 02:50:08','FICHIER','::ID_FICHIER = 19 ::REFERENCE = REF ::NOM_FICHIER = Je suis en attente de la bonne ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353310075b834abfb8eb83.48977536Je_suis_en_attente_de_la_bonne.jpg '),(44,'SELECT',0,0,'2018-08-27 02:51:38','FICHIER','::ID_FICHIER = 19 ::REFERENCE = REF ::NOM_FICHIER = Je suis en attente de la ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353310075b834abfb8eb83.48977536Je_suis_en_attente_de_la_bonne.jpg '),(45,'SELECT',0,0,'2018-08-27 02:55:24','FICHIER','::ID_FICHIER = 20 ::REFERENCE = REF01 ::NOM_FICHIER = encore un autre pou le plaisir ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353313235b834bfbc41723.08358206encore_un_autre_pou_le_plaisir.jpg '),(46,'SELECT',0,0,'2018-08-27 02:57:19','FICHIER','::ID_FICHIER = 21 ::REFERENCE = REF ::NOM_FICHIER = wow c\'est du bleuf ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353314385b834c6e8b7104.79080087wow_c\'est_du_bleuf.jpg '),(47,'SELECT',0,0,'2018-08-27 02:57:21','FICHIER','::ID_FICHIER = 22 ::REFERENCE = REF ::NOM_FICHIER = wow c\'est du bleuf ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353314395b834c6f1f0ac4.55744617wow_c\'est_du_bleuf.jpg '),(48,'SELECT',0,0,'2018-08-27 02:59:13','FICHIER','::ID_FICHIER = 23 ::REFERENCE = REF01 ::NOM_FICHIER = reference bien ::FORMAT_FICHIER = docx ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353315535b834ce1342e11.68273920reference_bien.docx '),(49,'SELECT',0,0,'2018-08-27 03:00:24','FICHIER','::ID_FICHIER = 24 ::REFERENCE = REF010 ::NOM_FICHIER = bella vita ::FORMAT_FICHIER = docx ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353316225b834d26186224.82943582bella_vita.docx '),(50,'SELECT',0,0,'2018-08-27 03:00:25','FICHIER','::ID_FICHIER = 25 ::REFERENCE = REF010 ::NOM_FICHIER = bella vita ::FORMAT_FICHIER = xlwx ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353316225b834d267d7553.90116118bella_vita.xlwx '),(51,'SELECT',0,0,'2018-08-27 03:00:26','FICHIER','::ID_FICHIER = 26 ::REFERENCE = REF010 ::NOM_FICHIER = bella vita ::FORMAT_FICHIER = sql ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353316235b834d270b71b8.93477595bella_vita.sql '),(52,'SELECT',0,0,'2018-08-27 03:00:27','FICHIER','::ID_FICHIER = 27 ::REFERENCE = REF010 ::NOM_FICHIER = bella vita ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353316235b834d27b4a211.94411626bella_vita.pdf '),(53,'SELECT',0,0,'2018-08-27 03:15:25','FICHIER','::ID_FICHIER = 28 ::REFERENCE = REF01 ::NOM_FICHIER = ET MERDE ::FORMAT_FICHIER = docx ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353325245b8350acdab695.25467741ET_MERDE.docx '),(54,'SELECT',0,0,'2018-08-27 03:17:36','FICHIER','::ID_FICHIER = 29 ::REFERENCE = REF01 ::NOM_FICHIER = nichtter ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353326565b835130499ed5.98581801nichtter.pdf '),(55,'SELECT',0,0,'2018-08-27 03:18:38','FICHIER','::ID_FICHIER = 30 ::REFERENCE = REF ::NOM_FICHIER = jhjjjh14 ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327175b83516dbe13e0.51162589jhjjjh14.pdf '),(56,'SELECT',0,0,'2018-08-27 03:20:00','FICHIER','::ID_FICHIER = 31 ::REFERENCE = REF010 ::NOM_FICHIER = multiple ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327955b8351bb28a972.90257869multiple.pdf '),(57,'SELECT',0,0,'2018-08-27 03:20:01','FICHIER','::ID_FICHIER = 32 ::REFERENCE = REF010 ::NOM_FICHIER = multiple ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327955b8351bb9741e6.58653010multiple.pdf '),(58,'SELECT',0,0,'2018-08-27 03:20:02','FICHIER','::ID_FICHIER = 33 ::REFERENCE = REF010 ::NOM_FICHIER = multiple ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327965b8351bc029343.16978544multiple.pdf '),(59,'SELECT',0,0,'2018-08-27 03:20:03','FICHIER','::ID_FICHIER = 34 ::REFERENCE = REF010 ::NOM_FICHIER = multiple ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327965b8351bc6ff354.70353750multiple.pdf '),(60,'SELECT',0,0,'2018-08-27 03:20:03','FICHIER','::ID_FICHIER = 35 ::REFERENCE = REF010 ::NOM_FICHIER = multiple ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353327995b8351bf4c4e22.21831928multiple.pdf '),(61,'SELECT',0,0,'2018-08-27 03:22:29','FICHIER','::ID_FICHIER = 36 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329455b835251ac22c8.29919520nom_DU_FICHIERrtyy.jpg '),(62,'SELECT',0,0,'2018-08-27 03:22:30','FICHIER','::ID_FICHIER = 37 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329465b83525257aa76.74913920nom_DU_FICHIERrtyy.jpg '),(63,'SELECT',0,0,'2018-08-27 03:22:31','FICHIER','::ID_FICHIER = 38 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329465b835252b8d4c8.06765723nom_DU_FICHIERrtyy.jpg '),(64,'SELECT',0,0,'2018-08-27 03:22:32','FICHIER','::ID_FICHIER = 39 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = png ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329475b835253622956.50274720nom_DU_FICHIERrtyy.png '),(65,'SELECT',0,0,'2018-08-27 03:22:32','FICHIER','::ID_FICHIER = 40 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329475b835253f2b160.10426726nom_DU_FICHIERrtyy.jpg '),(66,'SELECT',0,0,'2018-08-27 03:22:33','FICHIER','::ID_FICHIER = 41 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERrtyy ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329485b8352549147c7.73958940nom_DU_FICHIERrtyy.jpg '),(67,'SELECT',0,0,'2018-08-27 03:22:55','FICHIER','::ID_FICHIER = 41 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERvenue ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329485b8352549147c7.73958940nom_DU_FICHIERrtyy.jpg '),(68,'SELECT',0,0,'2018-08-27 03:30:42','FICHIER','::ID_FICHIER = 41 ::REFERENCE = REF01 ::NOM_FICHIER = nom DU FICHIERvenue ::FORMAT_FICHIER = jpg ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353329485b8352549147c7.73958940nom_DU_FICHIERrtyy.jpg '),(69,'SELECT',0,0,'2018-08-27 15:11:24','SYS_PARAM','::PARAM_CODE = MODELES_DIR_NAME ::PARAM_VALUE = modeles ::PARAM_DESC = Le dossier de sauvegarde des modèles des actes de l\'étude notariale '),(70,'SELECT',0,0,'2018-08-27 18:11:26','FICHIER','::ID_FICHIER = 42 ::REFERENCE = REF ::NOM_FICHIER = lundi matin ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353862815b8422a9f0c1f4.49044302lundi_matin.pdf '),(71,'SELECT',0,0,'2018-08-27 18:11:27','FICHIER','::ID_FICHIER = 43 ::REFERENCE = REF ::NOM_FICHIER = lundi matin ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353862825b8422aa8baed0.53196214lundi_matin.pdf '),(72,'SELECT',0,0,'2018-08-27 18:11:27','FICHIER','::ID_FICHIER = 44 ::REFERENCE = REF ::NOM_FICHIER = lundi matin ::FORMAT_FICHIER = pdf ::DATE_EFFECTIVE = 2018-08-27 ::CREATEUR = jeanpaul ::SOURCE = uploads\\files\\15353862855b8422ad811245.82178443lundi_matin.pdf '),(73,'SELECT',0,0,'2018-08-27 19:20:47','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(74,'SELECT',0,0,'2018-08-27 19:30:10','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(75,'SELECT',0,0,'2018-08-27 19:42:39','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(76,'SELECT',0,0,'2018-08-27 20:02:02','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(77,'SELECT',0,0,'2018-08-27 20:02:14','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(78,'SELECT',0,0,'2018-08-27 20:02:48','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(79,'SELECT',0,0,'2018-08-27 20:02:54','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(80,'SELECT',0,0,'2018-08-27 20:03:58','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(81,'SELECT',0,0,'2018-08-27 20:04:17','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(82,'SELECT',0,0,'2018-08-27 20:04:21','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(83,'SELECT',0,0,'2018-08-27 20:05:41','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(84,'SELECT',0,0,'2018-08-27 20:06:06','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(85,'SELECT',0,0,'2018-08-28 00:02:24','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(86,'SELECT',0,0,'2018-08-28 00:15:23','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(87,'SELECT',0,0,'2018-08-28 00:16:50','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION '),(88,'SELECT',0,0,'2018-08-28 18:40:15','PROFIL','::CODE_PROFIL = ASS ::LIBELLE = ASSISTANAT DE DIRECTION ');

/*Table structure for table `sys_param` */

DROP TABLE IF EXISTS `sys_param`;

CREATE TABLE `sys_param` (
  `PARAM_CODE` varchar(50) NOT NULL,
  `PARAM_VALUE` varchar(600) NOT NULL,
  `PARAM_DESC` varchar(1500) NOT NULL,
  PRIMARY KEY (`PARAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sys_param` */

insert  into `sys_param`(`PARAM_CODE`,`PARAM_VALUE`,`PARAM_DESC`) values ('APPLICATION_LABEL','DZOB','Label à afficher sur le menu principal et autres'),('APPLICATION_LOGO_NAME','logoApp.png','Le nom du fichier logo de l\'application'),('DOCUMENTS_DIR_NAME','documents','Le nom du dossier des dossiers'),('FILE_DIR_NAME','files','Dossier de stockage des fichiers joint au courriers'),('ICONE_DIR_NAME','icones','Nom du répertoire des icônes des menus'),('MODELES_DIR_NAME','modeles','Le dossier de sauvegarde des modèles des actes de l\'étude notariale'),('REPORT_DIR_NAME','Reports','Nom du repertoire des états'),('TAUX_TVA','18','Taux de la TVA'),('UPLOADS_DIR_NAME','uploads','Le nom du dossier des télechargements');

/*Table structure for table `traitement` */

DROP TABLE IF EXISTS `traitement`;

CREATE TABLE `traitement` (
  `ID_TRAITEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ETAT_TRAITEMENT` tinyint(1) NOT NULL,
  `COMMENTAIRE_TRAITEMENT` varchar(500) NOT NULL,
  `DATE_DEBUT` date NOT NULL,
  `DATE_FIN` date DEFAULT NULL,
  `DATE_PREVUE` date NOT NULL,
  PRIMARY KEY (`ID_TRAITEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `traitement` */

/*Table structure for table `type_courrier` */

DROP TABLE IF EXISTS `type_courrier`;

CREATE TABLE `type_courrier` (
  `ID_TYPECOURRIER` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TYPE` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_TYPECOURRIER`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `type_courrier` */

insert  into `type_courrier`(`ID_TYPECOURRIER`,`NOM_TYPE`) values (1,'INTERNE'),(2,'EXTERNE');

/*Table structure for table `type_metadonnee` */

DROP TABLE IF EXISTS `type_metadonnee`;

CREATE TABLE `type_metadonnee` (
  `ID_TYPEMETA` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_TYPEMETA` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TYPEMETA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `type_metadonnee` */

insert  into `type_metadonnee`(`ID_TYPEMETA`,`LIBELLE_TYPEMETA`) values (1,'AUTEUR'),(2,'FORMAT'),(3,'TAILLE');

/*Table structure for table `user_profil` */

DROP TABLE IF EXISTS `user_profil`;

CREATE TABLE `user_profil` (
  `CODE_PROFIL` varchar(100) NOT NULL,
  `ID_PERSONNE` int(11) NOT NULL,
  `IDENTIFIANT` int(11) NOT NULL,
  PRIMARY KEY (`CODE_PROFIL`,`ID_PERSONNE`,`IDENTIFIANT`),
  KEY `FK_USER_PROFIL` (`ID_PERSONNE`,`IDENTIFIANT`),
  CONSTRAINT `FK_USER_PROFIL` FOREIGN KEY (`ID_PERSONNE`, `IDENTIFIANT`) REFERENCES `utilisateur` (`ID_PERSONNE`, `IDENTIFIANT`),
  CONSTRAINT `FK_USER_PROFIL2` FOREIGN KEY (`CODE_PROFIL`) REFERENCES `profil` (`CODE_PROFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_profil` */

/*Table structure for table `utilisateur` */

DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `utilisateur` (
  `ID_PERSONNE` int(11) NOT NULL,
  `IDENTIFIANT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(100) DEFAULT NULL,
  `SEXE` varchar(1) DEFAULT NULL,
  `TELEPHONE` varchar(10) DEFAULT NULL,
  `ADRESSE` varchar(200) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(500) NOT NULL,
  `AUTH_KEY` varchar(50) NOT NULL,
  `ACCESS_TOKEN` varchar(50) DEFAULT NULL,
  `ETAT` enum('ACTIF','INACTIF') NOT NULL,
  `DM_MODIFICATION` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PERSONNE`,`IDENTIFIANT`),
  KEY `IDENTIFIANT` (`IDENTIFIANT`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `utilisateur` */

insert  into `utilisateur`(`ID_PERSONNE`,`IDENTIFIANT`,`NOM`,`PRENOM`,`SEXE`,`TELEPHONE`,`ADRESSE`,`DATE_NAISSANCE`,`EMAIL`,`USERNAME`,`PASSWORD`,`AUTH_KEY`,`ACCESS_TOKEN`,`ETAT`,`DM_MODIFICATION`) values (0,0,'Tossou','Jeanpaul',NULL,'92109283','LOME',NULL,'','jeanpaul','$2y$13$HbFDfBJ6TKxCBhVudY/6Ie86bgCvC2y.obt/5TZZDXApjmIJGQkKm','HGIp5jhh_PofVm8nLPrnNFwklMQ4N-QT',NULL,'ACTIF',NULL),(0,4,'APPOH','juriste',NULL,'11778899','LOME',NULL,'','judith','$2y$13$vVammBTAXHsVKECSSfamRek98LKANq.kRqQaGXzEh3vP6D/42F07a','oiNrMY0zjQpkjzdVEmYC_zH7p3AEuKZr',NULL,'',NULL),(0,5,'KOKOUVI','AFIAVI','F','4488454','LOME',NULL,'ererer@fere.fr','kokouvi','$2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC','pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h',NULL,'ACTIF',NULL),(0,6,'DESIRE','AKLAKOU','M','11111111','lome','2018-08-15','telephone@moi.fr','desire','$2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq','WWfdivac-I_rtworcO0xB8TzA5Zwt_t-',NULL,'ACTIF','2018-08-24 18:45:15'),(0,7,'ABALO','KOUMA','M','4488454','ATTIEGOU','2018-05-23','telephone@moi.fr','abalo','$2y$13$vYX2QTfpZke.8oGux4q2M.ETCcmrnMQCQwiseC/.EnmBJLAuxyujq','3EgqqujYyTbUa7CBO-U7rA29IGI4i8Bv',NULL,'ACTIF','2018-08-23 23:09:35'),(0,8,'iopt','abalotech','M','44566982','LOME','2018-08-25','telephone@moi.fr','abalos','$2y$13$aIeV1he31fzPcnj/AbiW4.DTu1E78vtNQxVHk/w0S65nlMGWNZ2Ke','2aKooLU8zNECac-xboo7hkmemUsC0tk0',NULL,'INACTIF',NULL),(1,1,'APPOH','JUDITH','F','92109283','LOME','2018-08-16','judith@judoka.tg','juristeappoh','$2y$13$JawiucVFafNPTgkpuLL4heeYuOi9yi87Od.CojiKjAQ4ss.8WWnoC','l4W4lb1zGy8-oHC2xSV_s3YdybbKqNdR',NULL,'INACTIF','2018-08-26 10:55:56'),(2,2,'BAKO','bouchara',NULL,'11223344','ATTIEGOU',NULL,'','bouchara','$2y$13$.qiZ/y44g9YWhq2UcVjNSuQdkR/Scw7zmGEUM7LAEDogrpTEmO02W','t0vNx-4vcaXhCeQaeAT_7PLeAFj__Up3',NULL,'',NULL);

/*Table structure for table `valeur` */

DROP TABLE IF EXISTS `valeur`;

CREATE TABLE `valeur` (
  `ID_VALEUR` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `MONTANT` float(10,2) NOT NULL,
  `DATE_DEBUT` date NOT NULL,
  `DATE_FIN` date DEFAULT NULL,
  PRIMARY KEY (`ID_VALEUR`),
  KEY `FK_VALOIR2` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_VALOIR` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `immobilier` (`REFERENCE_PATRIMOINE`),
  CONSTRAINT `FK_VALOIR2` FOREIGN KEY (`REFERENCE_PATRIMOINE`) REFERENCES `mobilier` (`REFERENCE_PATRIMOINE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `valeur` */

/*Table structure for table `versionning` */

DROP TABLE IF EXISTS `versionning`;

CREATE TABLE `versionning` (
  `ID_VERSION` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_DMVERSION` datetime NOT NULL,
  `DM_PAR` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_VERSION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `versionning` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
