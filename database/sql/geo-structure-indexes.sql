-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 25 2016 г., 10:24
-- Версия сервера: 5.6.28-0ubuntu0.15.04.1
-- Версия PHP: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug` (`slug`), ADD KEY `regions_id` (`regions_id`), ADD KEY `name` (`name`), ADD KEY `name_2` (`name`), ADD KEY `slug_2` (`slug`);

--
-- Индексы таблицы `districts`
--
ALTER TABLE `districts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique` (`cities_id`,`name`), ADD KEY `cities` (`cities_id`);

--
-- Индексы таблицы `metro`
--
ALTER TABLE `metro`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique` (`cities_id`,`name`), ADD KEY `cities` (`cities_id`), ADD KEY `name` (`name`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `streets`
--
ALTER TABLE `streets`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_idx` (`name`,`cities_id`), ADD KEY `cities_id` (`cities_id`), ADD KEY `districts_id` (`districts_id`), ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=182309;
--
-- AUTO_INCREMENT для таблицы `districts`
--
ALTER TABLE `districts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1074;
--
-- AUTO_INCREMENT для таблицы `metro`
--
ALTER TABLE `metro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=296;
--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT для таблицы `streets`
--
ALTER TABLE `streets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=253465;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
