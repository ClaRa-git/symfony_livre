/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.6.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: livres
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `biography` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES
(1,'Rowling','J.K.','J.K. Rowling est une romancière britannique, auteure de la série Harry Potter. Elle a vendu plus de 500 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits. Elle est également connue pour son engagement en faveur des droits des enfants et des femmes.'),
(2,'Tolkien','J.R.R.','J.R.R. Tolkien est un écrivain britannique, auteur de la trilogie Le Seigneur des Anneaux. Il est considéré comme l’un des plus grands écrivains de fantasy de tous les temps et a influencé de nombreux auteurs de fantasy et de science-fiction. Il a vendu plus de 150 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits.'),
(3,'Martin','George R.R.','George R.R. Martin est un écrivain américain, auteur de la série Le Trône de Fer. Il est considéré comme l’un des plus grands écrivains de fantasy de tous les temps et a influencé de nombreux auteurs de fantasy et de science-fiction. Il a vendu plus de 90 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits.'),
(4,'Kaufman','Amie','Amie Kaufman est une romance australienne, auteure de la série Illuminae. Elle a vendu plus de 10 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits. Elle est également connue pour son engagement en faveur des droits des enfants et des femmes.'),
(5,'Kristoff','Jay','Jay Kristoff est un écrivain australien, auteur de la série Illuminae. Il est considéré comme l’un des plus grands écrivains de science-fiction de tous les temps et a influencé de nombreux auteurs de fantasy et de science-fiction. Il a vendu plus de 10 millions de livres dans le monde entier et a remporté de nombreux prix littéraires pour ses écrits.'),
(6,'Hyuuga','Natsu','Natsu Hyuga commence Les Carnets de l’apothicaire en 2011, sous la forme d’un roman mis en ligne sur la célèbre plateforme Shōsetsuka ni narō (« Devenons écrivains ! »). Il n’en est pas à son coup d’essai, mais l’ampleur de celui-ci change la donne : très vite, les lecteurs se bousculent, les commentaires se multiplient... Encouragé par un tel succès, il signe chez la maison d’édition Shufunotomo et, dès l’année suivante, son roman sort en librairie. Depuis, la série, devenue un véritable phénomène, ne cesse de gagner en notoriété. Sa passion pour la Chine se manifeste par sa fascination pour Wu Zetian, la seule impératrice connue de l’empire du Milieu. La Chine imaginaire de l’écrivain japonais Kenichi Sakemi est aussi une source d’inspiration profonde pour son œuvre... Il bâtit son univers à partir de sources variées. Quant aux énigmes de son récit, elles reposent sur des connaissances en médecine traditionnelle tirées d’ouvrages spécialisés et de reportages.');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `number_page` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `release_date` datetime NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CBE5A331D94388BD` (`serie_id`),
  CONSTRAINT `FK_CBE5A331D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES
