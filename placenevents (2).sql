-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 03 2020 г., 23:37
-- Версия сервера: 5.5.62
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `placenevents`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(10, 'встреча выпускников'),
(11, 'фестиваль'),
(12, '123'),
(13, 'Музыка'),
(14, 'Автомобили'),
(15, 'Радиотехника'),
(16, 'Танцы'),
(17, 'Политика'),
(18, 'Встреча с Володей');

-- --------------------------------------------------------

--
-- Структура таблицы `category_event`
--

CREATE TABLE `category_event` (
  `bound_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `event_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_event`
--

INSERT INTO `category_event` (`bound_id`, `category_id`, `event_id`) VALUES
(12, 11, 38),
(13, 10, 39),
(14, 10, 40),
(15, 13, 41),
(16, 13, 42),
(17, 14, 43),
(18, 14, 44),
(19, 13, 45),
(20, 11, 46),
(21, 15, 47),
(22, 15, 48),
(23, 16, 49),
(24, 17, 50),
(25, 18, 51);

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id` int(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `city`) VALUES
(4, 'Рузаевка'),
(3, 'Саранск');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `pubdate` datetime NOT NULL,
  `views` int(11) NOT NULL,
  `event_type` int(1) NOT NULL,
  `meeting_begin` datetime NOT NULL,
  `meeting_end` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'requested',
  `city` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `adds` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`event_id`, `title`, `address`, `description`, `author_id`, `pubdate`, `views`, `event_type`, `meeting_begin`, `meeting_end`, `status`, `city`, `category`, `adds`) VALUES
