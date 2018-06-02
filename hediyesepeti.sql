-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 May 2018, 20:36:02
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hediyesepeti`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begenme`
--

CREATE TABLE `begenme` (
  `begenme_id` int(11) NOT NULL,
  `yorum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `begen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `yorumid` int(11) NOT NULL,
  `yorumbaslik` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `yorumpuan` int(11) NOT NULL,
  `yorumicerik` varchar(310) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `yorumtarih` date NOT NULL,
  `urunid` int(11) NOT NULL,
  `usersid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`yorumid`, `yorumbaslik`, `yorumpuan`, `yorumicerik`, `yorumtarih`, `urunid`, `usersid`) VALUES
(408, 'asd', 2, 'asdasd', '2018-05-17', 8, 26),
(409, 'asd', 2, 'asd', '2018-05-17', 1, 26),
(410, 'a', 1, 'a', '2018-05-17', 2, 26);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments_answer`
--

CREATE TABLE `comments_answer` (
  `cevapid` int(11) NOT NULL,
  `cevapicerik` varchar(555) NOT NULL,
  `ustyorumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `answer_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `comments_answer`
--

INSERT INTO `comments_answer` (`cevapid`, `cevapicerik`, `ustyorumid`, `userid`, `answer_date`) VALUES
(33, 'asasd cevap', 0, 26, '05.05.2018 '),
(34, 'asasd cevap', 0, 26, '05.05.2018 '),
(35, 'asd', 366, 26, '05.05.2018 '),
(36, 'sadasd', 366, 26, '05.05.2018 '),
(37, 'deneme', 366, 26, '08.05.2018 '),
(38, 'deneme', 364, 27, '08.05.2018 ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iller`
--

CREATE TABLE `iller` (
  `id` int(11) NOT NULL,
  `il` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `iller`
--

INSERT INTO `iller` (`id`, `il`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyon'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elazığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkari'),
(31, 'Hatay'),
(32, 'Isparta');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(255) NOT NULL,
  `ust_kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`, `ust_kategori_id`) VALUES
(1, 'Popüler Hediye Grupları', 0),
(2, 'Kime Hediye', 0),
(3, 'Ne Hediyesi', 0),
(4, 'Tüm Ürünler', 0),
(5, 'Tişört & Giyim Ürünleri', 1),
(6, 'Fotoğraflı & Resimli Ürünler', 1),
(7, 'Bardak & Kupa & Termos', 1),
(8, 'Kişiye Özel Saatler', 1),
(9, 'Hediyelik Aksesuarlar', 1),
(10, 'İlginç Ürünler', 1),
(11, 'Kişiye Özel Çikolatalar', 1),
(12, 'Kişiye Özel Ajanda Modelleri', 1),
(13, 'İsme Özel Kalemler', 1),
(14, 'Tüm Kişiye Özel Hediyeler', 1),
(15, 'Sevgiliye', 2),
(16, 'Kadın', 2),
(17, 'Erkek', 2),
(18, 'Arkadaşa Hediye', 2),
(19, 'Bebek Hediyeleri', 2),
(20, 'Doğum Günü Hediyeleri', 3),
(21, 'Yıldönümü Hediyeleri', 3),
(22, 'Özel Günler', 3),
(23, 'Sevgililer Günü', 3),
(24, 'Kurumsal Hediyeler', 3),
(25, 'Baskılı Tişörtler Tümü', 5),
(26, 'Aile Tişörtleri', 5),
(27, 'Erkek Tişörtleri', 5),
(28, 'Bayan Tişortleri', 5),
(29, 'Sevgiliye Hediye', 15),
(30, 'Sevgiliye Hediye Sepeti', 15),
(31, 'Erkek Sevgiliye Hediye', 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `siparis_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `il_id` varchar(35) NOT NULL,
  `teslimat_adresi` varchar(350) NOT NULL,
  `siparis_not` varchar(350) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `siparis_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`siparis_id`, `user_id`, `ad_soyad`, `telefon`, `il_id`, `teslimat_adresi`, `siparis_not`, `urun_id`, `siparis_tarih`) VALUES
(39, 1, 'Mustafa AKBEL', '53940256631', 'İstanbul', 'adres', 'not', 2, '2018-05-01'),
(42, 26, 'mustafa AKBEL', '53940256631', 'İstanbul', 'asd', 'asd', 3, '2018-05-15'),
(43, 26, 'mustafa AKBEL', '53940256631', 'İstanbul', 'asd', 'asd', 2, '2018-05-15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_fiyat` double NOT NULL,
  `urun_ortalamasi` float NOT NULL,
  `urun_foto1` varchar(200) NOT NULL,
  `urun_foto2` varchar(200) NOT NULL,
  `urun_foto3` varchar(200) NOT NULL,
  `urun_foto4` varchar(200) NOT NULL,
  `urun_ozellikleri` varchar(1000) NOT NULL,
  `urun_tarih` varchar(12) NOT NULL,
  `cinsiyet` varchar(6) NOT NULL,
  `kategoriid` int(11) NOT NULL,
  `yas_aralik` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `urun_fiyat`, `urun_ortalamasi`, `urun_foto1`, `urun_foto2`, `urun_foto3`, `urun_foto4`, `urun_ozellikleri`, `urun_tarih`, `cinsiyet`, `kategoriid`, `yas_aralik`, `stok`) VALUES
(1, 'İsme Özel Cüzdan', 24.9, 2, 'imza-stilli-isme-ozel-cuzdan-8762.jpg', 'imza-stilli-isme-ozel-cuzdan-8763.jpg', 'imza-stilli-isme-ozel-cuzdan-8764.jpg', 'imza-stilli-isme-ozel-cuzdan-9073.jpg', '1.5cm kalınlığında masif ahşap üzerine yakarak işleme yapılmaktadır.\r\nÜrün duvara asma aparatı ve masa üzerinde kullanılacak ayağı ile gönderilmektedir.', '21.04.2018', 'Erkek', 14, 20, 2),
(2, 'Yeni Araç Hediyesi Plaka Anahtarlık', 29.4, 1, 'yeni-arac-hediyesi-plaka-anahtarlik-10465.jpg', 'yeni-arac-hediyesi-plaka-anahtarlik.jpg', 'yeni-arac-hediyesi-plaka-anahtarlik-10464.jpg', 'yeni-arac-hediyesi-deri-ruhsat-plaka-anahtarlik-seti-4403.jpg', '65 mm x 25 mm\r\n6 mm kalınlık\r\nPlaka ve isim yazı alanı\r\nÇelik anahtalık halkası\r\nÇıkmayan Baskı', '22.04.2018', 'Kadın', 10, 25, 4),
(7, 'Müzik Kutusu', 24.78, 0, 'mutlu-cift-sevgililer-muzik-kutusu.jpg', 'mutlu-cift-sevgililer-muzik-kutusu-11748.jpg', 'mutlu-cift-sevgililer-muzik-kutusu-11749.jpg', 'mutlu-cift-sevgililer-muzik-kutusu-11748.jpg', 'özellik 1\r\nözellik 3\r\nözellik 4', '17.05.2018 ', 'Kadın', 10, 18, 4),
(8, 'Gramofon Müzik Kutusu', 64.9, 4, 'gramofon-muzik-kutusu.jpg', 'gramofon-muzik-kutusu-9493.jpg', 'gramofon-muzik-kutusu-9495.jpg', 'gramofon-muzik-kutusu-9498.jpg', 'özellik 1\r\nözellik 2\r\nözellik 3\r\nözellik 4\r\n', '17.05.2018 ', 'Kadın', 10, 34, 7),
(9, 'Doğum Günü Hediyesi Müzikli Kar Küresi', 59.9, 0, 'dogum-gunu-hediyesi-muzikli-kar-kuresi.jpg', 'dogum-gunu-hediyesi-muzikli-kar-kuresi-11822.jpg', 'dogum-gunu-hediyesi-muzikli-kar-kuresi-11823.jpg', 'dogum-gunu-hediyesi-muzikli-kar-kuresi-11822.jpg', ' Ürün Boyutu 10x10x15 cm ebatlarındadır.\r\n Altında bulunan kurma kolu ile müzik başlamaktadır.\r\n Özenle hediye paketi yapılarak korunaklı bir şekilde gönderilmektedir.', '17.05.2018 ', 'Kadın', 20, 23, 3),
(10, 'Taksim Galata Figürlü Kar Küresi', 39.9, 0, 'taksim-galata-figurlu-kar-kuresi.jpg', 'taksim-galata-figurlu-kar-kuresi-6676.jpg', 'taksim-galata-figurlu-kar-kuresi-6677.jpg', 'taksim-galata-figurlu-kar-kuresi-6678.jpg', 'Taksim Galata Figürlü Kar Küresi 8,5 x 5,5 cm ölçülerindedir.\r\nMalzeme polimerdir ve alt kaideler porselendir.\r\nTaksim Galata Figürlü Kar Küresi özenle hediye paketi yapılarak gönderilmektedir.', '17.05.2018 ', 'Erkek', 20, 13, 8),
(11, 'Sivaslılara Hediye Özel Baskılı Tişört', 39.9, 0, 'sivaslilara-hediye-ozel-baskili-tisort.jpg', 'sivaslilara-hediye-ozel-baskili-tisort-10990.jpg', 'sivaslilara-hediye-ozel-baskili-tisort-10991.jpg', 'sivaslilara-hediye-ozel-baskili-tisort-10992.jpg', 'Su bazlı pigment boya ile insan sağlığına zarar vermeyen baskı.\r\nKumaşla bütünleşen canlı ve çıkmayan baskı.\r\nHava geçiren terletmez baskı.\r\n%100 sağlıklı pamuk tişört.', '17.05.2018 ', 'Erkek', 25, 22, 6),
(12, 'Anne Adayına İlk Anneler Günü Hediyesi Hamile Tişörtü', 39.9, 0, 'anne-adayina-ilk-anneler-gunu-hediyesi-hamile-tisortu.jpg', 'anne-adayina-ilk-anneler-gunu-hediyesi-hamile-tisortu-7097.jpg', 'anne-adayina-ilk-anneler-gunu-hediyesi-hamile-tisortu-7098.jpg', 'anne-adayina-ilk-anneler-gunu-hediyesi-hamile-tisortu-7099.jpg', 'Hamile Tişörtleri göbek bölgesi esnemesi için lastiklidir.\r\nAyak İzi figürünün ortasındaki kalbe dilerseniz bebeğinizin adını yada soy adını yazabilirsiniz.\r\nSu bazlı pigment boya ile insan sağlığına zarar vermeyen baskı.\r\nKumaşla bütünleşen canlı ve çıkmayan baskı.\r\nHava geçiren terletmez baskı.\r\n%100 sağlıklı pamuk tişört.\r\nİlk Anneler Gününe Özel İsim Yazılı Hediye Hamile Tişörtü özenle hediye paketi yapılarak gönderilmektedir.', '17.05.2018 ', 'Kadın', 28, 26, 7),
(13, 'Giresun Şehrine Özel Tasarımlı Baskılı Tişört', 39.9, 0, 'giresun-sehrine-ozel-tasarimli-baskili-tisort.jpg', 'giresun-sehrine-ozel-tasarimli-baskili-tisort-10994.jpg', 'giresun-sehrine-ozel-tasarimli-baskili-tisort-10995.jpg', 'giresun-sehrine-ozel-tasarimli-baskili-tisort-10996.jpg', 'Su bazlı pigment boya ile insan sağlığına zarar vermeyen baskı.\r\nKumaşla bütünleşen canlı ve çıkmayan baskı.\r\nHava geçiren terletmez baskı.\r\n%100 sağlıklı pamuk tişört.', '17.05.2018 ', 'Erkek', 27, 23, 6),
(14, 'Atatürk Silüeti Baskılı İmzalı Tişört', 39.9, 0, 'ataturk-silueti-baskili-imzali-tisort-3795.jpg', 'ataturk-silueti-baskili-imzali-tisort.jpg', 'ataturk-silueti-baskili-imzali-tisort.jpg', 'ataturk-silueti-baskili-imzali-tisort-3795.jpg', 'Su bazlı pigment boya ile insan sağlığına zarar vermeyen baskı.\r\nKumaşla bütünleşen canlı ve çıkmayan baskı.\r\nHava geçiren terletmez baskı.\r\n%100 sağlıklı pamuk tişört.\r\nRenk: Siyah ve Beyaz renk alternatifleri mevcuttur.\r\n1 adet baskılı tişört özenle kutulanıp hediye paketi yapılarak gönderilmektedir', '17.05.2018 ', 'Erkek', 25, 19, 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(11) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `foto` varchar(2555) NOT NULL DEFAULT 'default.png',
  `yetki` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `ad`, `mail`, `sifre`, `tarih`, `telefon`, `foto`, `yetki`) VALUES
(26, 'Mustafa Akbel', 'mustafaakbel@outlook.com', 'c4ca4238a0b923820dcc509a6f75849b', '04.05.2018 ', '', 'default.png', 0),
(28, 'Mustafa', 'adminmustafa@outlook.com', 'c4ca4238a0b923820dcc509a6f75849b', '15.05.2018 ', '', 'default.png', 1),
(29, 'Yeni', 'yeni@outlook.com', '7815696ecbf1c96e6894b779456d330e', '17.05.2018 ', '', 'default.png', 0),
(30, 'a', 'a@outlook.com', 'c4ca4238a0b923820dcc509a6f75849b', '17.05.2018 ', '', 'default.png', 0),
(31, '1', '1@a', 'c4ca4238a0b923820dcc509a6f75849b', '17.05.2018 ', '', 'default.png', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `begenme`
--
ALTER TABLE `begenme`
  ADD PRIMARY KEY (`begenme_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`yorumid`);

--
-- Tablo için indeksler `comments_answer`
--
ALTER TABLE `comments_answer`
  ADD PRIMARY KEY (`cevapid`);

--
-- Tablo için indeksler `iller`
--
ALTER TABLE `iller`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`siparis_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `begenme`
--
ALTER TABLE `begenme`
  MODIFY `begenme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `yorumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- Tablo için AUTO_INCREMENT değeri `comments_answer`
--
ALTER TABLE `comments_answer`
  MODIFY `cevapid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `iller`
--
ALTER TABLE `iller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
