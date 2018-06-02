
<?php

session_start();
include("vt.php");	

if (@$_POST['giris_yap_buton']) {
	$mail = $_POST["giris_mail"];
	$sifre = $_POST["giris_sifre"];
	$sifre = md5($sifre);
	$sql = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$mail' && sifre='$sifre'");
	$admin_sql = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$mail' && sifre='$sifre' && yetki=1");
	$admin_say = mysqli_num_rows($admin_sql);
	if ($admin_say>0) {
		$_SESSION["admin"] = true;
		$_SESSION["admin_mail"] = $mail;
		header("location: admin.php");
	}
	else {
		$say= mysqli_num_rows($sql);
		if ($say>0) {
			$_SESSION["oturum"] = true;
			$_SESSION["mail"] = $mail;
			if (@$_POST["beni_hatirla"]) {
				setcookie('email',$mail,time()+60*60*24*7);
				setcookie('sifre',$_POST["giris_sifre"],time()+60*60*24*7);
			}
			else {
				if (isset($_COOKIE["email"])) {
					setcookie("email","");
				}
				if (isset($_COOKIE["sifre"])) {
					setcookie("sifre","");
				}	
			}
		}
		else{
			echo "<script type='text/javascript'>alert('E-posta veya şifre yanlış!');</script>";
		}
	}
	
}

if (@$_POST['uye_ol_buton']) {
	$kayit_isim = $_POST["uye_isim"];
	$kayit_mail = $_POST["kayit_mail"];
	$kayit_sifre = $_POST["kayit_sifre"];
	$kayit_sifre = md5($kayit_sifre);
	$kayit_tarih = date('d.m.Y ');
	$sql = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$kayit_mail'");
	$say = mysqli_num_rows($sql);
	if($say>0){
		echo "<script type='text/javascript'>alert('bu maile ait kullanıcı var.!');</script>";
		header("Refresh:1; url=".$_SERVER["HTTP_REFERER"]);
	}
	elseif ($say==0){
			$ekleme_sql = mysqli_query($baglanti, "INSERT INTO users(ad,mail,sifre,tarih) VALUES('$kayit_isim','$kayit_mail','$kayit_sifre','$kayit_tarih')");
			$_SESSION["oturum"] = true;
			$_SESSION["mail"] = $kayit_mail;
	}
}

if(@$_GET["do"]){
	if ($_GET["do"] == "admin_cikis") {
		UNSET($_SESSION['admin']);
		header("location: index.php");	
	}
	else if ($_GET["do"] == "cikis") {

		foreach ($_COOKIE["urun"] as $urun => $value) {
			setcookie('urun['.$urun.']',$urun,time()-86400);
			$stok_sql = mysqli_query($baglanti,"UPDATE urunler SET stok=stok+1 WHERE urun_id='$urun'");
		}
		UNSET($_SESSION['oturum']);
				
		header("location: ".$_SERVER['HTTP_REFERER']."");
		
	}
}
?>
