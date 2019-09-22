-- phpMyAdmin SQL Dump
-- version 4.4.4
-- http://www.phpmyadmin.net
--
-- Počítač: sql.endora.cz:3314
-- Vytvořeno: Ned 22. zář 2019, 21:29
-- Verze serveru: 5.6.43-84.3
-- Verze PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `allmer1568903790`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `diskuzni_forum`
--

CREATE TABLE IF NOT EXISTS `diskuzni_forum` (
  `datum` datetime NOT NULL,
  `jmeno` varchar(25) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email` varbinary(50) NOT NULL,
  `zapis` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `diskuzni_forum`
--

INSERT INTO `diskuzni_forum` (`datum`, `jmeno`, `email`, `zapis`) VALUES
('2019-09-20 22:24:19', 'Martin Allmer', 0x616c6c6d65726f766940676d61696c2e636f6d, 'Tato návštěvní kniha funguje. Hurá! :)'),
('2019-09-21 10:53:01', 'Bohumila Allmerová', 0x616c6c6d65726f766940676d61696c2e636f6d, 'Ano, vážně to tuna je. Perfecto! :)'),
('2019-09-21 13:04:17', 'Tomáš Kocifaj', 0x6b6f636966616a40626c696c6f2e637a, 'A dokonce to počítá celkový počet příspěvků uživatele.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
