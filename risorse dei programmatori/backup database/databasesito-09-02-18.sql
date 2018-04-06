-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 09, 2018 alle 10:51
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
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(80) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `Indirizzo` varchar(300) NOT NULL,
  `TipoPagamento` varchar(100) NOT NULL,
  `NumeroCarta` int(11) NOT NULL,
  `Scadenza` date NOT NULL,
  `CVV` int(3) NOT NULL,
  `NumeroMatricola` int(6) NOT NULL,
  `Amministratore` tinyint(1) NOT NULL,
  `PuntiAccomulati` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `members`
--

INSERT INTO `members` (`id`, `Nome`, `Cognome`, `username`, `email`, `password`, `salt`, `Indirizzo`, `TipoPagamento`, `NumeroCarta`, `Scadenza`, `CVV`, `NumeroMatricola`, `Amministratore`, `PuntiAccomulati`) VALUES
(1, '', '', 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', '', '', 0, '0000-00-00', 0, 0, 0, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `listino`
--
ALTER TABLE `listino`
  ADD PRIMARY KEY (`Codice`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
