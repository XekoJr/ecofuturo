# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.49-community
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2024-12-21 18:29:34
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for gp
CREATE DATABASE IF NOT EXISTS `gp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gp`;


# Dumping structure for table gp.game
CREATE TABLE IF NOT EXISTS `game` (
  `G_ID` int(11) NOT NULL AUTO_INCREMENT,
  `G_NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`G_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dumping data for table gp.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`G_ID`, `G_NAME`) VALUES
	(1, 'quizz'),
	(2, 'drag & drop');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;


# Dumping structure for table gp.object
CREATE TABLE IF NOT EXISTS `object` (
  `O_ID` int(11) NOT NULL AUTO_INCREMENT,
  `O_SRC` varchar(255) NOT NULL,
  `O_TYPE` varchar(50) NOT NULL,
  `O_ALT` varchar(50) NOT NULL,
  PRIMARY KEY (`O_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table gp.object: ~5 rows (approximately)
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` (`O_ID`, `O_SRC`, `O_TYPE`, `O_ALT`) VALUES
	(1, './assets/images/recycling/glass-bottle.png', 'glass', 'Garrafa de Vidro'),
	(2, './assets/images/recycling/milk.png', 'paper', 'Pacote de Leite'),
	(3, './assets/images/recycling/empty-can.png', 'plastic', 'Lata Vazia'),
	(4, './assets/images/recycling/battery.png', 'batteries', 'Pilha'),
	(5, './assets/images/recycling/fish.png', 'others', 'Peixe');
/*!40000 ALTER TABLE `object` ENABLE KEYS */;


# Dumping structure for table gp.question
CREATE TABLE IF NOT EXISTS `question` (
  `Q_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Q_QUESTION` text NOT NULL,
  `Q_CORRECT` varchar(255) NOT NULL,
  `Q_OP_A` varchar(255) NOT NULL,
  `Q_OP_B` varchar(255) NOT NULL,
  `Q_OP_C` varchar(255) NOT NULL,
  `Q_OP_D` varchar(255) NOT NULL,
  PRIMARY KEY (`Q_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Dumping data for table gp.question: ~0 rows (approximately)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


# Dumping structure for table gp.user
CREATE TABLE IF NOT EXISTS `user` (
  `U_ID` int(11) NOT NULL AUTO_INCREMENT,
  `U_USERNAME` varchar(50) NOT NULL,
  `U_EMAIL` varchar(50) NOT NULL,
  `U_PASSWORD` varchar(255) NOT NULL,
  `U_TYPE` varchar(50) NOT NULL DEFAULT 'User',
  PRIMARY KEY (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

# Dumping data for table gp.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`U_ID`, `U_USERNAME`, `U_EMAIL`, `U_PASSWORD`, `U_TYPE`) VALUES
	(1, 'a', 'a@a.pt', '123', 'User');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


# Dumping structure for table gp.usergame
CREATE TABLE IF NOT EXISTS `usergame` (
  `UG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `U_ID` int(11) NOT NULL,
  `G_ID` int(11) NOT NULL,
  `UG_POINTS` int(11) DEFAULT '0',
  PRIMARY KEY (`UG_ID`),
  KEY `FK_usergame_user` (`U_ID`),
  KEY `FK_usergame_game` (`G_ID`),
  CONSTRAINT `FK_usergame_game` FOREIGN KEY (`G_ID`) REFERENCES `game` (`G_ID`),
  CONSTRAINT `FK_usergame_user` FOREIGN KEY (`U_ID`) REFERENCES `user` (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

# Dumping data for table gp.usergame: ~1 rows (approximately)
/*!40000 ALTER TABLE `usergame` DISABLE KEYS */;
INSERT INTO `usergame` (`UG_ID`, `U_ID`, `G_ID`, `UG_POINTS`) VALUES
	(1, 1, 2, 1000);
/*!40000 ALTER TABLE `usergame` ENABLE KEYS */;


# Dumping structure for table gp.userworkshop
CREATE TABLE IF NOT EXISTS `userworkshop` (
  `UW_ID` int(11) NOT NULL AUTO_INCREMENT,
  `U_ID` int(1) DEFAULT '0',
  `W_ID` int(1) DEFAULT '0',
  `UW_SHOWED` int(1) DEFAULT '0',
  PRIMARY KEY (`UW_ID`),
  KEY `FK_userworkshop_user` (`U_ID`),
  KEY `FK_userworkshop_workshop` (`W_ID`),
  CONSTRAINT `FK_userworkshop_workshop` FOREIGN KEY (`W_ID`) REFERENCES `workshop` (`W_ID`),
  CONSTRAINT `FK_userworkshop_user` FOREIGN KEY (`U_ID`) REFERENCES `user` (`U_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Dumping data for table gp.userworkshop: ~0 rows (approximately)
/*!40000 ALTER TABLE `userworkshop` DISABLE KEYS */;
INSERT INTO `userworkshop` (`UW_ID`, `U_ID`, `W_ID`, `UW_SHOWED`) VALUES
	(1, 1, 4, 0);
/*!40000 ALTER TABLE `userworkshop` ENABLE KEYS */;


# Dumping structure for table gp.workshop
CREATE TABLE IF NOT EXISTS `workshop` (
  `W_ID` int(11) NOT NULL AUTO_INCREMENT,
  `W_TITLE` varchar(255) NOT NULL,
  `W_IMG` varchar(255) NOT NULL,
  `W_SMALL_DESCRIPTION` text NOT NULL,
  `W_DESCRIPTION` text NOT NULL,
  `W_DATE` date NOT NULL,
  PRIMARY KEY (`W_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

# Dumping data for table gp.workshop: ~4 rows (approximately)
/*!40000 ALTER TABLE `workshop` DISABLE KEYS */;
INSERT INTO `workshop` (`W_ID`, `W_TITLE`, `W_IMG`, `W_SMALL_DESCRIPTION`, `W_DESCRIPTION`, `W_DATE`) VALUES
	(1, 'teste teste teste teste teste teste', './assets/images/pic01.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur?', '2024-12-25'),
	(2, 'aaaaa2', './assets/images/pic01.jpg', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asdasd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', '2025-01-01'),
	(3, 'aaaaa', './assets/images/pic01.jpg', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asdasd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', '2025-01-01'),
	(4, 'teste', './assets/images/uploads/1734797738.png', 'Teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste', 'teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste\r\nasdasdteste\r\netste', '2025-03-23'),
	(5, 'final', './assets/images/uploads/1734800807.jpg', 'as asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas asda dsad', 'as asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\n<hr>\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas', '2026-01-01');
/*!40000 ALTER TABLE `workshop` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
