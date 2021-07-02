-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-07-02 10:40:06
-- サーバのバージョン： 10.4.18-MariaDB
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `_project`
--
CREATE DATABASE IF NOT EXISTS `_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `_project`;

-- --------------------------------------------------------

--
-- テーブルの構造 `acount_data`
--

CREATE TABLE `acount_data` (
  `datetime` datetime DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `acount_data`
--

INSERT INTO `acount_data` (`datetime`, `time`) VALUES
('2021-06-30 00:00:00', 0),
('2021-06-30 00:00:00', 0),
('2021-06-30 11:04:10', 0),
('2021-06-30 11:04:48', 0),
('2021-06-30 11:09:51', 0),
('2021-06-30 11:09:53', 0),
('2021-06-30 11:09:56', 0),
('2021-06-30 11:18:57', 0),
('2021-06-30 12:06:36', 0),
('2021-06-30 12:06:43', 0),
('2021-06-30 12:06:45', 0),
('2021-06-30 12:06:49', 0),
('2021-06-30 12:06:52', 0),
('2021-07-02 11:14:56', 0),
('2021-07-02 12:46:01', 0),
('2021-07-02 12:46:11', 0),
('2021-07-02 12:46:18', 0),
('2021-07-02 12:46:22', 0),
('2021-07-02 12:46:30', 0),
('2021-07-02 12:46:47', 0),
('2021-07-02 12:55:24', 0),
('2021-07-02 12:55:45', 0),
('2021-07-02 12:56:24', 0),
('2021-07-02 14:28:12', 0),
('2021-07-02 14:28:55', 0),
('2021-07-02 14:37:14', 0),
('2021-07-02 14:45:13', 0),
('2021-07-02 17:03:55', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `login_data`
--

CREATE TABLE `login_data` (
  `code` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `login_data`
--

INSERT INTO `login_data` (`code`, `name`, `password`) VALUES
(1, 'chiba', 'koudai');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_product`
--

CREATE TABLE `mst_product` (
  `code` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `gazou` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_product`
--

INSERT INTO `mst_product` (`code`, `name`, `price`, `gazou`, `datetime`) VALUES
(1, 'きゃべつ', 100, '', NULL),
(2, 'とまと', 1000, '', NULL),
(3, 'みかん', 500, '', NULL),
(4, 'すいか', 200, '', NULL),
(9, 'ごぼう', 100, '', NULL),
(16, 'おれ', 1100000, '天音かなたん.jpg', NULL),
(17, 'おれ', 1100000, '天音かなたん.jpg', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`code`);

--
-- テーブルのインデックス `mst_product`
--
ALTER TABLE `mst_product`
  ADD PRIMARY KEY (`code`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `login_data`
--
ALTER TABLE `login_data`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `mst_product`
--
ALTER TABLE `mst_product`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
