<?php
$baglanti = mysqli_connect('localhost', 'root', '')or die("Bağlantı Kurulamadı");
mysqli_select_db($baglanti, 'hediyesepeti')or die('Veritabanı Bulunamadı');
mysqli_query($baglanti,"SET NAMES UTF8");
?>