(1,1,'Harry Potter à l\'école des sorciers',320,'Harry Potter est un garçon ordinaire. Mais le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l’emmener à Poudlard, l’école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l’effroyable V..., le mage dont personne n’ose prononcer le nom. Amitié, surprises, dangers, scènes comiques, Harry découvre ses pouvoirs et la vie à Poudlard. Le premier tome des aventures du jeune héros vous ensorcelle aussitôt !','1998-10-02 00:00:00','harry-potter-a-lecole-des-sorciers.jpg',1050,'9782070612369'),
(2,1,'Harry Potter et la Chambre des secrets',352,'Une rentrée fracassante en voiture volante, une étrange malédiction qui s’abat sur les élèves, cette deuxième année à l’école des sorciers ne s’annonce pas de tout repos ! Entre les cours de potions magiques, les matches de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets ? Le deuxième tome des aventures de Harry Potter vous emportera dans un tourbillon de surprises et d’émotions. Frissons et humour garantis !','1999-07-02 00:00:00','harry-potter-et-la-chambre-des-secrets.jpg',1050,'9782070612376'),
(3,1,'Harry Potter et le Prisonnier d\'Azkaban',448,'Sirius Black, le dangereux criminel qui s’est échappé de la forteresse d’Azkaban, recherche Harry Potter. C’est donc sous bonne garde que l’apprenti sorcier fait sa troisième rentrée à Poudlard. Mais est-il vraiment hors de danger ? Le troisième tome des aventures de Harry Potter vous emportera dans un tourbillon de surprises et d’émotions. Frissons et humour garantis !','1999-10-02 00:00:00','harry-potter-et-le-prisonnier-dazkaban.jpg',1050,'9782070612383'),
(4,1,'Harry Potter et la Coupe de feu',640,'Harry Potter a quatorze ans et entre en quatrième année au collège de Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d’un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit… Trop vite. Il va se trouver plongé au cœur des événements les plus dramatiques qu’il ait jamais eu à affronter.','2000-10-02 00:00:00','harry-potter-et-la-coupe-de-feu.jpg',1050,'9782070612390'),
(5,1,'Harry Potter et l\'Ordre du Phénix',992,'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n’a jamais été si anxieux. L’adolescence, la perspective des examens et ces étranges cauchemars… Car Celui-Dont-On-Ne-Doit-Pas-Prononcer-Le-Nom est de retour et, plus que jamais, Harry sent peser sur lui une terrible menace. Une menace que le ministère de la Magie ne semble pas prendre au sérieux, contrairement à Dumbledore. Poudlard devient alors le terrain d’une véritable lutte de pouvoir. La résistance s’organise autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours…','2003-06-02 00:00:00','harry-potter-et-lordre-du-phenix.jpg',1050,'9782070612406'),
(6,1,'Harry Potter et le Prince de sang-mêlé',704,'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi Dumbledore vient-il en personne chercher Harry chez les Dursley ? Dans quels extraordinaires voyages au cœur de la mémoire va-t-il l’entraîner ?','2005-10-02 00:00:00','harry-potter-et-le-prince-de-sang-mele.jpg',1050,'9782070612413'),
(7,1,'Harry Potter et les Reliques de la Mort',832,'Harry Potter a été chargé de cette tâche, et il la mènera jusqu’au bout. Accompagné de Ron et Hermione, il mettra tout en œuvre pour trouver le dernier Horcruxe et détruire Voldemort. Rien ne pourra les arrêter. La bataille finale est proche, et seuls les plus forts survivront. Dans ce dernier tome de la série Harry Potter, J.K. Rowling révèle enfin tous les secrets de la saga. Les fans de Harry Potter ne seront pas déçus.','2007-10-02 00:00:00','harry-potter-et-les-reliques-de-la-mort.jpg',1050,'9782070612420'),
(8,2,'La Communauté de l\'Anneau',576,'Frodon Sacquet, un Hobbit de la Comté, hérite d’un anneau. Mais ce n’est pas un anneau ordinaire : c’est l’Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des Ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. Frodon doit quitter la Comté et entreprendre un long voyage pour détruire l’Anneau. Il sera aidé dans sa quête par huit compagnons : Gandalf le Gris, Aragorn le Rôdeur, Legolas l’Elfe, Gimli le Nain, Boromir de Gondor, et ses trois cousins Merry, Pippin et Sam. Ensemble, ils formeront la Communauté de l’Anneau, et devront affronter de nombreux dangers pour atteindre le Mordor, où l’Anneau pourra être détruit.','1954-07-29 00:00:00','le-seigneur-des-anneaux-la-communaute-de-lanneau.jpg',1050,'9782070612369'),
(9,2,'Les Deux Tours',448,'La Communauté de l’Anneau s’est brisée. Frodon et Sam poursuivent leur voyage vers le Mordor, accompagnés par Gollum, une créature étrange qui a jadis possédé l’Anneau. Mais ils ignorent que Gollum les mène droit dans un piège tendu par Sauron. Pendant ce temps, Aragorn, Legolas et Gimli partent à la recherche de Merry et Pippin, enlevés par les Orques de Saroumane. Ils seront aidés dans leur quête par Gandalf, qui a survécu à sa chute dans les ténèbres de Khazad-dûm. Les Deux Tours est le deuxième tome de la trilogie Le Seigneur des Anneaux, de J.R.R. Tolkien.','1954-11-11 00:00:00','le-seigneur-des-anneaux-les-deux-tours.jpg',1050,'9782070612376'),
(10,2,'Le Retour du Roi',464,'La guerre de l’Anneau est terminée. Sauron a été vaincu, et l’Anneau Unique a été détruit. Mais la victoire a un goût amer pour Frodon Sacquet, qui a été gravement blessé lors de sa quête. Il rentre à la Comté, où il espère trouver la paix. Mais la Comté a été envahie par les Orques de Saroumane, qui ont pris le contrôle de la région. Frodon et ses amis Merry, Pippin et Sam doivent se lancer dans une nouvelle aventure pour libérer leur pays. Le Retour du Roi est le troisième tome de la trilogie Le Seigneur des Anneaux, de J.R.R. Tolkien.','1955-10-20 00:00:00','le-seigneur-des-anneaux-le-retour-du-roi.jpg',1050,'9782070612383'),
(11,3,'Le Trône de Fer',576,'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…','1996-08-06 00:00:00','le-trone-de-fer-le-trone-de-fer.jpg',1050,'9782070612390'),
(12,3,'Le Donjon Rouge',576,'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…','1998-07-02 00:00:00','le-trone-de-fer-le-donjon-rouge.jpg',1050,'9782070612406'),
(13,3,'La Bataille des Rois',576,'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…','2000-10-02 00:00:00','le-trone-de-fer-la-bataille-des-rois.jpg',1050,'9782070612413'),
(14,3,'L\'Ombre Maléfique',576,'Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…','2003-06-02 00:00:00','le-troen-de-fer-lombre-malefique.jpg',1050,'9782070612420'),
(15,4,'Illuminae',608,'Kady et Ezra, deux adolescents, doivent fuir leur planète natale, Kerenza, attaquée par une entreprise interstellaire. Ils embarquent à bord de l’Hypatia, un vaisseau spatial, mais leur périple est loin d’être terminé. Ils sont poursuivis par l’entreprise BeiTech, qui veut les élimer pour dissimuler ses crimes. Pour survivre, Kady et Ezra devront s’allier et déjouer les plans de leurs ennemis. Mais dans l’espace, personne ne vous entend crier…','2015-10-20 00:00:00','illuminae-illuminae.jpg',1050,'9782070612369'),
(16,4,'Gemina',672,'Kady et Ezra ont survécu à l’attaque de l’Hypatia par l’entreprise BeiTech. Ils ont trouvé refuge à bord de l’Heimdall, un vaisseau spatial. Mais leur périple est loin d’être terminé. Ils sont poursuivis par BeiTech, qui veut les éliminer pour dissimuler ses crimes. Pour survivre, Kady et Ezra devront s’allier et déjouer les plans de leurs ennemis. Mais dans l’espace, personne ne vous entend crier…','2016-10-18 00:00:00','illuminae-gemina.jpg',1050,'9782070612376'),
(17,4,'Obsidio',624,'Kady et Ezra ont survécu à l’attaque de l’Hypatia par l’entreprise BeiTech. Ils ont trouvé refuge à bord de l’Heimdall, un vaisseau spatial. Mais leur périple est loin d’être terminé. Ils sont poursuivis par BeiTech, qui veut les éliminer pour dissimuler ses crimes. Pour survivre, Kady et Ezra devront s’allier et déjouer les plans de leurs ennemis. Mais dans l’espace, personne ne vous entend crier…','2018-03-13 00:00:00','illuminae-obsidio.jpg',1050,'9782070612383'),
(18,5,'Les carnets de l\'apothicaires - T1',634,'Une jeune apothicaire face aux arcanes du pouvoir impérial...\r\nÀ dix-sept ans, Mao Mao mène une vie dangereuse. Formée dès son plus jeune âge par un apothicaire des bas-fonds de la capitale, elle se retrouve enlevée et vendue comme servante dans le quartier des femmes du palais impérial. Pour échapper à la mort dans cette forteresse coupée du monde extérieur où complots et machinations se succèdent, la jeune fille doit cacher ses connaissances - bref, se fondre dans la masse.\r\n\r\nMais quand les morts suspectes de princes nouveau-nés mettent la cour en émoi, la passion de Mao Mao pour son art reprend le dessus. À force d\'observation, elle découvre le pot aux roses... et se retrouve repérée par Jinshi, un mystérieux haut fonctionnaire à la beauté étrange. Devinant ses talents, il la promeut goûteuse personnelle d\'une des favorites de l\'empereur. Or, au beau milieu de ce nid de serpents, le moindre faux pas pourrait être fatal à la jeune fille...\r\n\r\nDécouvrez la face cachée du saint des saints de la cité impériale ! Dans ce monde de femmes régi par les hommes, Mao Mao aura besoin de toute sa sagacité et de tout son savoir pour démêler les intrigues de cour... Phénoménal succès de librairie au Japon bientôt adapté pour le petit écran, ce roman permet de découvrir une période de l\'histoire fascinante et une héroïne incroyablement attachante.','2022-08-25 00:00:00','les-carnets-de-lapothicaire-t1-679384df4ea9b.jpg',1700,'9782371023376'),
(19,5,'Les carnets de l\'apothicaires - T2',404,'Une jeune apothicaire face aux arcanes du pouvoir impérial.\r\nMême lorsque tout semble aller pour le mieux à la cour intérieure, le danger rôde... Et Mao Mao en sait quelque chose ! Chargée de veiller sur la grossesse de dame Gyokuyo, la jeune apothicaire va devoir mettre à profit tous ses talents - et user de la plus grande discrétion, car le secret ne doit absolument pas être éventé. Or, dans le quartier des femmes du palais impérial, les complots et les coups bas se pratiquent aussi couramment que le badinage et la cérémonie du thé.\r\n\r\nSi des menaces semblent poindre à chaque coin de rue, notamment avec l\'arrivée d\'une caravane de marchands de passage en ville, Mao Mao veille au grain - rien n\'échappe à son oeil acéré. De son côté, le mystérieux Jinshi continue d\'être accaparé par les affaires politiques : deux ambassadrices étrangères semblent avoir jeté leur dévolu sur l\'empereur, ce qui n\'est pas au goût de tout le monde....\r\n\r\nDécouvrez la face cachée du saint des saints de la cité impériale ! Dans ce monde de femmes régi par les hommes, Mao Mao aura besoin de toute sa sagacité et de tout son savoir pour démêler les intrigues de cour... Phénoménal succès de librairie au Japon désormais adapté pour le petit écran, ce roman permet de découvrir une période de l\'histoire fascinante et une héroïne incroyablement attachante.','2024-02-22 00:00:00','les-carnets-de-lapothicaires-t2-6793866addae7.jpg',1700,'9782371023543'),
(20,5,'Les carnets de l\'apothicaires - T3',382,'Une jeune apothicaire face aux arcanes du pouvoir impérial...\r\nMao Mao ne sait plus où donner de la tête. Que ce soit au pavillon de Jade ou aux quatre coins de la cour intérieure, ses talents d\'apothicaire sont en permanence sollicités. Mais quand la grossesse de dame Gyokuyo se complique, la jeune fille se rend à l\'évidence : elle va avoir besoin d\'aide. Le problème, c\'est qu\'il va lui falloir faire appel à quelqu\'un qui n\'est plus le bienvenu au palais impérial...\r\n\r\nSa carrière d\'enquêteuse en herbe n\'est par ailleurs pas en reste. Bien malgré elle, Mao Mao commence à établir des liens entre des incidents qui, à première vue, n\'ont rien à voir entre eux : le dernier passage d\'une caravane de marchands, l\'arrivée de nouveaux eunuques au hougong, le renvoi d\'une première dame de compagnie... Pas de doute, cette affaire risque, une nouvelle fois, d\'être bien plus dangereuse que ce à quoi elle s\'attendait.\r\n\r\nDécouvrez la face cachée du saint des saints de la cité impériale ! Dans ce monde de femmes régi par les hommes, Mao Mao aura besoin de toute sa sagacité et de tout son savoir pour démêler les intrigues de cour... Phénoménal succès de librairie au Japon désormais adapté pour le petit écran, ce roman permet de découvrir une période de l\'histoire fascinante et une héroïne incroyablement attachante.','2024-05-23 00:00:00','les-carnets-de-lapothicaires-t3-6793872e344c0.jpg',1700,'9782371023758'),
(21,5,'Les carnets de l\'apothicaires - T4',379,'Une jeune apothicaire face aux arcanes du pouvoir impérial.\r\nQue de changements ! Dame Gyokuyo a été sacrée impératrice et Mao Mao ne travaille plus à la cour intérieure. En effet, la jeune fille est retournée au quartier des plaisirs reprendre l\'herboristerie de son père adoptif, Luomen. Quant à Jinshi, il n\'est plus l\'intendant du hougong. Impossible pour lui, après avoir mené la bataille visant à mater la rébellion du clan Shi, de continuer à se cacher derrière sa fausse identité d\'eunuque.\r\n\r\nSi la situation semble s\'être apaisée à la capitale impériale, les ennuis continuent de suivre Mao Mao et cette fois, tout le pays est menacé. Lorsque l\'apothicaire est sommée de prendre part à une rencontre diplomatique entre l\'empire et ses voisins occidentaux, elle n\'a d\'autre choix que d\'obéir. Mais le voyage vers l\'Ouest ne sera pas de tout repos...\r\n\r\nDécouvrez la face cachée du saint des saints de la cité impériale ! Dans ce monde de femmes régi par les hommes, Mao Mao aura besoin de toute sa sagacité et de tout son savoir pour démêler les intrigues de cour... Phénoménal succès de librairie au Japon désormais adapté pour le petit écran, ce roman permet de découvrir une période de l\'histoire fascinante et une héroïne incroyablement attachante.','2024-08-29 00:00:00','les-carnets-de-lapothicaires-t4-6793bcb64f481.jpg',1700,'9782371024496');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20250123210017','2025-01-24 07:41:23',621),
('DoctrineMigrations\\Version20250123214546','2025-01-24 07:41:24',427);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editor`
--

LOCK TABLES `editor` WRITE;
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
INSERT INTO `editor` VALUES
(1,'Gallimard','5 rue Gaston-Gallimard, 75007 Paris'),
(2,'Hachette','58 rue Jean-Bleuzen, 92170 Vanves'),
(3,'Flammarion','26 rue Racine, 75006 Paris'),
(4,'Casterman Editeur','11 rue de la Montagne, 59000 Lille'),
(5,'Editions Lumen','2 rue de Saint-Pétersbourg, Paris, France 75008');
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `number_volume` int(11) NOT NULL,
  `date_started` datetime NOT NULL,
  `is_finished` tinyint(1) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
INSERT INTO `serie` VALUES
(1,'Harry Potter','Harry Potter est un garçon ordinaire. Mais le jour de ses onze ans, son existence bascule : un géant vient le chercher pour l’emmener à Poudlard, l’école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l’effroyable V..., le mage dont personne n’ose prononcer le nom. Amitié, surprises, dangers, scènes comiques, Harry découvre ses pouvoirs et la vie à Poudlard. Le premier tome des aventures du jeune héros vous ensorcelle aussitôt !',7,'1997-06-26 00:00:00',1,'harry-potter-a-lecole-des-sorciers.jpg'),
(2,'Le Seigneur des Anneaux','Dans les vertes prairies de la Comté, les Hobbits, ou Semi-hommes, vivaient en paix… jusqu’au jour fatal où l’un d’entre eux, au terme d’une longue quête, rapporta de sombres nouvelles. Sauron, le Seigneur des Ténèbres, avait jadis forgé un Anneau unique, le Ruling, qui contenait une part de son âme. Désormais, Sauron cherchait à s’en emparer',3,'1954-07-29 00:00:00',1,'le-seigneur-des-anneaux-la-communaute-de-lanneau.jpg'),
(3,'Le Trône de Fer','Le royaume des sept couronnes est sur le point de connaître son plus terrible hiver : par-delà le mur qui garde sa frontière nord, une armée de ténèbres se lève, menaçant de tout détruire sur son passage. Mais il en faut plus pour refroidir les ardeurs des rois, des reines, des chevaliers et des renégats qui se disputent le trône de fer, tous les coups sont permis, et seuls les plus forts, ou les plus retors, s’en sortiront indemnes…',5,'1996-08-06 00:00:00',0,'le-trone-de-fer-le-trone-de-fer.jpg'),
(4,'Illuminae','Kady et Ezra, deux adolescents, doivent fuir leur planète natale, Kerenza, attaquée par une entreprise interstellaire. Ils embarquent à bord de l’Hypatia, un vaisseau spatial, mais leur périple est loin d’être terminé. Ils sont poursuivis par l’entreprise BeiTech, qui veut les éliminer pour dissimuler ses crimes. Pour survivre, Kady et Ezra devront s’allier et déjouer les plans de leurs ennemis. Mais dans l’espace, personne ne vous entend crier…',3,'2015-10-20 00:00:00',1,'illuminae-illuminae.jpg'),
(5,'Les carnets de l\'apothicaire','Une jeune apothicaire face aux arcanes du pouvoir impérial...\r\nÀ dix-sept ans, Mao Mao mène une vie dangereuse. Formée dès son plus jeune âge par un apothicaire des bas-fonds de la capitale, elle se retrouve enlevée et vendue comme servante dans le quartier des femmes du palais impérial. Pour échapper à la mort dans cette forteresse coupée du monde extérieur où complots et machinations se succèdent, la jeune fille doit cacher ses connaissances - bref, se fondre dans la masse.',5,'2022-08-25 00:00:00',0,'les-carnets-de-lapothicaire-t1-679384df4ea9b.jpg');
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie_author`
--

