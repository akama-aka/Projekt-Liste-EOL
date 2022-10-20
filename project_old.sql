-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 09. Mai 2022 um 12:26
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `projects`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project_list`
--

CREATE TABLE `project_list` (
  `project_name` text NOT NULL,
  `project_progress` int(11) NOT NULL,
  `project_user` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`project_user`)),
  `id` int(11) NOT NULL,
  `user` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `project_list`
--

INSERT INTO `project_list` (`project_name`, `project_progress`, `project_user`, `id`, `user`) VALUES
('Alle Projekte hier einfügen', 0, '', 1, NULL),
('hjnxdji8nki', 53, '', 2, NULL),
('cdvdfgdfhdfgdg', 10, '', 3, NULL),
('test ', 10, '', 4, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project_todo`
--

CREATE TABLE `project_todo` (
  `todo_name` tinytext NOT NULL,
  `todo_description` mediumtext NOT NULL,
  `todo_progress` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `project_todo`
--

INSERT INTO `project_todo` (`todo_name`, `todo_description`, `todo_progress`, `project_id`, `id`) VALUES
('Alle Projekte hier einfügen', 'Fügt bitte hier alle Projekte ein die noch anstehen :3', 0, 1, 1),
('8i58o09', 'ki', 12, 2, 2),
('Test', 'Test', 100, 2, 3);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `project_list`
--
ALTER TABLE `project_list`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `project_todo`
--
ALTER TABLE `project_todo`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `project_todo`
--
ALTER TABLE `project_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
