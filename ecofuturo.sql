# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.49-community
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2025-01-03 21:50:11
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for gp
CREATE DATABASE IF NOT EXISTS `gp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gp`;


# Dumping structure for table gp.article
CREATE TABLE IF NOT EXISTS `article` (
  `A_ID` int(10) NOT NULL AUTO_INCREMENT,
  `A_TITLE` varchar(255) NOT NULL,
  `A_COVER_IMG` varchar(255) NOT NULL,
  `A_DATE` datetime NOT NULL,
  `A_SMALL_DESCRIPTION` varchar(255) NOT NULL,
  `A_OPINION_NAME` varchar(255) DEFAULT NULL,
  `A_OPINION_TEXT` varchar(255) DEFAULT NULL,
  `A_DESCRIPTION_1` text NOT NULL,
  `A_IMG_1` varchar(255) DEFAULT NULL,
  `A_DESCRIPTION_2` text,
  `A_IMG_2` varchar(255) DEFAULT NULL,
  `A_DESCRIPTION_3` text,
  `A_IMG_3` varchar(255) DEFAULT NULL,
  `A_DESCRIPTION_4` text,
  PRIMARY KEY (`A_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

# Dumping data for table gp.article: ~3 rows (approximately)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`A_ID`, `A_TITLE`, `A_COVER_IMG`, `A_DATE`, `A_SMALL_DESCRIPTION`, `A_OPINION_NAME`, `A_OPINION_TEXT`, `A_DESCRIPTION_1`, `A_IMG_1`, `A_DESCRIPTION_2`, `A_IMG_2`, `A_DESCRIPTION_3`, `A_IMG_3`, `A_DESCRIPTION_4`) VALUES
	(7, 'Lorem ipsum dolor sit amet.', './assets/images/uploads/01735849752.jpg', '2025-01-03 21:43:04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget mi blandit, iaculis ex nec, faucibus ante.', '', '', 'Aenean et ex porta purus venenatis porttitor. Donec sed enim vulputate, congue nibh sit amet, ultricies velit. Proin eget congue risus. Aenean ornare vel turpis id dictum. Nam at felis volutpat, sollicitudin massa vel, aliquam massa. Sed vestibulum enim id dui efficitur vestibulum. Curabitur cursus ultricies lectus quis dapibus. Ut odio leo, malesuada sit amet lacus ut, consectetur tempor tortor. Curabitur accumsan, velit in cursus pharetra, mi leo feugiat dolor, eu vulputate purus orci a ipsum. Vestibulum semper, mauris eu laoreet mattis, ante nibh congue risus, vitae tincidunt sem ipsum at odio.\r\n\r\nQuisque efficitur accumsan consequat. Proin efficitur dui sed massa volutpat, quis semper massa venenatis. Mauris vulputate id dui ac aliquam. Praesent in nulla a diam sollicitudin dapibus et pharetra ipsum. Duis at laoreet augue. Etiam ante purus, accumsan ac ultrices sit amet, molestie nec ligula. Morbi eget sapien semper, tincidunt dolor feugiat, egestas lacus. Sed porttitor vestibulum egestas. Morbi iaculis facilisis sem in dignissim. Aenean non dui imperdiet, viverra diam ac, hendrerit sapien.\r\n\r\nNullam sollicitudin ex eget imperdiet faucibus. Sed auctor mi id augue venenatis, in sodales arcu tempor. Maecenas semper eros a elementum blandit. Sed metus nulla, scelerisque sit amet mattis sed, consequat sed quam. Nulla mollis iaculis tellus in ornare. Ut elementum nunc quis faucibus euismod. Suspendisse potenti. Mauris laoreet ipsum posuere quam aliquet, vitae elementum augue mattis. Etiam luctus orci ac dolor tristique, ut feugiat justo dictum.\r\n\r\nSed congue commodo nunc vel dignissim. Morbi sapien purus, pellentesque nec varius sit amet, consectetur non risus. Vivamus eleifend turpis sed vestibulum condimentum. Curabitur hendrerit venenatis dictum. In hac habitasse platea dictumst. Sed lobortis mollis metus, at pulvinar quam. Mauris in lectus erat. Vestibulum malesuada iaculis nisl, a dictum arcu euismod vel. Donec posuere a tellus vel ullamcorper. Curabitur accumsan purus sed nibh auctor, a molestie ipsum pellentesque. Nulla sed libero egestas, euismod urna sit amet, fringilla tortor.', './assets/images/uploads/1_1735940584.png', '', './assets/images/uploads/2_1735940584.jpg', '', '', ''),
	(8, 'Lorem Ipsuma', './assets/images/uploads/8_0_1735850280.jpg', '2025-01-03 21:39:51', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'Lorem Ipsuma', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a iaculis purus, a vulputate turpis. Sed in urna eu neque imperdiet finibus quis aliquet mi. Morbi sit amet eleifend quam, nec fermentum dolor. Quisque pretium eu orci nec aliquet. Morbi at iaculis sapien. Pellentesque interdum orci lacinia, iaculis erat sed, accumsan leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum tristique venenatis ipsum. Fusce bibendum molestie metus, at porttitor sem dignissim vitae. Quisque at lorem in nisi mattis pharetra. Sed sem est, posuere non justo at, congue lobortis orci. Nulla gravida risus id neque ultricies, eget feugiat libero sagittis. Suspendisse finibus felis eget tellus semper aliquet.', '', 'Nulla dictum, neque sed vehicula porttitor, augue nulla laoreet orci, in tempor lorem sapien ut purus. Aliquam mattis vel metus ac imperdiet. Phasellus posuere, dui id auctor bibendum, diam quam placerat leo, posuere porttitor nisi felis vel erat. Curabitur ac mauris id tellus imperdiet ultrices. Sed erat felis, venenatis nec elit quis, congue sollicitudin est. Aliquam sit amet mi ligula. Maecenas interdum ac risus tristique commodo. Nunc a tellus rhoncus, porttitor orci vitae, condimentum turpis. Etiam a efficitur nulla. Vivamus sem tellus, dignissim elementum eros a, tempus gravida arcu. Proin dapibus id tortor eget tempus. Vivamus venenatis odio eget dui hendrerit porttitor. Mauris tristique, nulla eu iaculis convallis, nunc lectus pretium nunc, sed suscipit ligula nisl eu sem. Aenean porta metus eu nisi finibus, ultrices placerat tortor hendrerit. Nulla nec venenatis mauris, eget ornare turpis. Vivamus libero turpis, posuere sit amet aliquet in, tincidunt vitae arcu. Nulla dictum, neque sed vehicula porttitor, augue nulla laoreet orci, in tempor lorem sapien ut purus. Aliquam mattis vel metus ac imperdiet. Phasellus posuere, dui id auctor bibendum, diam quam placerat leo, posuere porttitor nisi felis vel erat. Curabitur ac mauris id tellus imperdiet ultrices. Sed erat felis, venenatis nec elit quis, congue sollicitudin est. Aliquam sit amet mi ligula. Maecenas interdum ac risus tristique commodo. Nunc a tellus rhoncus, porttitor orci vitae, condimentum turpis. Etiam a efficitur nulla. Vivamus sem tellus, dignissim elementum eros a, tempus gravida arcu. Proin dapibus id tortor eget tempus. Vivamus venenatis odio eget dui hendrerit porttitor. Mauris tristique, nulla eu iaculis convallis, nunc lectus pretium nunc, sed suscipit ligula nisl eu sem. Aenean porta metus eu nisi finibus, ultrices placerat tortor hendrerit. Nulla nec venenatis mauris, eget ornare turpis. Vivamus libero turpis, posuere sit amet aliquet in, tincidunt vitae arcu.', './assets/images/uploads/2_1735852069.png', 'Nulla dictum, neque sed vehicula porttitor, augue nulla laoreet orci, in tempor lorem sapien ut purus. Aliquam mattis vel metus ac imperdiet. Phasellus posuere, dui id auctor bibendum, diam quam placerat leo, posuere porttitor nisi felis vel erat. Curabitur ac mauris id tellus imperdiet ultrices. Sed erat felis, venenatis nec elit quis, congue sollicitudin est. Aliquam sit amet mi ligula. Maecenas interdum ac risus tristique commodo. Nunc a tellus rhoncus, porttitor orci vitae, condimentum turpis. Etiam a efficitur nulla. Vivamus sem tellus, dignissim elementum eros a, tempus gravida arcu. Proin dapibus id tortor eget tempus. Vivamus venenatis odio eget dui hendrerit porttitor. Mauris tristique, nulla eu iaculis convallis, nunc lectus pretium nunc, sed suscipit ligula nisl eu sem. Aenean porta metus eu nisi finibus, ultrices placerat tortor hendrerit. Nulla nec venenatis mauris, eget ornare turpis. Vivamus libero turpis, posuere sit amet aliquet in, tincidunt vitae arcu.', '', 'Nulla dictum, neque sed vehicula porttitor, augue nulla laoreet orci, in tempor lorem sapien ut purus. Aliquam mattis vel metus ac imperdiet. Phasellus posuere, dui id auctor bibendum, diam quam placerat leo, posuere porttitor nisi felis vel erat. Curabitur ac mauris id tellus imperdiet ultrices. Sed erat felis, venenatis nec elit quis, congue sollicitudin est. Aliquam sit amet mi ligula. Maecenas interdum ac risus tristique commodo. Nunc a tellus rhoncus, porttitor orci vitae, condimentum turpis. Etiam a efficitur nulla. Vivamus sem tellus, dignissim elementum eros a, tempus gravida arcu. Proin dapibus id tortor eget tempus. Vivamus venenatis odio eget dui hendrerit porttitor. Mauris tristique, nulla eu iaculis convallis, nunc lectus pretium nunc, sed suscipit ligula nisl eu sem. Aenean porta metus eu nisi finibus, ultrices placerat tortor hendrerit. Nulla nec venenatis mauris, eget ornare turpis. Vivamus libero turpis, posuere sit amet aliquet in, tincidunt vitae arcu.'),
	(9, 'testte et ts este', './assets/images/uploads/0_1735852157.png', '2025-01-02 21:09:17', 'sadsadasdasdsad das dasd a dadasdaadas', 'aaa', 'asdasda dasda s adasdasd adadadadad', 'sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas sadsadasdasdsad das dasd a dadasdaadas', './assets/images/uploads/1_1735851888.png', 'a', '', '', '', '');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;


# Dumping structure for table gp.game
CREATE TABLE IF NOT EXISTS `game` (
  `G_ID` int(11) NOT NULL AUTO_INCREMENT,
  `G_NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`G_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dumping data for table gp.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`G_ID`, `G_NAME`) VALUES
	(1, 'Quizz'),
	(2, 'Reciclagem');
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
INSERT INTO `question` (`Q_ID`, `Q_QUESTION`, `Q_CORRECT`, `Q_OP_A`, `Q_OP_B`, `Q_OP_C`, `Q_OP_D`) VALUES
	(1, 'Em qual lixo deitamos uma garrafa plástica?', 'Amarelo', 'Verde', 'Azul', 'Amarelo', 'Castanho'),
	(2, 'Qual a cor do lixo para papéis?', 'Azul', 'Castanho', 'Verde', 'Azul', 'Preta'),
	(3, 'Onde devemos deitar restos de comida?', 'Castanho', 'Amarela', 'Verde', 'Castanho', 'Azul'),
	(4, 'Qual material podemos reciclar: vidro, papel ou pedra?', 'Vidro', 'Vidro', 'Papel', 'Pedra', 'Nenhum'),
	(5, 'O que significa reciclar?', 'Reutilizar materiais', 'Deitar fora', 'Reutilizar materiais', 'Queimar lixo', 'Guardar para sempre'),
	(6, 'Em qual lixeira deitamos garrafas de vidro?', 'Verde', 'Verde', 'Azul', 'Amarelo', 'Castanho'),
	(7, 'Porque é importante reciclar?', 'Para cuidar do planeta', 'Para cuidar do planeta', 'Para fazer o lixo desaparecer', 'Porque é divertido', 'Porque é moda'),
	(8, 'Qual material é reciclado no lixo azul?', 'Papel', 'Vidro', 'Plástico', 'Papel', 'Metal'),
	(9, 'Podemos reciclar latas de sumos?', 'Sim', 'Sim', 'Não', 'Apenas limpas', 'Depende'),
	(10, 'O que podemos colocar no lixo amarelo?', 'Embalagens plásticas', 'Restos de comida', 'Embalagens plásticas', 'Latas de alumínio', 'Jornais'),
	(11, 'O que não pode ser colocado no lixo verde?', 'Plástico', 'Plástico', 'Vidro', 'Papel', 'Metal'),
	(12, 'Por que devemos separar o lixo?', 'Para ajudar a reciclar', 'Para ajudar a reciclar', 'Porque é bonito', 'Porque dá trabalho', 'Para encher as lixeiras'),
	(13, 'Se não reciclarmos, o que acontece?', 'O planeta fica sujo', 'Nada', 'O planeta fica sujo', 'Os animais ficam felizes', 'Fica mais fácil viver');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


# Dumping structure for table gp.user
CREATE TABLE IF NOT EXISTS `user` (
  `U_ID` int(11) NOT NULL AUTO_INCREMENT,
  `U_USERNAME` varchar(50) NOT NULL,
  `U_EMAIL` varchar(50) NOT NULL,
  `U_PASSWORD` varchar(255) NOT NULL,
  `U_TYPE` varchar(50) NOT NULL DEFAULT 'User',
  `U_POINTS` int(10) DEFAULT '0',
  PRIMARY KEY (`U_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table gp.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`U_ID`, `U_USERNAME`, `U_EMAIL`, `U_PASSWORD`, `U_TYPE`, `U_POINTS`) VALUES
	(1, 'a', 'a@a.pt', '123', 'User', 10),
	(2, 'sad', 'asd@asd.com', '123', 'Admin', 0),
	(3, 'xeko', 'xeko@email.com', '$2y$10$uv9Of.eo8Tg2DuguTgpxE.ligbPKeHoMQtpdMUSBJWnF6wIcMez0O', 'Admin', 4);
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
	(1, 1, 2, 1000),
	(3, 3, 2, 1333),
	(5, 3, 1, 30),
	(6, 3, 1, 15),
	(7, 3, 1, 15),
	(8, 3, 2, 1333),
	(9, 3, 1, 30),
	(10, 1, 2, 1000);
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
  CONSTRAINT `FK_userworkshop_user` FOREIGN KEY (`U_ID`) REFERENCES `user` (`U_ID`),
  CONSTRAINT `FK_userworkshop_workshop` FOREIGN KEY (`W_ID`) REFERENCES `workshop` (`W_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dumping data for table gp.userworkshop: ~2 rows (approximately)
/*!40000 ALTER TABLE `userworkshop` DISABLE KEYS */;
INSERT INTO `userworkshop` (`UW_ID`, `U_ID`, `W_ID`, `UW_SHOWED`) VALUES
	(1, 1, 4, 1),
	(2, 2, 4, 0),
	(3, 3, 5, 0),
	(8, 3, 3, 1),
	(9, 3, 2, 1);
/*!40000 ALTER TABLE `userworkshop` ENABLE KEYS */;


# Dumping structure for table gp.workshop
CREATE TABLE IF NOT EXISTS `workshop` (
  `W_ID` int(11) NOT NULL AUTO_INCREMENT,
  `W_TITLE` varchar(255) NOT NULL,
  `W_IMG` varchar(255) NOT NULL,
  `W_SMALL_DESCRIPTION` text NOT NULL,
  `W_DESCRIPTION` text NOT NULL,
  `W_DATE` date NOT NULL,
  `W_ACTIVE` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`W_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table gp.workshop: ~5 rows (approximately)
/*!40000 ALTER TABLE `workshop` DISABLE KEYS */;
INSERT INTO `workshop` (`W_ID`, `W_TITLE`, `W_IMG`, `W_SMALL_DESCRIPTION`, `W_DESCRIPTION`, `W_DATE`, `W_ACTIVE`) VALUES
	(1, 'teste teste teste teste teste teste', './assets/images/uploads/1735921924.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunta', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia fugit blanditiis facere nostrum, sit quidem minima laudantium ab aspernatur labore illum aperiam ipsa maxime, animi sunt. Repellat incidunt perferendis consequatur?', '2024-12-25', 1),
	(2, 'aaaaa2', './assets/images/pic01.jpg', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asdasd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', '2025-01-01', 1),
	(3, 'aaaaa', './assets/images/pic01.jpg', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asdasd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', '2025-01-01', 1),
	(4, 'teste', './assets/images/uploads/1735921973.jpg', 'Teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste', 'teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste teste\r\nasdasdteste\r\netste', '2025-03-23', 0),
	(5, 'final', './assets/images/uploads/1735921983.png', 'as asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas asda dsad', 'as asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas\r\n<hr>\r\nas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdasas asdas d asd asda sdasdasd asd da asd asdsadasda da dasdada das das dasd asdasda sda a dasda dasd asd asdas dasd adada dasd ad ad asd adasdas', '2026-01-01', 1);
/*!40000 ALTER TABLE `workshop` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
