-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Mar 2020, 19:44
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_danych`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bany`
--

CREATE TABLE `bany` (
  `data_bana` date NOT NULL,
  `ID_uzytkownika` int(11) NOT NULL,
  `powod` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `bany`
--

INSERT INTO `bany` (`data_bana`, `ID_uzytkownika`, `powod`) VALUES
('2020-03-26', 5, 'zlamanie regulaminu pkt 8');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `ID_postu` int(11) NOT NULL,
  `ID_uzytkownika` int(11) NOT NULL,
  `data_dodania` date NOT NULL,
  `opis` varchar(350) NOT NULL,
  `imgURL` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`ID_postu`, `ID_uzytkownika`, `data_dodania`, `opis`, `imgURL`) VALUES
(1, 1, '2020-03-25', '#summer #polishgirl #wakacje', 'https://github.com/dklej/projektPwl/blob/master/photos/photographer-1.jpg'),
(2, 3, '2020-03-25', 'hahaha ale śmiesznie! wisi i robi zdjęcia! :) ', 'https://github.com/dklej/projektPwl/blob/master/photos/aparat-wiszacy.jpg'),
(3, 2, '2020-03-27', 'Robie zdjęcia, a ktoś mi tu zrobił zdjęcie ;)', 'https://github.com/dklej/projektPwl/blob/master/photos/photographer-4.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `ID_uzytkownika` int(11) NOT NULL,
  `nazwa_uzytkownika` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hashhaslo` char(64) NOT NULL,
  `data_dolaczenia` date NOT NULL,
  `czy_ban` tinyint(1) NOT NULL DEFAULT 0,
  `czy_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`ID_uzytkownika`, `nazwa_uzytkownika`, `email`, `hashhaslo`, `data_dolaczenia`, `czy_ban`, `czy_admin`) VALUES
(1, 'agnesik', 'agnesik233@gmail.com', '1234qwer', '2020-03-26', 0, 0),
(2, 'admin', 'adminstrony@gmail.com', 'admin', '2020-03-24', 0, 1),
(3, 'rokiB', 'roks@wp.pl', 'zlotajesien', '2020-03-25', 0, 0),
(4, 'kiks', 'kiks.oficial@o2.pl', 'bliskiwschod', '2020-03-27', 0, 0),
(5, 'lolaZ', 'lalalalla@tlen.pl', 'hihahe', '2020-03-26', 1, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`ID_postu`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`ID_uzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `ID_postu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `ID_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
