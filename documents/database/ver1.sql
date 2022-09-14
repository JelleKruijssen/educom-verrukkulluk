-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 sep 2022 om 16:34
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ver1`
--

--
-- Gegevens worden geëxporteerd voor tabel `article`
--

INSERT INTO `article` (`id`, `NaamArtikel`, `Beschrijving`, `photo`, `price`, `packaging`, `units`, `calories`, `totalCalories`) VALUES
(1, 'Burger', 'Een Hamburger', '', 1299, 250, '0', 200, 0),
(2, 'Brood', 'Een hamburger broodje', '', 499, 100, '0', 50, 0),
(3, 'Saus', 'Saus voor op de hamburger', '', 749, 250, '0', 150, 0),
(4, 'Sla', 'Sla', '', 499, 100, '0', 20, 0),
(5, 'garnalen', 'Garnalen', '', 749, 250, 'gr', 150, 0),
(6, 'rijst', 'rijst', '', 399, 500, 'gr', 30, 0),
(7, 'Saus', 'Saus voor over de rijst en garnalen', '', 699, 250, 'gr', 250, 0);

--
-- Gegevens worden geëxporteerd voor tabel `ingrediënt`
--

INSERT INTO `ingrediënt` (`id`, `recipe_id`, `article_id`, `amount`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 4),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 2, 5, 2),
(6, 2, 6, 1),
(7, 2, 7, 1);

--
-- Gegevens worden geëxporteerd voor tabel `kitchentype`
--

INSERT INTO `kitchentype` (`id`, `record_type`, `description`) VALUES
(1, 'K', 'Amerikaans'),
(2, 'T', 'Vlees'),
(3, 'T', 'Vis'),
(4, 'K', 'Chinees');

--
-- Gegevens worden geëxporteerd voor tabel `recipe`
--

INSERT INTO `recipe` (`id`, `kitchen_id`, `type_id`, `user_id`, `date_added`, `titel`, `short_description`, `long_description`, `photo`) VALUES
(1, 1, 2, 3, '2022-09-13', 'hamburger', 'hamburger', 'hamburger', NULL),
(2, 3, 4, 2, '2022-09-13', 'garnalen', 'chinese garnalen', 'Dit zijn chinese garnalen', NULL);

--
-- Gegevens worden geëxporteerd voor tabel `recipe_info`
--

INSERT INTO `recipe_info` (`id`, `recipe_id`, `record_type`, `user_id`, `date`, `numeric_field`, `text_field`) VALUES
(1, 1, 'O', 2, '2022-09-13', NULL, 'Het was lekker'),
(2, 2, 'F', 4, NULL, NULL, NULL),
(3, 1, 'B', NULL, '2022-09-13', 1, 'Kook als eerste de hamburger in een pan'),
(4, 2, 'W', NULL, NULL, 3, NULL);

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `photo`) VALUES
(1, 'Arjen Nieuwhuizen', 'Wachtwoord', 'arjennieuwhuizen@example.com', ''),
(2, 'Quirien Pont', 'Wachtwoord', 'quirienpont@example.com', ''),
(3, 'Froukje Wolswijk', 'Wachtwoord', 'froukjewolswijk@example.com', ''),
(4, 'Louwe de Greef', 'Wachtwoord', 'louwedegreef@example.com', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
