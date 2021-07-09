-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-07-08 17:50:02
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

-- --------------------------------------------------------

--
-- テーブルの構造 `acount_data`
--

CREATE TABLE `acount_data` (
  `date` date DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `acount_data`
--

INSERT INTO `acount_data` (`date`, `time`) VALUES
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-06-30', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-02', 0),
('2021-07-04', 0),
('2021-07-04', 0),
('2021-07-04', 0),
('2021-07-04', 0),
('2021-07-06', 0),
('2021-07-06', 0),
('2021-07-06', 0),
('2021-07-07', 0),
('2021-07-07', 0),
('2021-07-07', 0),
('2021-07-08', 0),
('2021-07-08', 0),
('2021-07-08', 0),
('2021-07-08', 0),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2021),
(NULL, 2021),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2021),
(NULL, 2021),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 1),
(NULL, 1),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 1),
(NULL, 1),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
(NULL, 0),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2),
('2021-07-08', 0),
('2021-07-08', 0),
(NULL, 2),
(NULL, 2);

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
  `datetime` datetime DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `letter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_product`
--

INSERT INTO `mst_product` (`code`, `name`, `price`, `gazou`, `datetime`, `flag`, `letter`) VALUES
(1, 'きゃべつ', 100, '', NULL, 0, 0),
(2, 'とまと', 1000, '', NULL, 0, 0),
(3, 'みかん', 500, '', NULL, 0, 0),
(4, 'すいか', 200, '', NULL, 0, 0),
(9, 'ごぼう', 100, '', NULL, 0, 0),
(16, 'おれ', 1100000, '天音かなたん.jpg', NULL, 0, 0),
(17, 'おれ', 1100000, '天音かなたん.jpg', NULL, 0, 0),
(18, '', 0, '', NULL, 0, 0);

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
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
