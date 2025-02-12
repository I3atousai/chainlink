-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 16 2024 г., 22:33
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `secret_grinch`
--

-- --------------------------------------------------------

--
-- Структура таблицы `logged_box`
--

CREATE TABLE `logged_box` (
  `id` int NOT NULL,
  `name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `founder_id` int NOT NULL,
  `join_hash` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `closed_or_oped` tinyint(1) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `logged_box`
--

INSERT INTO `logged_box` (`id`, `name`, `founder_id`, `join_hash`, `closed_or_oped`, `date_create`) VALUES
(17, 'santa', 4, '$2y$10$zUGj05ppo0TjKswKaNplI.IdPx/K1p8D8.w2dbF55EEo4pDUNenDO', 1, '2024-12-16 12:39:44');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_pic_path` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '../PFPictures/def_avatar.jpg',
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_reset_hash` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass_reset_time` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `profile_pic_path`, `email`, `password`, `pass_reset_hash`, `pass_reset_time`, `date_create`) VALUES
(4, 'ivan', '../PFPictures/def_avatar.jpg', 'abobaeber@yahoo.com', '$2y$10$usf8tZCb19JRMfqFNpMHAOG5fKGp0fH77vQypjEMXpu.mYAoE0l/a', NULL, NULL, '2024-11-26 17:52:41'),
(13, 'boba', '../PFPictures/def_avatar.jpg', 'boba@mail.com', '$2y$10$v4Ut9vEHhou7pZ5JQ2KhfeFbCCN9aaacp88ln7MAQ2X4wPISWEJH2', NULL, NULL, '2024-11-30 15:52:28'),
(14, 'bimba', '../PFPictures/def_avatar.jpg', 'bimba@mail.ru', '$2y$10$1ZUAURzxGvU4rxAXC/94YeY1jfRAQm3pCPnv3xx2Jbo.BoSpzMQo6', NULL, NULL, '2024-11-30 15:52:50'),
(15, 'gogo', '../PFPictures/def_avatar.jpg', 'gogo@mail.ru', '$2y$10$fKFJ98aqBRUXUzpT8SvK9OMcqTFJJoXke3lB3EgeyaIilKKJNDihq', NULL, NULL, '2024-11-30 15:53:02'),
(16, 'baba', '../PFPictures/def_avatar.jpg', 'baba@mail.ru', '$2y$10$5Mn0kTgR1gqBdJ09t5TSweAJ99pIK3v3gM5Y.NBariZGyZpqJiBMe', NULL, NULL, '2024-11-30 15:53:14'),
(17, 'gundam', '../PFPictures/def_avatar.jpg', 'gundam@mail.ru', '$2y$10$WLV95pUWYjGGTbB09S7NnOHMDe4B6vCPqCJL.9yQhO9UoLOZIQY6y', NULL, NULL, '2024-11-30 15:54:12');

-- --------------------------------------------------------

--
-- Структура таблицы `users_and_logged_boxes`
--

CREATE TABLE `users_and_logged_boxes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `box_id` int NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users_and_logged_boxes`
--

INSERT INTO `users_and_logged_boxes` (`id`, `user_id`, `box_id`, `date_create`) VALUES
(13, 16, 17, '2024-12-16 12:39:45'),
(14, 14, 17, '2024-12-16 12:39:45'),
(15, 17, 17, '2024-12-16 12:39:45'),
(16, 4, 17, '2024-12-16 13:00:25');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `logged_box`
--
ALTER TABLE `logged_box`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`founder_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_and_logged_boxes`
--
ALTER TABLE `users_and_logged_boxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`user_id`),
  ADD KEY `logged_box` (`box_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `logged_box`
--
ALTER TABLE `logged_box`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users_and_logged_boxes`
--
ALTER TABLE `users_and_logged_boxes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
