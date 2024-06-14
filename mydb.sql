-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-06-14 08:38:49
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `boards`
--

INSERT INTO `boards` (`board_id`, `name`, `description`, `faculty`) VALUES
(22, '機械工学科', NULL, '工学部'),
(23, '先端材料工学科', NULL, '工学部'),
(24, '電気電子工学科', NULL, '工学部'),
(25, '情報通信システム工学科', NULL, '工学部'),
(26, '応用科学科', NULL, '工学部'),
(27, '機械電子創成工学科', NULL, '工学部'),
(28, '建築学科', NULL, '創造工学部'),
(29, 'デザイン科学学科', NULL, '創造工学部'),
(30, '都市環境工学科', NULL, '創造工学部'),
(31, '未来ロボティクス学科', NULL, '先進工学部'),
(32, '生命学科', NULL, '先進工学部'),
(33, '知能メディア工学科', NULL, '先進工学部'),
(34, '情報工学科', NULL, '情報変革科学部'),
(35, '認知情報科学科', NULL, '情報変革科学部'),
(36, '高度応用情報科学科', NULL, '情報変革科学部'),
(37, '情報工学科', NULL, '情報科学部'),
(38, '情報ネットワーク学科', NULL, '情報科学部'),
(39, 'デジタル変革科学科', NULL, '未来変革科学部'),
(40, '経営デザイン科学科', NULL, '未来変革科学部'),
(41, '経営情報科学科', NULL, '社会システム科学部'),
(42, 'プロジェクトマネジメント学科', NULL, '社会システム科学部'),
(43, '金融・経営リスク科学科', NULL, '社会システム科学部');

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '名無しの千葉工大生',
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `helpful_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `thread_id`, `name`, `content`, `created_at`, `helpful_count`) VALUES
(36, 18, '名無しの千葉工大生', '囚人', '2024-05-09 03:25:53', 0),
(37, 18, 'おねがい', 'ああ', '2024-05-09 03:26:05', 0),
(38, 18, 'おねがい', 'ああ', '2024-05-09 03:26:09', 0),
(39, 18, '名無しの千葉工大生', '囚人', '2024-05-09 03:26:15', 0),
(40, 18, 'jii', 'nk', '2024-05-10 03:15:26', 0),
(41, 20, 'fsdf', 'sdfsdf', '2024-05-10 05:32:25', 0),
(42, 22, 'おねがい', 'aaaaaaaaaaaaaaaaaaa', '2024-05-10 07:12:38', 0),
(43, 24, 'dsd', 'dfsa', '2024-05-17 05:53:36', 25),
(44, 24, '名無しの千葉工大生', 'ちゅき', '2024-05-17 06:02:09', 0),
(45, 24, '名無しの千葉工大生', 'ちゅき', '2024-05-17 06:02:16', 0),
(46, 24, '名無しの千葉工大生', 'いっぱいちゅき', '2024-05-17 06:02:29', 0),
(47, 23, '名無しの千葉工大生', '革命', '2024-05-23 05:19:26', 0),
(48, 23, '名無しの千葉工大生', '運命', '2024-05-23 05:19:30', 0),
(49, 30, 'しね', 'しね', '2024-06-07 20:30:08', 0),
(50, 29, 'ewq', 'eq', '2024-06-07 20:36:21', 0),
(51, 28, 'ewq', 'qew', '2024-06-07 20:36:30', 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `board_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_code` varchar(255) DEFAULT NULL,
  `post_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `threads`
--

INSERT INTO `threads` (`thread_id`, `board_id`, `title`, `content`, `user_code`, `post_date`) VALUES
(27, 25, 'ぱぱ', 'あか', NULL, '2024-06-07 15:20:49'),
(28, 26, 'ｆｓ', 'ｆｓ', NULL, '2024-06-08 05:20:21'),
(29, 26, 'れｗ', 'うぇｒ', NULL, '2024-06-08 05:20:46'),
(30, 36, 'えｒｗ', 'れｗ', NULL, '2024-06-08 05:25:33'),
(31, 42, 'ewq', 'eq', NULL, '2024-06-08 05:37:45');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `board_id` (`board_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- テーブルの AUTO_INCREMENT `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`board_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