DROP TABLE IF EXISTS `serie_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie_author` (
  `serie_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`serie_id`,`author_id`),
  KEY `IDX_4A0583A1D94388BD` (`serie_id`),
  KEY `IDX_4A0583A1F675F31B` (`author_id`),
  CONSTRAINT `FK_4A0583A1D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4A0583A1F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie_author`
--

LOCK TABLES `serie_author` WRITE;
/*!40000 ALTER TABLE `serie_author` DISABLE KEYS */;
INSERT INTO `serie_author` VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(4,5),
(5,6);
/*!40000 ALTER TABLE `serie_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie_editor`
--

DROP TABLE IF EXISTS `serie_editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie_editor` (
  `serie_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  PRIMARY KEY (`serie_id`,`editor_id`),
  KEY `IDX_3B5BAAD3D94388BD` (`serie_id`),
  KEY `IDX_3B5BAAD36995AC4C` (`editor_id`),
  CONSTRAINT `FK_3B5BAAD36995AC4C` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3B5BAAD3D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie_editor`
--

LOCK TABLES `serie_editor` WRITE;
/*!40000 ALTER TABLE `serie_editor` DISABLE KEYS */;
INSERT INTO `serie_editor` VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(5,5);
/*!40000 ALTER TABLE `serie_editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie_type`
--

DROP TABLE IF EXISTS `serie_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie_type` (
  `serie_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`serie_id`,`type_id`),
  KEY `IDX_57BB431BD94388BD` (`serie_id`),
  KEY `IDX_57BB431BC54C8C93` (`type_id`),
  CONSTRAINT `FK_57BB431BC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_57BB431BD94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie_type`
