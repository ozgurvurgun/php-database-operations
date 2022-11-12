-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Kas 2022, 01:13:23
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `trainingdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `MemberID` int(11) UNSIGNED NOT NULL,
  `MemberUsername` varchar(50) NOT NULL,
  `MemberPassword` varchar(100) NOT NULL,
  `MemberEmail` varchar(90) NOT NULL,
  `MemberName` char(50) NOT NULL,
  `MemberLastname` char(40) NOT NULL,
  `MemberBrithday` varchar(15) NOT NULL,
  `MemberConfrim` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `MemberAddtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`MemberID`, `MemberUsername`, `MemberPassword`, `MemberEmail`, `MemberName`, `MemberLastname`, `MemberBrithday`, `MemberConfrim`, `MemberAddtime`) VALUES
(1, 'ece_reis', '123456ece', 'ecesenoz7@gmail.com', 'Ece', 'Şensöz', '17.11.2000', 1, '2022-11-06 13:44:41'),
(2, 'Cadi_Ela', '123456ela', 'ela35@gmail.com', 'Ela', 'Sönmez', '01.08.2021', 1, '2022-11-06 14:10:04'),
(3, 'ozgur_<3_ece', '123456ozgur', '216001005@stu.adu.edu.tr', 'Özgür', 'VURGUN', '17.09.2000', 1, '2022-11-06 14:11:10'),
(4, 'velet_tez', '123456velet', 'velet65@gmail.com', 'Velat', 'TEZEL', '01.11.1999', 0, '2022-11-10 21:54:52'),
(5, 'birsenin_kadraji', '123456birsen', 'birsenvrg@gmail.com', 'Birsen', 'VURGUN', '15.07.1987', 1, '2022-11-10 21:56:23'),
(6, 'hazal_sonmez', '12345hazal', 'hazal.ela@gmail.com', 'Hazal', 'SÖNMEZ', '15.06.1992', 1, '2022-11-10 22:10:36'),
(7, 'kado_35', '123456Kado', 'kado@kado.com', 'Kadriye', 'VURGUN', '16.03.1965', 1, '2022-11-11 19:38:45'),
(8, 'hackerEce', '5b5cc3a3140b1e6caafa4e63773', 'ecehack@gmail.com', 'Ece', 'HACKSÖZ', '15.11.2000', 1, '2022-11-11 23:32:48'),
(9, 'hackerEla', 'ba0f0b77481999433f8d3e68bbb', 'elahack@gmail.com', 'Ele', 'HACKSÖZ', '15.11.2000', 1, '2022-11-11 23:34:01'),
(10, 'baris_vurgun_35', '0de01c0d729ad96a8473b396f0d0091c', 'barishack35@gmail.com', 'Barış', 'VURGUN', '01.01.1986', 1, '2022-11-11 23:37:38');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `MemberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
