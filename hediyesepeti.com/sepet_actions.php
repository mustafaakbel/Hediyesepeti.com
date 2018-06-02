<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
</body>
</html>

<?php 
ob_start();
include("vt.php");
if (isset($_GET["urun"])) {
	$urun_id = $_GET["urun"];
	setcookie('urun['.$urun_id.']',$urun_id,time()+86400);
	$stok_sql = mysqli_query($baglanti,"UPDATE urunler SET stok=stok-1 WHERE urun_id='$urun_id'");
	header( 'refresh: 0; url=/hediyesepeti.com/sepet.php' ); 

	


}


if (isset($_GET['urunu_cikart'])) {
	setcookie('urun['.$_GET['urunu_cikart'].']',$_GET['urunu_cikart'],time()-86400);
	$id =$_GET['urunu_cikart'];
	$stok_sql = mysqli_query($baglanti,"UPDATE urunler SET stok=stok+1 WHERE urun_id='$id'");
	header('location:'.$_SERVER["HTTP_REFERER"]);
}
function sepet($baglanti,$mail){
	
	$id_sql = mysqli_query($baglanti,"SELECT id FROM users WHERE mail='$mail'");
	$goster = mysqli_fetch_array($id_sql);

	$user_id = $goster["id"];
	$ad_soyad = $_POST["alici_ad_soyad"];
	$telefon =  $_POST["alici_telefon"];
	$il = $_POST["il"];
	$teslimat_adresi = $_POST["teslimat_adresi"];
	$siparis_notu = $_POST["siparis_notu"];
	$otomatik_tarih = date('d.m.Y ');
	foreach ($_COOKIE['urun'] as $urun => $value) { 
		$eklenecek_urun = $_COOKIE['urun'][$urun];
		$siparis_ekleme_sql = mysqli_query($baglanti,"INSERT INTO siparis(user_id,ad_soyad,telefon,il_id,teslimat_adresi,siparis_not,urun_id,siparis_tarih) VALUES('$user_id','$ad_soyad','$telefon','$il','$teslimat_adresi','$siparis_notu','$eklenecek_urun','$otomatik_tarih')");

	}
	foreach ($_COOKIE['urun'] as $urun => $value) {
		setcookie('urun['.$urun.']',$urun,time()-86400);
		$stok_sql = mysqli_query($baglanti,"UPDATE urunler SET stok=stok+1 WHERE urun_id='$urun'");
	}
	echo "<script type='text/javascript'>alert('Siparişiniz Başarıyla Alınmıştır.'); window.location.href = 'index.php';</script>";


}

if (@$_POST['siparisi_tamamla']) {
	if (@$_SESSION["oturum"]) {
		sepet($baglanti,$_SESSION["mail"]);
	}
	else if (!empty(@$_POST["odeme_e_posta"]) && !empty(@$_POST["odeme_sifre"])){
		$odeme_e_posta = $_POST["odeme_e_posta"];
		$odeme_sifre = $_POST["odeme_sifre"];
		$sql = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$odeme_e_posta' && sifre='$odeme_sifre'");
		if (mysqli_num_rows($sql)>0) {
			$_SESSION["oturum"] = true;
			$_SESSION["mail"] = $mail;
			sepet($baglanti,$odeme_e_posta);
		}
		else{
		echo "<script type='text/javascript'>alert('E-posta veya şifre yanlış!');</script>";
	}

	}
	else {
		@$telefon = $_POST["telefon"];
		@$ad_soyad = $_POST["ad_soyad"];
		@$e_posta = $_POST["e_posta"];
		@$sifre = $_POST["sifre"];
		@$kayit_tarih = date('d.m.Y ');
		$sql = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$e_posta'");
		$say = mysqli_num_rows($sql);
		if($say>0){	
			echo "<script type='text/javascript'>alert('bu maile ait kullanıcı var.!'); </script>";
		}
		elseif ($say==0){
				$ekleme_sql = mysqli_query($baglanti, "INSERT INTO users(ad,mail,sifre,tarih,telefon) VALUES('$ad_soyad','$e_posta','$sifre','$kayit_tarih','$telefon')");
				$_SESSION["oturum"] = true;
				sepet($baglanti,$e_posta);
		}
			
		}

}


