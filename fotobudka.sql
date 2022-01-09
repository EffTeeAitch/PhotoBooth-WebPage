-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Maj 2021, 18:08
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `fotobudka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `filName` text NOT NULL,
  `sciezka` varchar(100) NOT NULL,
  `x` int(4) NOT NULL,
  `y` int(4) NOT NULL,
  `hashs` text NOT NULL,
  `wycena` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `info`
--

INSERT INTO `info` (`id`, `filName`, `sciezka`, `x`, `y`, `hashs`, `wycena`) VALUES
(9, '047951xd.png', '047951xd.png', 516, 473, '18', 20339);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `laczenie`
--

CREATE TABLE `laczenie` (
  `id` int(11) NOT NULL,
  `info_id` int(3) NOT NULL,
  `users_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `laczenie`
--

INSERT INTO `laczenie` (`id`, `info_id`, `users_id`) VALUES
(3, 9, 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`) VALUES
(18, 'Mateusz', 'Zaniewski');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `laczenie`
--
ALTER TABLE `laczenie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `laczenie`
--
ALTER TABLE `laczenie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
