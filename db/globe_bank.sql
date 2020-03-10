-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 10 2020 г., 11:50
-- Версия сервера: 5.5.48
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `globe_bank`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL,
  `subject_id` int(20) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(1, 1, 'Globe Bank', 1, 1, 'wadawdawd'),
(2, 1, 'History', 2, 1, 'wadawwwdawd'),
(3, 1, 'Leadership', 3, 1, 'wwwwwd'),
(4, 1, 'Contact Us', 4, 1, 'wadawsssswwdawd'),
(5, 2, 'Banking', 1, 1, 'wqqqqqadawwwdawd'),
(6, 2, 'Credit Cards', 2, 1, 'tttttwdawd'),
(7, 2, 'Mortgages', 3, 1, 'gggggggggggg'),
(8, 3, 'Checking', 1, 1, 'wqqqqqadawwwdawd'),
(9, 3, 'Loans', 2, 1, 'dddddddddddwwwdawd'),
(10, 3, 'Merchant Services', 3, 1, 'uuuuud');

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint(20) unsigned NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'About Globe Bank', 1, 1),
(2, 'Consumer', 2, 1),
(3, 'Small Bussiness', 3, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
