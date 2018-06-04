-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Giu 04, 2018 alle 11:27
-- Versione del server: 5.7.19
-- Versione PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasesito`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `listino`
--

DROP TABLE IF EXISTS `listino`;
CREATE TABLE IF NOT EXISTS `listino` (
  `Codice` int(11) NOT NULL,
  `Nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Categoria` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Descrizione` text COLLATE latin1_general_ci NOT NULL,
  `Prezzo` float NOT NULL,
  `Immagine` varchar(500) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Codice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`Codice`, `Nome`, `Categoria`, `Descrizione`, `Prezzo`, `Immagine`) VALUES
(1, 'Margherita&Cola', 'Pasti Veloci', 'classica pizza margherita con lattina da 50ml', 6, './resources/immaginiCibi/pizza_margherita_figa.jpg'),
(2, 'Pasta&Acqua', 'Pasti Veloci', 'Classica pasta al sugo con bottiglia di acqua naturale da 0,5l\r\n', 4, './resources/immaginiCibi/pasta-cup.jpg'),
(3, 'Panino&The', 'Pasti Veloci', 'Panino con prosciutto crudo e insalata con lattina di the alla pesca da 50ml', 7.5, './resources/immaginiCibi/panino.jpg'),
(4, 'Pizza farcita&Acqua', 'Pasti Veloci', 'Pizza farcita a piacere con bottiglia d\'acqua naturale 0.5l', 9.5, './resources/immaginiCibi/pizza_farcita.png'),
(6, 'Pasta al cartoccio', 'Primi', 'Pasta al pomodoro in contenitore ermetico', 3, './resources/immaginiCibi/pasta-cup.jpg'),
(7, 'Acqua naturale 0.5l', 'Bevande', 'Fresca bottiglietta per dissetarsi', 1, './resources/immaginiCibi/acqua_naturale.png'),
(8, 'Coca Cola 50ml', 'Bevande', 'Coca cola in lattina servita fresca', 2.5, './resources/immaginiCibi/cocacola_lattina_33cl.jpg'),
(9, 'Riso in bianco', 'Primi', 'Riso in bianco servito in un pratico contenitore ermetico', 4, './resources/immaginiCibi/'),
(10, 'Fanta', 'Bevande', 'Lattina da 0,55 cl servita fresca.', 4, './resources/immaginiCibi/'),
(11, 'Riso&Fanta', 'Pasti Veloci', 'desc', 8, './resources/immaginiCibi/'),
(12, 'nome', 'catego', 'desc', 8, './resources/immaginiCibi/');

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(2, '1516708439'),
(1, '1516808194'),
(1, '1516808844'),
(0, '1518603583'),
(0, '1518868086'),
(0, '1518868361'),
(0, '1518959375'),
(13, '1522939125'),
(13, '1522939151'),
(13, '1522939243'),
(13, '1522939257'),
(13, '1522939283'),
(13, '1522939369'),
(8, '1527794165');

-- --------------------------------------------------------

