-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Kas 2022, 23:39:13
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
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `ProductID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductPrice` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`ProductID`, `UserID`, `ProductName`, `ProductPrice`) VALUES
(1, 1, 'Asus Bilgisayar Monitörü', 1750),
(2, 3, '16 Gb Ram', 420),
(3, 2, 'Bluetooth Kulaklık', 480),
(4, 2, 'Yaka Mikrofonu', 1380),
(5, 8, 'Tv Ünitesi', 1234),
(6, 11, 'Çalışma Masası', 960),
(7, 11, 'MSI Masaüstü Laptop', 16200),
(8, 5, 'MSI GEFORCE RTX 2080 TI Ekran Kartı', 17000),
(9, 3, 'İntel i9 7. Nesil İşlemci', 5120),
(10, 3, 'MSI MPG X570 GAMING EDGE WIFI Amd X570 Soket', 1900),
(11, 15, 'Asus X515 LAPTOP', 12999);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
