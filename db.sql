-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Čtv 21. bře 2024, 11:16
-- Verze serveru: 8.0.36-0ubuntu0.20.04.1
-- Verze PHP: 7.4.3-4ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `db_jirouseq`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `large` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dir_upload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `group_id` int DEFAULT NULL,
  `language_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `menu` tinyint(1) NOT NULL DEFAULT '0',
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `heading` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `authorName` varchar(255) DEFAULT NULL,
  `orderMenu` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `pages`
--

INSERT INTO `pages` (`id`, `group_id`, `language_code`, `published`, `menu`, `homepage`, `url`, `title`, `heading`, `text`, `description`, `keywords`, `createDate`, `authorName`, `orderMenu`) VALUES
(592, 592, 'cs', 1, 1, 1, 'uvodni-stranka', 'Úvodní stránka', NULL, '<div class=\"row p-3 mb-3 bg-light\">\n<div class=\"col-lg-6 d-flex align-items-center\">\n<div>\n<h1 class=\"display-4\">V&iacute;tejte na na&scaron;em webu!</h1>\n<p class=\"lead\">Toto je jednoduch&yacute; př&iacute;klad textu, kter&yacute; doplňuje titulek a tvoř&iacute; z&aacute;kladn&iacute; č&aacute;st va&scaron;eho obsahu.</p>\n<hr class=\"my-4\" />\n<p>Pokračujte v prozkoum&aacute;v&aacute;n&iacute; na&scaron;eho webu.</p>\n<a class=\"btn btn-warning btn-lg\" role=\"button\" href=\"#\">V&iacute;ce informac&iacute;</a></div>\n</div>\n<div class=\"col-lg-6 text-center\"><img class=\"img-fluid rounded-circle\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/depositum-contacts.jpg\" alt=\"\" width=\"400\" /></div>\n</div>\n<div class=\"row mb-3\">\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Karta k dal&scaron;&iacute;mu obsahu</h5>\n<p class=\"card-text\">Doprovodn&yacute; text k dal&scaron;&iacute;mu obsahu</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Přej&iacute;t na obsah</a></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Karta k dal&scaron;&iacute;mu obsahu</h5>\n<p class=\"card-text\">Doprovodn&yacute; text k dal&scaron;&iacute;mu obsahu</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Přej&iacute;t na obsah</a></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Karta k dal&scaron;&iacute;mu obsahu</h5>\n<p class=\"card-text\">Doprovodn&yacute; text k dal&scaron;&iacute;mu obsahu</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Přej&iacute;t na obsah</a></div>\n</div>\n</div>\n</div>\n<div class=\"row\">\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/mountains-8451480_1920.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/dep-sit.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/new-home-g5622ecabd_640.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n</div>', 'Úvodní stránka', 'úvod, stránka, homepage', '2024-03-07 12:02:46', 'Jiří Vokřál', 1),
(593, 592, 'en', 1, 1, 1, 'homepage', 'Homepage', NULL, '<div class=\"row p-3 mb-3 bg-light\">\n<div class=\"col-lg-6 d-flex align-items-center\">\n<div>\n<h1 class=\"display-4\">Welcome to our website!</h1>\n<p class=\"lead\">This is a simple example of text that complements your headline and forms the core of your content.</p>\n<hr class=\"my-4\" />\n<p>Please continue to explore our website.</p>\n<a class=\"btn btn-warning btn-lg\" role=\"button\" href=\"#\">More information</a></div>\n</div>\n<div class=\"col-lg-6 text-center\"><img class=\"img-fluid rounded-circle\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/depositum-contacts.jpg\" alt=\"\" width=\"400\" /></div>\n</div>\n<div class=\"row mb-3\">\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Tab for more content</h5>\n<p class=\"card-text\">Accompanying text to other content</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Skip to content</a></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Tab for more content</h5>\n<p class=\"card-text\">Accompanying text to other content</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Skip to content</a></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Tab for more content</h5>\n<p class=\"card-text\">Accompanying text to other content</p>\n<a class=\"btn btn-outline-primary\" href=\"#\">Skip to content</a></div>\n</div>\n</div>\n</div>\n<div class=\"row\">\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/mountains-8451480_1920.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/dep-sit.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card\">\n<div class=\"card-body\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://codedesign.cz/test/mymvc/public/images/image/image/new-home-g5622ecabd_640.jpg\" alt=\"\" width=\"300\" /></div>\n</div>\n</div>\n</div>', 'Our homepage', 'homepage', '2024-03-07 12:02:46', 'Jiří Vokřál', 1),
(594, 594, 'cs', 1, 1, 0, 'o-nas', 'O nás', '', '<div class=\"jumbotron bg-light p-3\">\n<h1 class=\"display-4\">O n&aacute;s</h1>\n<p class=\"lead\">Jsme t&yacute;m překladatelů specializuj&iacute;c&iacute;ch se na překlady z angličtiny do če&scaron;tiny a obr&aacute;ceně. M&aacute;me rozs&aacute;hl&eacute; zku&scaron;enosti s pr&aacute;ci pro předn&iacute; streamovac&iacute; platformy jako HBO, Netflix a Amazon.</p>\n<hr class=\"my-4\" />\n<p>D&iacute;ky na&scaron;im letům zku&scaron;enost&iacute; jsme se stali l&iacute;dry v oboru a na&scaron;i klienti n&aacute;s oceňuj&iacute; pro na&scaron;i profesionalitu, spolehlivost a kvalitn&iacute; překlady.</p>\n</div>\n<div class=\"row g-3 my-4\">\n<div class=\"col-md-4\">\n<div class=\"card bg-primary text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">HBO</h5>\n<p class=\"card-text\">Spolupracujeme s HBO na překladech seri&aacute;lů a filmů, abychom zajistili vysokou kvalitu titulků pro česk&eacute; publikum.</p>\n</div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card bg-secondary text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Netflix</h5>\n<p class=\"card-text\">M&aacute;me dlouhodob&eacute; partnerstv&iacute; s Netflixem při překladech obsahu do če&scaron;tiny, což n&aacute;m d&aacute;v&aacute; hlubok&eacute; poznatky o požadavc&iacute;ch a standardech t&eacute;to platformy.</p>\n</div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card bg-info text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Amazon</h5>\n<p class=\"card-text\">Pro Amazon pracujeme na překladech filmů a seri&aacute;lů, abychom zajistili, že jejich obsah je dostupn&yacute; pro česk&eacute; publikum.</p>\n</div>\n</div>\n</div>\n</div>\n<div class=\"row mt-5\">\n<div class=\"col-md-6\">\n<h2>Na&scaron;e zku&scaron;enosti</h2>\n<p>Jsme py&scaron;n&iacute; na na&scaron;e dlouholet&eacute; zku&scaron;enosti v oblasti překladů. D&iacute;ky pr&aacute;ci pro předn&iacute; streamovac&iacute; služby jsme nabrali bohat&eacute; zku&scaron;enosti a z&iacute;skali důvěru sv&yacute;ch klientů.</p>\n<p>V na&scaron;&iacute; pr&aacute;ci se snaž&iacute;me vždy dodat nejlep&scaron;&iacute; možn&eacute; překlady s ohledem na jazykovou kvalitu, přesnost a spr&aacute;vn&yacute; kontext.</p>\n</div>\n<div class=\"col-md-6\">\n<h2>Na&scaron;e služby</h2>\n<p>Nab&iacute;z&iacute;me &scaron;irokou &scaron;k&aacute;lu služeb v oblasti překladů. Od překladu titulků a dabingu až po lokalizaci cel&yacute;ch filmů a seri&aacute;lů.</p>\n<p>Spolupracujeme s různ&yacute;mi klienty, od nez&aacute;visl&yacute;ch tvůrců až po velk&eacute; medi&aacute;ln&iacute; společnosti, a vždy se snaž&iacute;me plně vyhovět jejich potřeb&aacute;m.</p>\n</div>\n</div>', NULL, NULL, '2024-03-07 12:03:04', 'Jiří Vokřál', 2),
(595, 594, 'en', 1, 1, 0, 'about-us', 'About Us', NULL, '<div class=\"jumbotron bg-light p-3\">\n<h1 class=\"display-4\">About Us</h1>\n<p class=\"lead\">We are a team of translators specializing in translations from English to Czech and vice versa. We have extensive experience working for leading streaming platforms such as HBO, Netflix, and Amazon.</p>\n<hr class=\"my-4\" />\n<p>With years of experience, we have become leaders in the field, appreciated by our clients for our professionalism, reliability, and high-quality translations.</p>\n</div>\n<div class=\"row g-3 my-4\">\n<div class=\"col-md-4\">\n<div class=\"card bg-primary text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">HBO</h5>\n<p class=\"card-text\">We collaborate with HBO on translations of series and movies to ensure high-quality subtitles for the Czech audience.</p>\n</div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card bg-secondary text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Netflix</h5>\n<p class=\"card-text\">We have a longstanding partnership with Netflix for translating content into Czech, giving us deep insights into the platform\'s requirements and standards.</p>\n</div>\n</div>\n</div>\n<div class=\"col-md-4\">\n<div class=\"card bg-info text-white h-100\">\n<div class=\"card-body\">\n<h5 class=\"card-title\">Amazon</h5>\n<p class=\"card-text\">For Amazon, we work on translations of films and series to ensure that their content is accessible to the Czech audience.</p>\n</div>\n</div>\n</div>\n</div>\n<div class=\"row mt-5\">\n<div class=\"col-md-6\">\n<h2>Our Experience</h2>\n<p>We take pride in our extensive experience in translation. Through our work for leading streaming services, we have gained rich experience and earned the trust of our clients.</p>\n<p>In our work, we always strive to deliver the best possible translations with a focus on language quality, accuracy, and correct context.</p>\n</div>\n<div class=\"col-md-6\">\n<h2>Our Services</h2>\n<p>We offer a wide range of translation services. From subtitle translation and dubbing to localizing entire films and series.</p>\n<p>We work with various clients, from independent creators to large media companies, and always aim to fully meet their needs.</p>\n</div>\n</div>', NULL, NULL, '2024-03-07 12:03:04', 'Jiří Vokřál', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'editor'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userEmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `superAdmin` int NOT NULL DEFAULT '0',
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `userEmail`, `password`, `active`, `banned`, `createDate`, `superAdmin`, `role`) VALUES
(52, 'Admin', 'admin@admin.ad', '$2y$10$YjGZuK9S/H85fuAWbxNCzelSBMLglxy9jAPY.z8DzS3AtPi6r5dsi', 1, 0, '2024-03-19 14:04:16', 1, 'superAdmin');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_token`
--

CREATE TABLE `user_token` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `token` varchar(64) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT pro tabulku `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pro tabulku `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
