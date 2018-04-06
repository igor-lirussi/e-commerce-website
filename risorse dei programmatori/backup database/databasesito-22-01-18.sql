-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 22, 2018 alle 15:33
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
  `Prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `listino`
--

INSERT INTO `listino` (`Codice`, `Nome`, `Categoria`, `Descrizione`, `Prezzo`) VALUES
(1, 'Margherita&Cola', 'Pasti Veloci', 'classica pizza margherita con lattina da 50ml', 6),
(2, 'Pasta&Acqua', 'Pasti Veloci', 'Classica pasta al sugo con bottiglia di acqua naturale da 0,5l\r\n', 4),
(3, 'Panino&The', 'Pasti Veloci', 'Panino con prosciutto crudo e insalata con lattina di the alla pesca da 50ml', 7.5),
(4, 'Pizza farcita&Acqua', 'Pasti Veloci', 'Pizza farcita a piacere con bottiglia d\'acqua naturale 0.5l', 9.5),
(5, 'Pizza margherita', 'Primi', 'Classica pizza margherita con bottiglia d\'acqua da 0.5l', 4),
(6, 'Pasta al cartoccio', 'Primi', 'Pasta al pomodoro in contenitore ermetico', 3),
(7, 'Acqua naturale 0.5l', 'Bevande', 'Fresca bottiglietta per dissetarsi', 1),
(8, 'Coca Cola 50ml', 'Bevande', 'Coca cola in lattina servita fresca', 2.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CodiceFiscale` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `Nome` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `Cognome` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Indirizzo` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente registrato`
--

CREATE TABLE `utente registrato` (
  `CodiceFiscale` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(40) COLLATE latin1_general_ci NOT NULL,
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
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `utente registrato`
--
ALTER TABLE `utente registrato`
  ADD PRIMARY KEY (`CodiceFiscale`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
