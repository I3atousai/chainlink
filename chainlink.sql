-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 03 2025 г., 16:38
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
-- База данных: `chainlink`
--

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `long_link` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `short_link` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `id_user`, `long_link`, `date_create`, `short_link`) VALUES
(32, NULL, '         unlink(\"../../links/\" . $link[\'short_link\']);', '2025-01-31 15:21:27', 'Wj0pd3G.php'),
(33, NULL, '         unlink(\"../../links/\" . $link[\'short_link\']);', '2025-01-31 15:21:28', 'Wi6hPNS.php'),
(46, 4, '. \'\"\'', '2025-01-31 15:50:14', 'FnIW2v2.php'),
(47, 4, 'http://chainlink/links/FnIW2v2.php', '2025-02-01 16:46:39', 'vUXPVDm.php'),
(49, 17, 'aslanyan121@gmail.com', '2025-02-01 18:49:51', 'aNXeRJG.php');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass_reset_hash` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass_reset_time` datetime DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `pass_reset_hash`, `pass_reset_time`, `date_create`) VALUES
(4, 'ivan', 'abobaeber@yahoo.com', '$2y$10$usf8tZCb19JRMfqFNpMHAOG5fKGp0fH77vQypjEMXpu.mYAoE0l/a', '2y10S4utMEYrzzObVZMoD6De3UF13kF3dtRMaczdPVsuNgae8cEsRoC', '2024-12-26 09:57:56', '2024-11-26 17:52:41'),
(13, 'boba', 'boba@mail.com', '$2y$10$v4Ut9vEHhou7pZ5JQ2KhfeFbCCN9aaacp88ln7MAQ2X4wPISWEJH2', '2y10MvN6JX0rjp0oz1S07YhOxxYCn9I6bKQ5bxfDjpOBGVwp47ZrGMC', '2024-12-26 09:58:19', '2024-11-30 15:52:28'),
(14, 'bimba', 'bimba@mail.ru', '$2y$10$1ZUAURzxGvU4rxAXC/94YeY1jfRAQm3pCPnv3xx2Jbo.BoSpzMQo6', '2y10HkAJ3GjPaMb2x1jfTByp6G9dlmTLJgIMFHKF0leRdsfhdgQwbc4K', '2024-12-26 09:59:04', '2024-11-30 15:52:50'),
(15, 'gogo', 'gogo@mail.ru', '$2y$10$fKFJ98aqBRUXUzpT8SvK9OMcqTFJJoXke3lB3EgeyaIilKKJNDihq', '2y1037i7RavRPqfPxtmEJNh8evbA6tOA3cPVO3bJot0ZbYPDnnLFPge', '2024-12-26 09:59:16', '2024-11-30 15:53:02'),
(16, 'baba', 'baba@mail.ru', '$2y$10$5Mn0kTgR1gqBdJ09t5TSweAJ99pIK3v3gM5Y.NBariZGyZpqJiBMe', '2y101nId33Jmm3u2npKryPhNrlyK516IF3Dfq0q91IdxqcAnSENvgV2', '2024-12-26 09:59:27', '2024-11-30 15:53:14'),
(17, 'gundam', 'aslanyan121@gmail.com', '$2y$10$BuJpXUQz71BdWhpz6WJ7D.gEqPVzvodXOr9CteFRoT36F1H9YHkza', 'NULL', '2025-02-01 09:47:59', '2024-11-30 15:54:12'),
(18, 'Chabum', 'chabum@gmail.com', '$2y$10$yji.u.6ro0EEYKt.VxWbj.JN4C.Cqls3CNk.Y5/NO7/ewq6IhRQKS', NULL, NULL, '2025-01-28 14:19:50');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`id_user`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
