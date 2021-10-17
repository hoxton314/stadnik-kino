-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Paź 2021, 21:59
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kino`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `poster` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(1500) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id`, `title`, `poster`, `description`) VALUES
(12, 'Skazani na Shawshank', '/gfx/zakazani-na-shawshank.jpg', 'Adaptacja opowiadania Stephena Kinga. Niesłusznie skazany na dożywocie bankier, stara się przetrwać w brutalnym, więziennym świecie.<br /><br />Reżyseria: Frank Darabont<br />Scenariusz: Frank Darabont<br />Gatunek: Dramat<br />Produkcja: USA<br />Premiera: 10 września 1994 (świat)'),
(22, 'Django', '/gfx/django.jpg', 'Łowca nagród Schultz i czarnoskóry niewolnik Django wyruszają w podróż, aby odbić żonę tego drugiego z rąk bezlitosnego Calvina Candiego.<br /><br />Reżyseria: Quentin Tarantino<br />Scenariusz: Quentin Tarantino<br />Gatunek: Western<br />Produkcja: USA<br />11 grudnia 2012 (świat)'),
(46, 'Forrest Gump', '/gfx/forrest-gump.jpg', 'Historia życia Forresta, chłopca o niskim ilorazie inteligencji z niedowładem kończyn, który staje się miliarderem i bohaterem wojny w Wietnamie.<br /><br />Reżyseria: Robert Zemeckis<br />Scenariusz: Eric Roth<br />Gatunek: Dramat / Komedia<br />Produkcja: USA<br />23 czerwca 1994 (świat)'),
(99, 'Bohemian Rhapsody', '/gfx/bohemian-rhapsody.jpg', 'Dzięki oryginalnemu brzmieniu Queen staje się jednym z najpopularniejszych zespołów w historii muzyki.<br /><br />Reżyseria: Bryan Singer<br />Scenariusz: Anthony McCarten<br />Gatunek: Biograficzny / Dramat / Muzyczny<br />Produkcja: USA / Wielka Brytania<br />23 października 2018 (świat)');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  `seat` varchar(5) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `seats`
--

INSERT INTO `seats` (`id`, `title`, `login`, `seat`) VALUES
(1, 'Bohemian Rhapsody', 'abc', '1-1'),
(5, 'Bohemian Rhapsody', 'abc', '9-7'),
(6, 'Bohemian Rhapsody', 'abc', '9-8'),
(8, 'Bohemian Rhapsody', 'abc', '10-8'),
(11, 'Django', 'abc', '13-7'),
(26, 'Django', 'abc', '1-1'),
(27, 'Django', 'abc', '1-2'),
(28, 'Django', 'abc', '2-1'),
(29, 'Django', 'abc', '2-2'),
(30, 'Forrest Gump', 'abc', '4-10'),
(31, 'Forrest Gump', 'abc', '7-9'),
(32, 'Skazani na Shawshank', 'abc', '3-4'),
(33, 'Skazani na Shawshank', '2137', '2-11'),
(34, 'Skazani na Shawshank', '2137', '5-9'),
(35, 'Skazani na Shawshank', '2137', '5-10'),
(36, 'Skazani na Shawshank', '2137', '5-11'),
(37, 'Forrest Gump', '2137', '4-2'),
(38, 'Forrest Gump', '2137', '5-2'),
(39, 'Forrest Gump', '2137', '5-3'),
(40, 'Forrest Gump', '2137', '5-4'),
(41, 'Django', '2137', '9-10'),
(42, 'Django', '2137', '9-11'),
(43, 'Django', '2137', '9-12'),
(44, 'Django', '2137', '9-13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `phone` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `phone`) VALUES
(1, 'abc', '9bb6dee73b8b0ca97466ccb24fff3139', '123123123'),
(6, 'qwe', '9bb6dee73b8b0ca97466ccb24fff3139', '321321321'),
(2137, '2137', '9bb6dee73b8b0ca97466ccb24fff3139', '213742069'),
(2138, '1111', '22d7fe8c185003c98f97e5d6ced420c7', '333333333');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indeksy dla tabeli `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`) USING BTREE,
  ADD KEY `login` (`login`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT dla tabeli `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2139;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`login`) REFERENCES `users` (`login`),
  ADD CONSTRAINT `seats_ibfk_2` FOREIGN KEY (`title`) REFERENCES `movies` (`title`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
