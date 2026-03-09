-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0:3306
-- Время создания: Мар 09 2026 г., 07:43
-- Версия сервера: 8.0.43
-- Версия PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lb_pdo_films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actor`
--

CREATE TABLE `actor` (
  `ID_Actor` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `actor`
--

INSERT INTO `actor` (`ID_Actor`, `name`) VALUES
(8, 'Bryce Dallas Howard'),
(4, 'Chris Pratt'),
(7, 'Jordana Brewster'),
(9, 'Keanu Reeves'),
(6, 'Paul Walker'),
(1, 'Sam Worthington'),
(3, 'Sigourney Weaver'),
(5, 'Vin Diesel'),
(2, 'Zoe Saldana');

-- --------------------------------------------------------

--
-- Структура таблицы `film`
--

CREATE TABLE `film` (
  `ID_FILM` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `FID_Quality` varchar(10) NOT NULL,
  `director` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `film`
--

INSERT INTO `film` (`ID_FILM`, `name`, `date`, `country`, `FID_Quality`, `director`) VALUES
(1, 'Avatar', '2009-12-18', 'USA', 'FHD', 'James Cameron'),
(2, 'Guardians of the Galaxy', '2014-08-01', 'USA', 'FHD', 'James Gunn'),
(3, 'Fast & Furious', '2009-04-03', 'USA', 'FHD', 'Justin Lin'),
(4, 'Jurassic World', '2015-06-12', 'USA', 'FHD', 'Colin Trevorrow'),
(5, 'The Matrix', '1999-03-31', 'USA', 'FHD', 'Wachowski Sisters');

-- --------------------------------------------------------

--
-- Структура таблицы `film_actor`
--

CREATE TABLE `film_actor` (
  `FID_Film` int NOT NULL,
  `FID_Actor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `film_actor`
--

INSERT INTO `film_actor` (`FID_Film`, `FID_Actor`) VALUES
(1, 3),
(1, 1),
(1, 2),
(3, 5),
(3, 6),
(3, 7),
(2, 4),
(2, 2),
(2, 5),
(4, 4),
(4, 8),
(5, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `film_genre`
--

CREATE TABLE `film_genre` (
  `FID_Film` int NOT NULL,
  `FID_Genre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `film_genre`
--

INSERT INTO `film_genre` (`FID_Film`, `FID_Genre`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 5),
(4, 1),
(4, 2),
(4, 6),
(5, 1),
(5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `ID_Genre` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`ID_Genre`, `title`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(4, 'Comedy'),
(3, 'Fantasy'),
(6, 'Sci-Fi'),
(5, 'Thriller');

-- --------------------------------------------------------

--
-- Структура таблицы `quality`
--

CREATE TABLE `quality` (
  `ID_QUALITY` varchar(10) NOT NULL,
  `resolution` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `quality`
--

INSERT INTO `quality` (`ID_QUALITY`, `resolution`) VALUES
('FHD', '1920 x 1080'),
('HD', '1280 x 720'),
('SD', '720 x 480');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`ID_Actor`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_FILM`),
  ADD KEY `FILM_fk0` (`FID_Quality`);

--
-- Индексы таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD KEY `FILM_ACTOR_fk0` (`FID_Film`),
  ADD KEY `FILM_ACTOR_fk1` (`FID_Actor`);

--
-- Индексы таблицы `film_genre`
--
ALTER TABLE `film_genre`
  ADD KEY `FILM_GENRE_fk0` (`FID_Film`),
  ADD KEY `FILM_GENRE_fk1` (`FID_Genre`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_Genre`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Индексы таблицы `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`ID_QUALITY`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actor`
--
ALTER TABLE `actor`
  MODIFY `ID_Actor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `film`
--
ALTER TABLE `film`
  MODIFY `ID_FILM` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `ID_Genre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `FILM_fk0` FOREIGN KEY (`FID_Quality`) REFERENCES `quality` (`ID_QUALITY`);

--
-- Ограничения внешнего ключа таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD CONSTRAINT `FILM_ACTOR_fk0` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `FILM_ACTOR_fk1` FOREIGN KEY (`FID_Actor`) REFERENCES `actor` (`ID_Actor`);

--
-- Ограничения внешнего ключа таблицы `film_genre`
--
ALTER TABLE `film_genre`
  ADD CONSTRAINT `FILM_GENRE_fk0` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `FILM_GENRE_fk1` FOREIGN KEY (`FID_Genre`) REFERENCES `genre` (`ID_Genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