--
-- Struttura della tabella `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(80) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `Indirizzo` varchar(300) NOT NULL,
  `TipoPagamento` varchar(100) NOT NULL,
  `NumeroCarta` bigint(16) NOT NULL,
  `Scadenza` date NOT NULL,
  `CVV` int(3) NOT NULL,
  `NumeroMatricola` int(11) NOT NULL,
  `Amministratore` tinyint(1) NOT NULL DEFAULT '0',
  `PuntiAccumulati` int(11) NOT NULL DEFAULT '8',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `members`
--

INSERT INTO `members` (`id`, `Nome`, `Cognome`, `username`, `email`, `password`, `salt`, `Indirizzo`, `TipoPagamento`, `NumeroCarta`, `Scadenza`, `CVV`, `NumeroMatricola`, `Amministratore`, `PuntiAccumulati`) VALUES
(1, 'bachelorette ', 'farytell', 'bachelorette _farytell', 'b@fff', '9f063b3c70983819be6a587459a21cf6b83437867a904fa09cab4a806196253905cc133cd3f85d054e864c44819985bf285ab77416a97fcfa43af5ca86e3244e', '6767396cc0bf7bc2a46643ed9762c29d4c249b3bce8b54ef8f56fa1d1c221802acd965fe56805593d215b19358f00fbd73df8b2698ba28198b38e6d3563de5c0', 'Via Aeroporto, Orio al serio, BG, Italia', 'consegna', 0, '2020-12-31', 0, 0, 0, 0),
(2, 'nome', 'meridio', 'nome_meridio', 'email@email', '28f5c730376aeb8c52c6a83201a1ade4dde3d55840a48ad03bbd6e7bdea850879955b2cc4265063bb91802201d1f626094df95f82975838b56424af97ce0e894', 'c05e84dbf1451be808149c1bf0a43992416b456f12e34a6373039bb4ada54401d4d9caccf6d9ed41f90f9572024e7740fecacaff5d5d96681ae14561f937186b', 'via map', 'consegna', 0, '2020-12-31', 0, 0, 0, 0),
(3, 'Primo', 'registro', 'primo_registro', 'dec@mer', 'ebf80f62d4699b0459c11596a4ddf19df5939dc6389c70cb4f9c0f6410fe60050bd011a658551aadcbf2cb570aa5d2b0efc03a38f081cb3bb526d0712093c114', 'fa62234a5f09624b110aab0db92dc1cfbba37532dee61009b1abd64b80e32018507e82c80a2293a31bfeeb43130275ee6bb57bde4519ac22d287df5d1917557e', 'via terno', 'consegna', 0, '2020-12-31', 0, 0, 0, 0),
(5, 'puzzole', 'lazze', 'puzzole_lazze', 'aslk@asd', '8e17056fcaac57ff81c0f5ed45b84676e03a715ddab963c006354ec7191a611ea311e81d8ef080cd6b4f09e844e5b465b522ed346867d847778c1d3788348877', '9c2aeadc2c0363da1c333ffc71ed28b49860cb80f599b0797091cbfe06bcd8b23ea18f5a3f9f01cd358da6bbf69360ce09015f5225e4fe67a5e4eda1c2111028', 'via loppo', 'cc', 10, '2020-12-31', 913, 0, 0, 0),
(6, 'igor', 'Lirussi', 'igor_lirussi', 'igor.lirussi@yahoo.it', 'e2f1280aa866789757b700da6774ac83761b34868cd8e88ce6797f6af8cdbf30a14e5acd4af2587d659df57bf64a8d547cff2f984ba30ec5412b2db63a419fb0', 'bf36103507873bfa45e5c8fc4a8ebb237cdc3197a2371c973a4b72ed245e7396ce2f0e53721ee0829d1b44a505848c765021a22ccafdc4384520215a75e4092a', 'vsfds', 'consegna', 0, '2020-12-31', 0, 766737, 0, 0),
(7, 'SOfia', 'Gattu', 'sofia_gattu', 'ssa@gat', '5fff2c9c530800e73f68680f422ca61295f77f1cf77ee7e8fc0d1622465cfe40aba9c5e71573d0c0c5ae505027ca27a65ab87cb5b8e2864c4f20f019ba2c5999', '6bc8e377f9de33f4ae304f4c4492bc8de8a2d8c2e48759078ba17739a5956c31b75dc24aeb7ef0dc0538e3c321f44cedb8352a0071cf36ff24cbd5f0f57b1d4a', '22 massa', 'consegna', 0, '2020-12-31', 0, 6766737, 0, 0),
(8, 'Final', 'Countdown', 'final_countdown', 'fi@cs2', '789a43f3df40e77043b30d6bccd495296f9e52ede217aee80c002fb801b99a4d2cb0e5fc6072817d198bc431944cb96ecb4e8e449bd1dc5a0d7ca5e6994f9404', '1eef4710682cf2440f17baa1bf0c1c1a18900f10550275d332f437a94b00f5e573471d8f6d43c6753f653df71497b5060a7e35b5381cd6464b9ac3ed41a3a991', 'via finale', 'cc', 4698495621971611, '2018-04-26', 955, 766737797, 0, 0),
(9, 'provolo', 'mazzi', 'usr', 'asdo00', '123', 'asdas', 'sodija', 'cc', 1233, '1999-11-12', 123, 766737, 0, 5),
(10, 'prlo', 'mazzi', 'usr', 'asdo00', '123', 'asdas', 'sodija', 'cc', 1233, '1999-11-06', 123, 766737, 0, 5),
(11, 'pippo', 'paperino', 'pippo_paperino', 'adla@ada', '128a684ad4ac4e6fc37aa80ef778f8323e5e4fb000e6de7c77d1ebe006ead6b6667c65d2eeb5fc0b49b27f23882610d9b2ea25b9d6cd17e758c236692fef419c', '83a7afe28afe8f8415522c6e40da0529d9ad4344707bd41791ad06023fa8ca4d6f6d01c0337287f1cd89987ec2c2c258e0c6ec119de86d4fac6c6492696bb555', 'Via Mario Angeloni, Cesena, FC, Italia', 'consegna', 0, '2020-12-31', 0, 0, 0, 0),
(12, 'FInal ', 'Countdown', 'final _countdown', 'dskjfnd@d', '5776238affbb027b4750fd3036693958e0beb6a43a72ce2a50e19e48184a59c261793eae86d52bc2f484a027923c2c8c8aecb17eb2ba9d2f531632816076212c', 'c7a00fdee61c95ef5da9e94b42509103d62bbcd94d35323e1927dc1720cc08058f9b3826dc52a4c892d9eaed17653e7ed853cd8765aef9bf4d57b241cd394d63', 'Southeast Delaware Avenue, Ankeny, IA, Stati Uniti', 'consegna', 0, '2020-12-31', 0, 0, 0, 8),
(15, 'guest', 'guest', 'guest_guest', 'guest@guest', '8fe3e7a3ea86ae0448c8b306643ae1d898cf15144841eb8ee26dac9ef56d90a77d3f0adf0f8bf569cdc7c9e769234ad836e12e360dc42eeb77eefa751c601e9a', 'e2c538d2fd771e311a1642e514c6d0274c3037e3ca91206e22560f53f1e97dec7d77882a719ee6a00ed12c599d3beda508fb54dc4cee64f3fea75a5dd50a1a1f', 'Via Cesenatico, Cesenatico, FC, Italia', 'consegna', 0, '2020-12-31', 0, 0, 0, 8),
(16, 'nome', 'meridio', 'nome_meridio', 'email@email', '95b93b8c907fac45e3a41c200bcbb1602a716f150943507cbbd1c9d15774abafa25ed8c2494e6463baab2fbbe4b12d0d1f46206add23e71e8555a37fdef599e1', '05c961e7f9b0f45da89efde5cc9c4c2782a6ba9c89625febf0deb3c1825fc3ba47d0d28775fe81cad47b57801731aa661028065ad362f83e1146c9c7bb425a25', 'Via Boccaquattro 2, Cesena, FC, Italia', 'consegna', 0, '2020-12-31', 0, 0, 0, 8),
(18, 'admin', 'admin', 'admin_admin', 'admin@admin', '3a125b6df9e3a8cae646d7d0cc39325c05f8a32ff2a2d86de4a527799ee2d296979d6c9abc57316a88bfdb7e30af33575371043c756f6859807ac90d450bc87c', '73bd25785139afc0afda63c84ee40c3c4dda115bab0fb7784ec21a44870b5503bb10a997a24fdf7334e25c0f22af23e1f7fb4f4d3c76b8b158454d45f126f00a', 'ASD Passirana, Rho, MI, Italia', 'consegna', 0, '2020-12-31', 0, 0, 1, 8),
(19, 'Francesco ', 'Carta', 'francesco _carta', 'fra@carta', '86e8bf313c3320d3da2f801bb374abaefaa4565274d34ab160806fd209919ce66056f67521a9b1b684babaf5745e83f60cb925c4727b56cc0eed90cf6af289b2', '27240ed06050dec4f7f9a8de4b7e76720bca4d4c850f84209de6431358a9fd4519160b68a0f6c0161588802ae481c4aa213436fb9d11d955bb5a98dbaaab9140', 'Via Calcinaro, 3, Cesena, FC, Italia', 'cc', 1123454678667777, '2020-12-23', 888, 0, 0, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE IF NOT EXISTS `ordini` (
  `NumeroOrdine` varchar(16) NOT NULL,
  `Cibi` varchar(1000) NOT NULL,
  `PrezzoTotale` int(11) NOT NULL,
  `Completato` tinyint(1) NOT NULL DEFAULT '0',
  `IDUtente` int(11) NOT NULL,
  PRIMARY KEY (`NumeroOrdine`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
