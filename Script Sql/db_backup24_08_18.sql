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
  `DATE` datetime NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `document` */

insert  into `document`(`ID_DOC`,`ID_DOSSIER`,`TITRE_DOC`,`DESCRIPTION_DOC`,`DATE_DOC`,`DATE_EFFECTIVE`,`CREATEUR`,`SOURCE`) values (1,3,'sdsdsd','dsdsdsdsdsd','2018-08-24','2018-08-24','dsdsdsds','uploads/documents/sdsdsd_2018-08-24.accdb'),(2,1,'prions','prions ensemble avant de dormir','2018-08-24','2018-08-24','prieur','uploads/documents/prions_2018-08-24.docx'),(4,1,'COMPTE RENDU','Compte rendu de la reunion entre la collectivité AGBASSOU et le notaire en présence de la sécretaire et de la banque atlantique togo','2018-08-30','2018-08-24','jeanpaul','uploads/documents/COMPTE RENDU_2018-08-24.docx');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `dossier` */

insert  into `dossier`(`ID_DOSSIER`,`ID_CLASSEUR`,`ID_PERSONNE`,`ID_CLIENT`,`DOS_ID_DOSSIER`,`LIBELLE_DOSSIER`,`COMMENTAIRE_DOSSIER`,`DATE_CREATION`,`DATE_DMDOSSIER`,`FRAIS_DOSSIER`,`ETAT_DOSSIER_TRAITEMENT`,`STATUT_DOSSIER`) values (1,1,NULL,2,NULL,'contrat de vente gr','je suis pas cool','2018-01-01',NULL,1455.0000,0,'NICHT'),(2,1,NULL,3,1,'contrat sarl','sais plus quoi ecrire','2018-01-01','2018-08-22 16:18:27',19500.0000,0,'dude'),(3,1,NULL,2,NULL,'news','dsdsdsdsds very cool','2018-01-01',NULL,15000.0000,0,'NICHT dude'),(4,1,NULL,3,NULL,'ggfgfg','je suis un lion de la tribu de judée','2018-01-01','2018-08-22 16:15:55',15500.0000,0,'NICHT'),(5,2,NULL,2,NULL,'frere','bien','2018-01-01',NULL,14500.0000,0,'NICHT dude'),(6,2,NULL,3,NULL,'fleuriste','bien','2018-01-01',NULL,10000.0000,0,'NICHT'),(7,2,NULL,1,2,'sarl','bien','2018-01-01','0000-00-00 00:00:00',17000.0000,0,'NICHT'),(8,2,NULL,2,3,'terminé','bien','2018-01-01',NULL,9500.0000,1,'NICHT'),(9,2,NULL,3,2,'ENTREPRISE KOKOUVI','','2018-08-18',NULL,145000.0000,0,'ANCIEN');

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
  `REFERNCE` varchar(11) NOT NULL,
  `NOM_FICHIER` varchar(30) NOT NULL,
  `FORMAT_FICHIER` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_FICHIER`),
  KEY `FK_JOINTURE` (`REFERNCE`),
  CONSTRAINT `FK_JOINTURE` FOREIGN KEY (`REFERNCE`) REFERENCES `courrier` (`REFERENCE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fichier` */

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

insert  into `fonction_user`(`IDPERSONNE`,`IDENTIFIANT`,`ID_FONCT`) values (0,0,1),(0,0,2),(0,0,3),(0,0,4),(0,0,5),(0,0,6),(0,0,7),(0,0,8),(0,0,9),(0,0,10),(0,0,11),(0,0,12),(0,0,13),(0,0,14),(0,0,15),(0,0,16),(0,0,17),(0,0,18),(0,0,19),(0,0,20),(0,0,21),(0,0,22),(0,0,23),(0,0,24);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `fonctionnalite` */

insert  into `fonctionnalite`(`ID_FONCT`,`ID_MENU`,`NAME_FONCT`,`LIBEL_FONCT`,`FONCT_URL`,`CONTROLE_FONCT`,`NUM_ORDREFONCT`,`DESCRIPTION_FONCT`) values (1,1,'SMChangerMDP','Changement de mot de passe','profile','OUI','1','Page de modification des informations de l\'utilisateur'),(2,2,'SMGestionMenu','Gestion des Menus','menu/index','OUI','1','Gestion du regroupement des fonctionnalités'),(3,2,'SMGestionProfil','Gestion des Profils','profil/index','OUI','3','Gestion des profils des utilisateurs'),(4,2,'SMGestionUtilisateur','Gestion des Utilisateurs','utilisateur/index','OUI','4','Gestion des utilisateurs'),(5,2,'SMGestionDA','Gestion des Droits d\'Accès','gestda/index','OUI','5','Gestion des Droits d\'Accès aux differentes fonctionnalités'),(6,2,'SMParamSysteme','Paramètre Système','param/index','OUI','6','Paramètre Système'),(7,2,'SMJournalSysteme','Journal Système','journal/index','OUI','7','Journal de l\'historique des systèmes'),(8,2,'SMGestionFonct','Gestion des Fonctionnalités','fonctionnalite/index','OUI','2','Gestion des fonctionnalités'),(9,3,'SMAyantDroit','Les Ayants Droits','ayantdroit/index','OUI','1','Les ayants droits des patrimoines'),(10,3,'SMClasseur','Les Classeurs','classeur/index','OUI','2','Les Classeurs'),(11,3,'SMClient','Les Clients','client/index','OUI','3','Les Clients'),(12,3,'SMCourriers','Les Courriers','courrier/index','OUI','4','Les courriers'),(13,3,'SMDocuments','Les Documents','document/index','OUI','5','Les Documents'),(14,3,'SMDossiers','Les Dossiers','dossier/index','OUI','6','Les Dossiers'),(15,3,'SMEvenement','Les Evenements','evenement/index','OUI','7','Les Evenements'),(16,3,'SMFichiers','Les Fichiers','fichier/index','OUI','8','Les Fichiers'),(17,3,'SMFrais','Les Frais de dossiers','frais/index','OUI','9','Les Frais afférents aux dossiers'),(18,3,'SMImmobilier','Les Immobilers','immobiler/index','OUI','10','Les Immobiliers'),(19,3,'SMLivreTraitement','Le Livre des traitements','book/index','OUI','11','Le recueil de tous les traitements'),(20,3,'SMMetadonnee','Les Metadonnées','meta/index','OUI','12','Les metadonnées des documents'),(21,3,'SMMobilier','Les Mobiliers','mobilier/index','OUI','13','Les mobiliers'),(22,3,'SMPrioriteCourrier','Les Priorités de Courriers','priorite-courrier/index','OUI','14','La Priorité des courriers dont dépend le classement'),(23,3,'SMTypeCourrier','Les Types de Courriers','type-courrier/index','OUI','15','Le Type des courriers'),(24,3,'SMTypeMetadonnee','Les Types de Métadonnées','type-meta/index','OUI','16','Les Types de métadonnées');

/*Table structure for table `frais` */

DROP TABLE IF EXISTS `frais`;

CREATE TABLE `frais` (
  `ID_FRAIS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DOSSIER` int(11) NOT NULL,
  `MONTANT` float(10,2) NOT NULL,
  `DATE_REGLE` date DEFAULT NULL,
  `NATURE_FRAIS` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_FRAIS`),
  KEY `FK_NECESSITER` (`ID_DOSSIER`),
  CONSTRAINT `FK_NECESSITER` FOREIGN KEY (`ID_DOSSIER`) REFERENCES `dossier` (`ID_DOSSIER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `frais` */

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
  `DESCRIPTION_IMMO` varchar(250) NOT NULL,
  `ADRESSE` varchar(200) NOT NULL,
  `LATITUDE` decimal(10,4) NOT NULL,
  `LONGITUDE` decimal(10,4) NOT NULL,
  PRIMARY KEY (`REFERENCE_PATRIMOINE`,`ID_IMMOBILIER`),
  KEY `FK_ETRE_RESPONSABLE` (`ID_PERSONNE`,`ID_AYANTDROIT`),
  KEY `ID_IMMOBILIER` (`ID_IMMOBILIER`),
  CONSTRAINT `FK_ETRE_RESPONSABLE` FOREIGN KEY (`ID_PERSONNE`, `ID_AYANTDROIT`) REFERENCES `ayant_droit` (`ID_PERSONNE`, `ID_AYANTDROIT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `immobilier` */

/*Table structure for table `livre_traitement` */

DROP TABLE IF EXISTS `livre_traitement`;

CREATE TABLE `livre_traitement` (
  `ID_LT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TRAITEMENT` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_LT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `livre_traitement` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `ID_MENU` int(11) NOT NULL AUTO_INCREMENT,
  `MEN_ID_MENU` int(11) DEFAULT NULL,
  `NAME_MENU` varchar(50) NOT NULL,
  `LIBEL_MENU` varchar(120) NOT NULL,
  `ICONE_NAME_MENU` varchar(50) DEFAULT NULL,
  `CONTROLE` varchar(5) NOT NULL,
  `NUM_ORDREMENU` varchar(15) DEFAULT NULL,
  `MENU_URL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MENU`),
  KEY `FK_PARENTER_MENU` (`MEN_ID_MENU`),
  CONSTRAINT `FK_PARENTER_MENU` FOREIGN KEY (`MEN_ID_MENU`) REFERENCES `menu` (`ID_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`ID_MENU`,`MEN_ID_MENU`,`NAME_MENU`,`LIBEL_MENU`,`ICONE_NAME_MENU`,`CONTROLE`,`NUM_ORDREMENU`,`MENU_URL`) values (1,NULL,'MGestionProfil','Gestion de Profil','fichier.ico','NON','1',NULL),(2,NULL,'MAdministration','Administration','administration.ico','OUI','2',NULL),(3,NULL,'MDonneeBase','Données de base','base.ico','OUI','3',NULL),(4,NULL,'MGestionDossier','Gestion des Dossiers et Actes','acte.ico','OUI','4',NULL),(5,NULL,'MGestionPatrimoine','Gestion des Patrimoines','patrimoine.ico','OUI','5',NULL),(6,NULL,'MGestionDoc','Gestion Electronique des Documents','doucumetn.ico','OUI','6',NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `metadonnee` */

/*Table structure for table `mobilier` */

DROP TABLE IF EXISTS `mobilier`;

CREATE TABLE `mobilier` (
  `REFERENCE_PATRIMOINE` varchar(10) NOT NULL,
  `ID_MOBILIER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSONNE` int(11) DEFAULT NULL,
  `ID_AYANTDROIT` int(11) DEFAULT NULL,
  `DESCRIPTION_MO` varchar(150) DEFAULT NULL,
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
  `SOURCE_MODELE` varchar(150) NOT NULL,
  `CONTENU_MODEL` text NOT NULL,
  `NB_PARAMETRE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_MODELE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `modele` */

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `patrimoine` */

/*Table structure for table `priorite_courrier` */

DROP TABLE IF EXISTS `priorite_courrier`;

CREATE TABLE `priorite_courrier` (
  `ID_PRIORITE` int(11) NOT NULL AUTO_INCREMENT,
  `NATURE_COURRIER` varchar(50) NOT NULL,
  `CLASSER` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_PRIORITE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `priorite_courrier` */

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `CODE_PROFIL` varchar(100) NOT NULL,
  `LIBELLE` varchar(200) NOT NULL,
  PRIMARY KEY (`CODE_PROFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profil` */

insert  into `profil`(`CODE_PROFIL`,`LIBELLE`) values ('ADMIN','Administrateurs');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `sys_log` */

insert  into `sys_log`(`ID_LOG`,`CODE_ACTION`,`ID_PERSONNE`,`IDENTIFIANT`,`DATE_LOG`,`TABLE_LOG`,`LIB_LOG`) values (2,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(3,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(4,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(5,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR',' ::DM_MODIFICATION = '),(6,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR','::DM_MODIFICATION =  '),(7,'SELECT',NULL,0,'0000-00-00 00:00:00','UTILISATEUR','::DM_MODIFICATION =  '),(8,'DELETE',1,1,'2018-08-24 16:32:25','UYYYYYY','GFGGFGF'),(9,'SELECT',NULL,0,'2018-08-24 15:58:28','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(10,'SELECT',NULL,0,'2018-08-24 16:03:11','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(11,'SELECT',NULL,0,'2018-08-24 16:03:26','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(12,'SELECT',NULL,0,'2018-08-24 16:03:41','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(13,'SELECT',NULL,0,'2018-08-24 16:04:25','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(14,'SELECT',NULL,0,'2018-08-24 16:27:14','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(15,'SELECT',NULL,0,'2018-08-24 16:27:34','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 32569814 ::ADRESSE = lome ::DATE_NAISSANCE =  ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = JEANPAUL ::AUTH_KEY = aa1sYz7bJhTx95hCZqtDBmPx7Z4e47Bw ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-23 16:05:14 '),(16,'SELECT',NULL,7,'2018-08-24 17:37:30','UTILISATEUR','::ID_PERSONNE = 0 ::IDENTIFIANT = 5 ::NOM = KOKOUVI ::PRENOM = AFIAVI ::SEXE = F ::TELEPHONE = 4488454 ::ADRESSE = LOME ::DATE_NAISSANCE =  ::EMAIL = ererer@fere.fr ::USERNAME = kokouvi ::PASSWORD = $2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC ::AUTH_KEY = pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION =  '),(17,'SELECT',NULL,0,'2018-08-24 18:38:16','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 12547896 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$9/n/0bWKpmVkmTPJynsLXexeq7ZKn0zH8TNQbrYsJThlilMaqa0bG ::AUTH_KEY = zahmPftW7griy-23sWJ9N7Z1aaCUJtzH ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:35:41 '),(18,'SELECT',NULL,0,'2018-08-24 18:44:07','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 12547896 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$9/n/0bWKpmVkmTPJynsLXexeq7ZKn0zH8TNQbrYsJThlilMaqa0bG ::AUTH_KEY = zahmPftW7griy-23sWJ9N7Z1aaCUJtzH ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:35:41 '),(19,'UPDATE',NULL,0,'2018-08-24 18:45:15','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 '),(20,'SELECT',NULL,0,'2018-08-24 18:45:16','utilisateur','::ID_PERSONNE = 0 ::IDENTIFIANT = 6 ::NOM = DESIRE ::PRENOM = AKLAKOU ::SEXE = M ::TELEPHONE = 11111111 ::ADRESSE = lome ::DATE_NAISSANCE = 2018-08-15 ::EMAIL = telephone@moi.fr ::USERNAME = desire ::PASSWORD = $2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq ::AUTH_KEY = WWfdivac-I_rtworcO0xB8TzA5Zwt_t- ::ACCESS_TOKEN =  ::ETAT = ACTIF ::DM_MODIFICATION = 2018-08-24 18:45:15 ');

/*Table structure for table `sys_param` */

DROP TABLE IF EXISTS `sys_param`;

CREATE TABLE `sys_param` (
  `PARAM_CODE` varchar(50) NOT NULL,
  `PARAM_VALUE` varchar(600) NOT NULL,
  `PARAM_DESC` varchar(1500) NOT NULL,
  PRIMARY KEY (`PARAM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sys_param` */

insert  into `sys_param`(`PARAM_CODE`,`PARAM_VALUE`,`PARAM_DESC`) values ('APPLICATION_LABEL','DZOB','Label à afficher sur le menu principal et autres'),('APPLICATION_LOGO_NAME','logoApp.png','Le nom du fichier logo de l\'application'),('DOCUMENTS_DIR_NAME','documents','Le nom du dossier des dossiers'),('ICONE_DIR_NAME','icones','Nom du répertoire des icônes des menus'),('REPORT_DIR_NAME','Reports','Nom du repertoire des états'),('TAUX_TVA','18','Taux de la TVA'),('UPLOADS_DIR_NAME','uploads','Le nom du dossier des télechargements');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `type_courrier` */

/*Table structure for table `type_metadonnee` */

DROP TABLE IF EXISTS `type_metadonnee`;

CREATE TABLE `type_metadonnee` (
  `ID_TYPEMETA` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_TYPEMETA` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TYPEMETA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `type_metadonnee` */

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

insert  into `utilisateur`(`ID_PERSONNE`,`IDENTIFIANT`,`NOM`,`PRENOM`,`SEXE`,`TELEPHONE`,`ADRESSE`,`DATE_NAISSANCE`,`EMAIL`,`USERNAME`,`PASSWORD`,`AUTH_KEY`,`ACCESS_TOKEN`,`ETAT`,`DM_MODIFICATION`) values (0,0,'Tossou','Jeanpaul',NULL,'92109283','LOME',NULL,'','jeanpaul','$2y$13$HbFDfBJ6TKxCBhVudY/6Ie86bgCvC2y.obt/5TZZDXApjmIJGQkKm','HGIp5jhh_PofVm8nLPrnNFwklMQ4N-QT',NULL,'',NULL),(0,4,'APPOH','juriste',NULL,'11778899','LOME',NULL,'','judith','$2y$13$vVammBTAXHsVKECSSfamRek98LKANq.kRqQaGXzEh3vP6D/42F07a','oiNrMY0zjQpkjzdVEmYC_zH7p3AEuKZr',NULL,'',NULL),(0,5,'KOKOUVI','AFIAVI','F','4488454','LOME',NULL,'ererer@fere.fr','kokouvi','$2y$13$VmyktLXFrfuHr4gUHYms5eGJjKAFhfo0CEzn0WexE3kNw4xfpbBHC','pBaN_jBtKFzRlZ_EbUqbWFkqjdFXs_1h',NULL,'ACTIF',NULL),(0,6,'DESIRE','AKLAKOU','M','11111111','lome','2018-08-15','telephone@moi.fr','desire','$2y$13$e0v/yJBce1zcJd3eQ.9nHuDA6WCoWO0BYw8pe5IkaSCE5aqy5o3eq','WWfdivac-I_rtworcO0xB8TzA5Zwt_t-',NULL,'ACTIF','2018-08-24 18:45:15'),(0,7,'ABALO','KOUMA','M','4488454','ATTIEGOU','2018-05-23','telephone@moi.fr','abalo','$2y$13$vYX2QTfpZke.8oGux4q2M.ETCcmrnMQCQwiseC/.EnmBJLAuxyujq','3EgqqujYyTbUa7CBO-U7rA29IGI4i8Bv',NULL,'ACTIF','2018-08-23 23:09:35'),(0,8,'iopt','abalotech','M','44566982','LOME','2018-08-25','telephone@moi.fr','abalos','$2y$13$aIeV1he31fzPcnj/AbiW4.DTu1E78vtNQxVHk/w0S65nlMGWNZ2Ke','2aKooLU8zNECac-xboo7hkmemUsC0tk0',NULL,'INACTIF',NULL),(1,1,'APPOH','JUDITH',NULL,'92109283','LOME',NULL,'','juristeappoh','$2y$13$Bc9KZrfJVDRzvyaiR1heouVfZEfSlJ1p2Ia2hCk/38y','ZLr__7wgdP13frXiAKKn4ru__NRsur-4',NULL,'',NULL),(2,2,'BAKO','bouchara',NULL,'11223344','ATTIEGOU',NULL,'','bouchara','$2y$13$.qiZ/y44g9YWhq2UcVjNSuQdkR/Scw7zmGEUM7LAEDogrpTEmO02W','t0vNx-4vcaXhCeQaeAT_7PLeAFj__Up3',NULL,'',NULL);

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
