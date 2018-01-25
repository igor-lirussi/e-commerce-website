-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2018 alle 16:48
-- Versione del server: 5.7.14
-- Versione PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `CodiceFiscale` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `listino`
--

CREATE TABLE `listino` (
  `Codice` int(11) NOT NULL,
  `Nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Categoria` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Descrizione` text COLLATE latin1_general_ci NOT NULL,
  `Prezzo` float NOT NULL,
  `Immagine` varchar(500) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`Codice`, `Nome`, `Categoria`, `Descrizione`, `Prezzo`, `Immagine`) VALUES
(1, 'Margherita&Cola', 'Pasti Veloci', 'classica pizza margherita con lattina da 50ml', 6, './risorse dei programmatori/immagini cibi/pizza_margherita_figa.jpg'),
(2, 'Pasta&Acqua', 'Pasti Veloci', 'Classica pasta al sugo con bottiglia di acqua naturale da 0,5l\r\n', 4, './risorse dei programmatori/immagini cibi/pasta-cup.jpg'),
(3, 'Panino&The', 'Pasti Veloci', 'Panino con prosciutto crudo e insalata con lattina di the alla pesca da 50ml', 7.5, './risorse dei programmatori/immagini cibi/panino.jpg'),
(4, 'Pizza farcita&Acqua', 'Pasti Veloci', 'Pizza farcita a piacere con bottiglia d\'acqua naturale 0.5l', 9.5, './risorse dei programmatori/immagini cibi/pizza_farcita.png'),
(5, 'Pizza margherita', 'Primi', 'Classica pizza margherita con bottiglia d\'acqua da 0.5l', 4, ''),
(6, 'Pasta al cartoccio', 'Primi', 'Pasta al pomodoro in contenitore ermetico', 3, ''),
(7, 'Acqua naturale 0.5l', 'Bevande', 'Fresca bottiglietta per dissetarsi', 1, ''),
(8, 'Coca Cola 50ml', 'Bevande', 'Coca cola in lattina servita fresca', 2.5, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(2, '1516708439'),
(1, '1516808194'),
(1, '1516808844');

-- --------------------------------------------------------

--
-- Struttura della tabella `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente registrato`
--

CREATE TABLE `utente registrato` (
  `CodiceFiscale` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `Nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Cognome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Indirizzo` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `Tipo pagamento` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `NumeroCarta` int(11) DEFAULT NULL,
  `Scadenza` date DEFAULT NULL,
  `CVV` int(11) DEFAULT NULL,
  `NumeroMatricola` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `listino`
--
ALTER TABLE `listino`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `utente registrato`
--
ALTER TABLE `utente registrato`
  ADD PRIMARY KEY (`CodiceFiscale`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