--

LOCK TABLES `serie_type` WRITE;
/*!40000 ALTER TABLE `serie_type` DISABLE KEYS */;
INSERT INTO `serie_type` VALUES
(1,3),
(1,5),
(1,14),
(2,3),
(2,5),
(2,14),
(3,3),
(3,5),
(3,14),
(4,3),
(4,4),
(4,14),
(5,10),
(5,11),
(5,14);
/*!40000 ALTER TABLE `serie_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES
(1,'Horreur'),
(2,'Romance'),
(3,'Aventure'),
(4,'Science-fiction'),
(5,'Fantasy'),
(6,'Policier'),
(7,'Thriller'),
(8,'Comédie'),
(9,'Drame'),
(10,'Historique'),
(11,'Mystère'),
(12,'Action'),
(13,'Suspense'),
(14,'Jeunesse');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin@admin.com','[\"ROLE_ADMIN\"]','$2y$13$y6iwHppWKJNiy0mBIh02Z.8jxCnbAK5E9R7xKdAPcvqsEKUn4RE/a','administrateur'),
(2,'user@user.com','[\"ROLE_USER\"]','$2y$13$hBUBMT/CcbqTpNKvS1QYw.qNyf/tmp94QEw7ZETmkWtMf3Ps2HGge','utilisateur');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-01-24 20:45:51
