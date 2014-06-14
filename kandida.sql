{\rtf1\ansi\ansicpg1252\cocoartf1240
\cocoascreenfonts1{\fonttbl\f0\fswiss\fcharset0 Helvetica;\f1\fnil\fcharset0 LucidaGrande;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww17280\viewh10300\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803

\f0\fs24 \cf0 -- \
-- Base de donn\'e9es: KANDIDA\
-- \
\
-- --------------------------------------------------------\
\
-- \
-- Structure de la table `agenda`\
-- \
\
DROP TABLE IF EXISTS `agenda`;\
CREATE TABLE `agenda` (\
  `idagenda` int(4) NOT NULL auto_increment,\
  `identreprise` int(4) default NULL,\
  `idcontact` int(4) default NULL,\
  `dateEv` date default NULL,\
  `heure` varchar(11) collate latin1_general_ci default NULL,\
  `evenement` varchar(128) collate latin1_general_ci default NULL,\
  `notes` text collate latin1_general_ci,\
  PRIMARY KEY  (`idagenda`)\
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='historique des rapports avec les entreprises/contacts' AUTO_INCREMENT=1 ;\
\
-- --------------------------------------------------------\
\
-- \
-- Structure de la table `cactus`\
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803
\cf0 -- Stockage des mots-de-passe et identifiants de connexion\
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803
\cf0 -- \
\
DROP TABLE IF EXISTS `cactus`;\
CREATE TABLE `cactus` (\
  `idcactus` int(4) NOT NULL auto_increment,\
  `login` varchar(128) collate latin1_general_ci NOT NULL default '',\
  `pass` varchar(128) collate latin1_general_ci NOT NULL default '',\
  PRIMARY KEY  (`idcactus`)\
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='acc
\f1 e
\f0 s' AUTO_INCREMENT=1 ;\
\
-- --------------------------------------------------------\
\
-- \
-- Structure de la table `contact`\
-- \
\
DROP TABLE IF EXISTS `contact`;\
CREATE TABLE `contact` (\
  `idcontact` int(4) NOT NULL auto_increment,\
  `civ` text collate latin1_general_ci NOT NULL,\
  `nom` varchar(128) collate latin1_general_ci NOT NULL default '',\
  `prenom` varchar(128) collate latin1_general_ci default NULL,\
  `fonction` varchar(254) collate latin1_general_ci default NULL,\
  `loc1` varchar(254) collate latin1_general_ci default NULL,\
  `loc2` varchar(254) collate latin1_general_ci default NULL,\
  `tel1` varchar(17) collate latin1_general_ci default NULL,\
  `tel2` varchar(17) collate latin1_general_ci default NULL,\
  `fax1` varchar(17) collate latin1_general_ci default NULL,\
  `fax2` varchar(17) collate latin1_general_ci default NULL,\
  `email` varchar(128) collate latin1_general_ci default NULL,\
  `web` varchar(254) collate latin1_general_ci default NULL,\
  `notes` text collate latin1_general_ci,\
  `identreprise` int(4) NOT NULL default '0',\
  PRIMARY KEY  (`idcontact`)\
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Contacts dans les entreprises' AUTO_INCREMENT=1 ;\
\
-- --------------------------------------------------------\
\
-- \
-- Structure de la table `entreprise`\
-- \
\
DROP TABLE IF EXISTS `entreprise`;\
CREATE TABLE `entreprise` (\
  `identreprise` int(4) NOT NULL auto_increment,\
  `nom` varchar(254) collate latin1_general_ci NOT NULL default '',\
  `secteur` varchar(128) collate latin1_general_ci default NULL,\
  `adr1` varchar(254) collate latin1_general_ci default NULL,\
  `adr2` varchar(254) collate latin1_general_ci default NULL,\
  `cp` varchar(8) collate latin1_general_ci default NULL,\
  `ville` varchar(128) collate latin1_general_ci default NULL,\
  `tel1` varchar(17) collate latin1_general_ci default NULL,\
  `tel2` varchar(17) collate latin1_general_ci default NULL,\
  `fax1` varchar(17) collate latin1_general_ci default NULL,\
  `fax2` varchar(17) collate latin1_general_ci default NULL,\
  `email` varchar(128) collate latin1_general_ci default NULL,\
  `web` varchar(254) collate latin1_general_ci default NULL,\
  `notes` text collate latin1_general_ci,\
  PRIMARY KEY  (`identreprise`),\
  FULLTEXT KEY `notes` (`notes`)\
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Entreprises et coordonn
\f1 e
\f0 es' AUTO_INCREMENT=1 ;\
\
}