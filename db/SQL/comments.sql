-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Kas 2022, 23:37:23
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
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `ProductID` int(10) UNSIGNED NOT NULL,
  `CommentMesaage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`CommentID`, `UserID`, `ProductID`, `CommentMesaage`) VALUES
(1, 1, 1, 'güzel ürün kullanışlı'),
(2, 3, 2, 'kargo hızlıydı'),
(3, 2, 3, 'ürün hatalı gelmiş, hiç memnun kalmadım'),
(4, 2, 4, 'ürün resimde ki gibi değil...'),
(5, 8, 5, 'Kaliteli işletme'),
(6, 11, 6, 'Pakette ki sürpriz için teşekkürler'),
(7, 11, 7, 'Ürün elime paramparça ulaştı.'),
(8, 5, 8, 'Asla buradan alışveriş yapmayın'),
(9, 3, 9, 'Çok iyi hizmet veriyorlar, çok ilgililer.'),
(10, 3, 10, 'Bir daha asla buradan alışveriş yapmam.'),
(11, 1, 1, 'Herkese tavsiye ederim, çok kaliteli ürün.');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
