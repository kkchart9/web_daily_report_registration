-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-04-27 12:11:38
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `works`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_no` varchar(4) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `auth_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `user_no`, `name`, `password`, `auth_type`) VALUES
(1, '1', '古波津', '$2y$10$ZyWc8E0HlJkGflJ5b6l5nuVYFRlPbNDlsS6z.k36Bmts87iJBIenW', 0),
(2, '2', '管理者', '$2y$10$e8ufL0lGUaUW2IO13v7dGumD.MbuYzZDzjIZkmzrdqwicfHHAIvlG', 1),
(4, '3', 'taro', '$2y$10$e8ufL0lGUaUW2IO13v7dGumD.MbuYzZDzjIZkmzrdqwicfHHAIvlG', 1),
(5, '4', 'ziro', '$2y$10$e8ufL0lGUaUW2IO13v7dGumD.MbuYzZDzjIZkmzrdqwicfHHAIvlG', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `break_time` time DEFAULT NULL,
  `comment` text COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `work`
--

INSERT INTO `work` (`id`, `user_id`, `date`, `start_time`, `end_time`, `break_time`, `comment`) VALUES
(94, 1, '2022-04-01', '18:43:00', '18:43:00', '01:00:00', 'tesuto'),
(95, 1, '2022-04-02', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(97, 1, '2022-04-04', '20:55:00', '20:55:00', '01:00:00', '2/4テスト'),
(98, 1, '2022-04-05', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(99, 1, '2022-04-06', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(100, 1, '2022-04-07', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(101, 1, '2022-04-08', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(102, 1, '2022-04-09', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(103, 1, '2022-04-10', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(104, 1, '2022-04-11', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(105, 1, '2022-04-12', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(106, 1, '2022-04-13', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(107, 1, '2022-04-14', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(108, 1, '2022-04-15', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(109, 1, '2022-04-16', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(110, 1, '2022-04-17', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(111, 1, '2022-04-18', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(112, 1, '2022-04-19', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(113, 1, '2022-04-20', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(114, 1, '2022-04-21', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(116, 1, '2022-04-23', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(117, 1, '2022-04-24', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(118, 1, '2022-04-25', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(119, 1, '2022-04-26', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(120, 1, '2022-04-27', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(121, 1, '2022-04-28', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(122, 1, '2022-04-29', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(123, 1, '2022-04-30', '09:00:00', '18:00:00', '01:00:00', 'テストテストテストテスト…'),
(124, 1, '0000-00-00', '16:30:00', '17:20:00', '01:00:00', 'テストテストテストテスト…'),
(125, 1, '2021-12-04', '09:00:00', '18:00:00', '01:00:00', '登録テスト'),
(126, 1, '2022-04-22', '17:20:00', '17:20:00', '01:00:00', ''),
(127, 1, '2022-04-03', '19:15:00', '19:15:00', '01:00:00', '登録２'),
(128, 2, '2022-04-01', '20:56:00', '20:56:00', '01:00:00', '4/1テスト'),
(129, 2, '0000-00-00', '14:25:00', '14:25:00', '01:00:00', 'tesuto\r\n');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
