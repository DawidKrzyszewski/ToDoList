-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 19, 2025 at 05:49 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`) VALUES
(1, 'Adam', '$2y$10$PBJdhe3lYiOv3R/MiFi5be.fWtniX5Qa09OHYAVp8z.'),
(2, 'user', '$2y$10$DgkgJa2AfBkSrFlnxuWb6egr5XHFgiElldKo2mfkga4'),
(3, 'user2', '$2y$10$v1vsNHP.AMm2zlygJGXfauBplLgXfqm0ysR.OLm8oiZ'),
(4, 'user3', '0192023a7bbd73250516f069df18b500'),
(5, 'user4', '$2y$10$PjGrDZcRNYrFJ2lYh4/.duovLtGgZOosTXwFhSscWfF'),
(6, 'Irek', '$2y$10$wpsSbKlZ4tun2LKim5p7ZenRObqdwZQCzQbo79q4SVXr.GeM4ut5G');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(11) NOT NULL,
  `zadanie` varchar(100) NOT NULL,
  `termin` date NOT NULL,
  `zrobione` int(11) NOT NULL DEFAULT 0,
  `uzytkownicy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zadania`
--

INSERT INTO `zadania` (`id`, `zadanie`, `termin`, `zrobione`, `uzytkownicy_id`) VALUES
(1, 'Nauczyć się PHP', '2026-01-16', 1, 6),
(3, 'Lubie placki', '2025-11-21', 1, 6),
(4, 'Tajna misja', '2026-01-01', 1, 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