(38, 'Реклама фестиваля', 'Площадь Тысячелетия', 'Фестиваль Роботов в Саранске!', 18, '2020-01-10 05:55:07', 0, 1, '2020-01-17 13:13:00', '2020-01-17 18:00:00', 'approved', 'Саранск', 'фестиваль', 1),
(39, 'Встреча выпускников программистов ', 'Дзержинского, 15', 'Давно не виделись пора встрится. Давно не виделись пора встрится. Давно не виделись пора встрится. Давно не виделись пора встрится. Давно не виделись пора встрится. Давно не виделись пора встрится. Давно не виделись пора встрится. \r\n', 18, '2020-01-10 07:01:08', 0, 1, '2020-01-25 13:02:00', '2020-01-25 18:30:00', 'approved', 'Саранск', 'встреча выпускников', 0),
(40, 'Встреча выпускников филологов', 'Володарского 15', 'Скидываемся по 1000р!!!!!!!!!', 18, '2020-01-10 07:06:08', 0, 1, '2020-02-11 11:00:00', '2020-02-01 19:00:00', 'approved', 'Саранск', 'встреча выпускников', 0),
(41, 'Концерт группы \"Орехи\"', 'Советская Площадь, около спуска к парку', 'Всемирно известная рок-группа \"Орехи\", приедет к нам в город и выступит со своими хитами \"Долой плоскогубцы\", \"Натз\" и некоторыми другими. Проход свободный.', 18, '2020-01-10 07:14:18', 0, 1, '2020-02-19 13:00:00', '2020-02-19 15:00:00', 'approved', 'Саранск', 'Музыка', 0),
(42, 'Дом культуры и творчества', 'Московская 13', 'Дом культуры и творчества собирает учеников в музыкальное отделение. Готовы работать с учениками любого возраста. Мы предоставляем вам на выбор группы по Гитаре, Вокалу, Фортепиано, Флейта, Барабаны. Границы набора указаны ниже, а дальше работаем в то же время по будням(пн - пт).', 18, '2020-01-10 07:21:16', 0, 2, '2020-01-20 10:00:00', '2020-01-24 16:30:00', 'approved', 'Саранск', 'Музыка', 0),
(43, 'Автошкола', 'ленина 13', 'Набор в автошколу. Обучение 20 000р. Студентам скидки.', 18, '2020-01-10 07:22:54', 0, 2, '2020-01-17 09:00:00', '2020-01-25 16:30:00', 'approved', 'Саранск', 'Автомобили', 0),
(44, 'Выставка автомобилей', 'Советская Площадь', 'В Саранске пройдет большая выставка кастномных автомобилей. Приходите.', 18, '2020-01-10 07:24:23', 0, 1, '2020-03-10 13:00:00', '2020-03-10 19:00:00', 'approved', 'Саранск', 'Автомобили', 0),
(45, 'Открытие музыкального магазина', 'Центральный рынок, внизу, место 41', 'Открытие музыкального магазина с отечественными инструментами.', 18, '2020-01-10 07:42:01', 0, 2, '2020-01-25 10:00:00', '2020-01-25 16:30:00', 'approved', 'Саранск', 'Музыка', 0),
(46, 'Фестиваль Мордовской культуры', 'спуск Пушкинский парк', 'Будут представлены работы местных мастеров и возможность купить различные сувениры', 18, '2020-01-10 07:45:20', 0, 1, '2020-03-19 13:00:00', '2020-03-19 19:00:00', 'approved', 'Саранск', 'фестиваль', 0),
(47, 'Клуб радиолюбителей', 'Ленина 20', 'Открываем клуб радиолюбителей, приходите, будем рады новичкам и профессионалам!!!', 18, '2020-01-10 07:46:52', 0, 1, '2020-01-18 13:00:00', '2020-01-18 15:00:00', 'approved', 'Рузаевка', 'Радиотехника', 0),
(48, 'Лекция по радиотехнике для начинающих', 'Ленина 45', 'Лекция по радиотехнике для начинающих проведенная канд. физ. наук. Петровым. П. П.', 18, '2020-01-11 04:53:22', 0, 1, '2020-01-18 13:13:00', '2020-01-18 17:00:00', 'approved', 'Саранск', 'Радиотехника', 0),
(49, 'Swing Party', 'Володарского 16', 'Приходите семьей', 18, '2020-01-15 21:32:49', 0, 1, '2020-01-18 13:13:00', '2020-01-25 13:13:00', 'approved', 'Саранск', 'Танцы', 0),
(50, 'Люстрации', 'Администрация', 'Особенно приветствуются школьницы', 18, '2020-01-18 19:49:01', 0, 1, '2020-01-25 13:00:00', '2020-01-25 15:00:00', 'approved', 'Саранск', 'Политика', 1),
(51, 'Встреча с Володей', 'Центральный рынок, внизу, место 41', 'Если вы давно не видели Володю, вам представится возможность его скоро увидеть.', 18, '2020-01-23 20:56:44', 0, 1, '2020-01-17 13:13:00', '2020-01-17 13:14:00', 'approved', 'Саранск', 'Встреча с Володей', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `event_news`
--

CREATE TABLE `event_news` (
  `news_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `pubdate` datetime NOT NULL,
  `views` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `even_comments`
--

CREATE TABLE `even_comments` (
  `comment_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `pubdate` datetime NOT NULL,
  `event_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `even_comments`
--

INSERT INTO `even_comments` (`comment_id`, `text`, `pubdate`, `event_id`, `author_id`) VALUES
(6, 'Обязательно приду!!!', '2020-01-10 07:54:37', 47, 21),
(7, 'Отечественные....', '2020-01-10 07:55:22', 45, 21),
(8, 'Первым покупателям скидки!!!', '2020-01-10 07:56:02', 45, 18),
(9, 'Опять реклама...', '2020-01-10 07:58:03', 38, 20),
(10, 'Я ТАК ДАВНО ЭТО ЖДАЛ!!!!!!!!!', '2020-01-10 10:29:53', 41, 19),
(11, 'Будет весело!', '2020-01-10 10:30:33', 41, 18),
(12, 'Это моя любимая группа!', '2020-01-11 04:26:40', 41, 25),
(13, 'Обязательно приду', '2020-01-15 21:33:25', 49, 19),
(14, 'uuye', '2020-01-15 21:34:11', 49, 20),
(15, 'Хочу потанцевать', '2020-01-23 20:52:43', 49, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `user_type` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `first_name`, `second_name`, `middle_name`, `user_type`, `status`) VALUES
(14, 'vasya', '$2y$10$bNIYckeHaVWZQ7YydNlFMOyfx4svE5cfOA6tSXtJijreFv79vRFeS', 'Василий', 'Васильев', 'Васильевич', 1, 1),
(15, 'jora', '$2y$10$VjYtldHuChCzj5DSfiDyIuXP/dlc0zfWhjt2/PAmqIs4OdSwVlOzu', 'jora', 'jora', 'jora', 3, 1),
(16, 'vova', '$2y$10$jkaGx7LYp6j/63aYQ7t1Au4g3iyhSst.D./C1N47KVrEmRWOxGDxK', 'vova', 'vova', 'vova', 1, 1),
(17, 'vitynya', '$2y$10$iXBA0MsYemajJXAuNqu.iOcguFP3nxod1/WNq4uoeqJGAxPhxFl3W', 'Витюня', 'Крутов', '', 1, 1),
(18, 'org', '$2y$10$3qDdLewaDY6OdTWLOqMVF./Tb30JmmRawQU6LzwjCUfQ5WnV03imu', 'Компания', 'Организаторович', 'Организаторов', 2, 1),
(19, 'admin', '$2y$10$PpI5koWwSS8oYWSetG0VOe8wTuyazmjXX7tL7.Fm35ALLmjfkJFdC', 'admin', 'admin', 'admin', 1, 0),
(20, 'sanya', '$2y$10$HU0kl.rR19dTRqCXVFRyU.y2FJtD5XldA/7LWDa7zowy1eAr3Nm06', 'sanya', 'sanya', 'sanya', 4, 1),
(21, 'user1', '$2y$10$t1yW8NKMQZKdftdXPf7uV.cWnT7Pki5ANUME7HCzmovOBW1vPKybC', 'user1', 'user1', 'user1', 1, 1),
(22, 'user2', '$2y$10$fIGuOiRkSJ.FGorXUcGSIuUlOpJ/0ekxLcCjKnzbOrZMsBYQlH.ha', 'user2', 'user2', 'user2', 1, 1),
(23, 'user3', '$2y$10$anJMhyotVsNxJkfRSjOXpOt.9nn1QJGfdJtkNXn02Gx3wezqRTZmS', 'user3', 'user3', 'user3', 1, 1),
(24, 'user4', '$2y$10$CRSTFVWm1QTcbJI2lrOSWeSrzMZ1RgFiWkGA/LXu9JdVn6MawZeTG', 'user4', 'user4', 'user4', 1, 1),
(25, 'dima13', '$2y$10$UY1fBOM3I0k6tbxvU00v0utNF.mAf06Th.VBk3VDXSFS0w8FPsWxi', 'Дмитрий', 'Викторов', 'Петрович', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_category`
--

CREATE TABLE `user_category` (
  `bound_id` int(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_category`
--

INSERT INTO `user_category` (`bound_id`, `category_id`, `user_id`) VALUES
(9, 10, 22),
(18, 14, 21),
(19, 13, 25),
(21, 10, 20),
(22, 15, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `user_perms`
--

CREATE TABLE `user_perms` (
  `id` int(1) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wanna_go`
--

CREATE TABLE `wanna_go` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bound_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wanna_go`
--

INSERT INTO `wanna_go` (`event_id`, `user_id`, `bound_id`) VALUES
(47, 21, 13),
(45, 21, 14),
(39, 20, 18),
(43, 20, 20),
(40, 20, 21),
(41, 22, 22),
(42, 22, 23),
(47, 22, 24),
(47, 23, 25),
(43, 23, 26),
(41, 23, 27),
(42, 23, 28),
(41, 24, 29),
(38, 24, 30),
(41, 25, 32),
(47, 20, 36),
(49, 20, 37),
(41, 20, 38);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `category_event`
--
ALTER TABLE `category_event`
  ADD PRIMARY KEY (`bound_id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city` (`city`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Индексы таблицы `event_news`
--
ALTER TABLE `event_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `event_news_fk0` (`event_id`);

--
-- Индексы таблицы `even_comments`
--
ALTER TABLE `even_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`bound_id`),
  ADD KEY `user_category_fk0` (`category_id`),
  ADD KEY `user_category_fk1` (`user_id`);

--
-- Индексы таблицы `user_perms`
--
ALTER TABLE `user_perms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wanna_go`
--
ALTER TABLE `wanna_go`
  ADD PRIMARY KEY (`bound_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `category_event`
--
ALTER TABLE `category_event`
  MODIFY `bound_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `event_news`
--
ALTER TABLE `event_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `even_comments`
--
ALTER TABLE `even_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `user_category`
--
ALTER TABLE `user_category`
  MODIFY `bound_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `user_perms`
--
ALTER TABLE `user_perms`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wanna_go`
--
ALTER TABLE `wanna_go`
  MODIFY `bound_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event_news`
--
ALTER TABLE `event_news`
  ADD CONSTRAINT `event_news_fk0` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
