-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Mar 2021, 17:20
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `project_notes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `creatingDate` datetime NOT NULL,
  `modifyDate` datetime DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL,
  `hasChild` tinyint(1) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `creatingDate`, `modifyDate`, `isDeleted`, `hasChild`, `parent`) VALUES
(6, 'Winter', 'Snow is snowing, all around me!', '2021-03-05 22:08:12', NULL, 1, NULL, NULL),
(7, 'Ski Jumping', 'Today, the World Champion is Stefan Kraft. Schattenbergschanze, Oberstdorf 2021', '2021-03-05 22:21:50', NULL, NULL, 1, NULL),
(8, 'Kamil Stoch', 'Olympic Champion from Sochi 2014 and Pyeongchang 2018, 3-time won the Four-Hills Tournament', '2021-03-05 22:23:32', NULL, NULL, 1, NULL),
(10, 'Team Competition', 'Poland has reached a bronze medal in FIS Nordic Ski Championships in Oberstdorf 2021.', '2021-03-08 09:29:50', NULL, NULL, 1, NULL),
(12, 'Next station', 'Next station is Planica and Ski Flying!', '2021-03-08 10:33:23', NULL, NULL, 1, NULL),
(18, 'Kamil Stoch', 'Olympic Champion from Sochi 2014 and Pyeongchang 2018, 3-time won the Four-Hills Tournament, World Champion from Val di Fiemme 2013', '2021-03-05 22:23:32', '2021-03-08 15:28:03', NULL, 1, 8),
(19, 'Kamil Stoch', 'Olympic Champion from Sochi 2014 and Pyeongchang 2018, 3-time won the Four-Hills Tournament, World Champion from Val di Fiemme 2013, 5-time won World Cup competition in Zakopane', '2021-03-08 15:28:03', '2021-03-08 15:30:10', NULL, 1, 18),
(20, 'Next station', 'Next station is Planica and Ski Flying on Letalnica!', '2021-03-08 10:33:23', '2021-03-08 15:31:56', NULL, 1, 12),
(21, 'Next station', 'Next station is Planica and Ski Flying on Letalnica HS240!', '2021-03-08 10:33:23', '2021-03-08 15:56:30', NULL, 1, 20),
(22, 'Next station', 'Next station is Planica and Ski Flying on Letalnica HS240 where Kamil Stoch jumped 251.5m in 2017!', '2021-03-08 10:33:23', '2021-03-08 15:57:06', NULL, NULL, 21),
(23, 'Team Competition', 'Poland has reached a bronze medal in FIS Nordic Ski Championships in Oberstdorf 2021, Austria won a silver medal', '2021-03-08 09:29:50', '2021-03-08 18:00:35', NULL, NULL, 10),
(24, 'Weather', 'Sun is shining.', '2021-03-08 18:10:40', NULL, NULL, 1, NULL),
(25, 'Weather v2', 'It is sunny but cold.', '2021-03-08 18:10:40', '2021-03-08 18:11:53', NULL, 1, 24),
(26, 'It\'s a beautiful day!', 'Yeah, it works.', '2021-03-08 18:25:52', NULL, NULL, 1, NULL),
(27, 'It\'s a beautiful day!', 'Yeah, it works. It\'s amazing!', '2021-03-08 18:25:52', '2021-03-08 18:26:11', NULL, NULL, 26),
(28, 'The best jumper', 'Olympic Champion from Sochi 2014 and Pyeongchang 2018, 3-time won the Four-Hills Tournament, World Champion from Val di Fiemme 2013, 5-time won World Cup competition in Zakopane', '2021-03-08 15:28:03', '2021-03-08 18:26:41', 1, NULL, 19),
(29, 'World Champion from the Large Hill', 'Today, the World Champion is Stefan Kraft. Schattenbergschanze, Oberstdorf 2021', '2021-03-05 22:21:50', '2021-03-08 20:31:02', 1, NULL, 7),
(30, 'Good Morning', 'It\'s a beautiful and sunny morning. Today is Tuesday. Birds sing their own song.', '2021-03-09 09:11:09', NULL, NULL, NULL, NULL),
(31, 'Weather v3', 'It is sunny but cold, tomorrow\'s weather will be perfect.', '2021-03-08 18:10:40', '2021-03-09 10:04:44', NULL, NULL, 25),
(32, 'Music', 'Coldplay is singing Fix You now.', '2021-03-09 10:06:01', NULL, NULL, 1, NULL),
(33, 'Music', 'Coldplay is singing Fix You now and they they will sing Viva la Vida.', '2021-03-09 10:06:01', '2021-03-09 10:33:07', NULL, 1, 32),
(34, 'Music', 'Coldplay is singing Fix You now and they they will sing Viva la Vida and A Sky Full of Stars.', '2021-03-09 10:06:01', '2021-03-09 10:35:03', NULL, NULL, 33),
(35, 'Tuesday\'s midday', 'I do not know, it\'s only test.', '2021-03-09 11:21:45', NULL, NULL, NULL, NULL),
(36, 'Wednesday sunset', 'The sun is just going down. It has a wonderful orange color.', '2021-03-10 17:16:32', NULL, NULL, NULL, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
