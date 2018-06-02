<?php 
	include("login.php");
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
	<?php if(@$_SESSION["admin"]){ ?>
	<div class="admin_header">

		<div class="admin_header_content">
			<a href="admin.php"><div class="sepet_logo"></div></a>
		</div>
		<div class="admin_header_alt">
			<div class="admin_header_alt_ic">
				<ul>
					<li><a href="admin.php?uyeler">Üyeler</a></li>

					<li><a href="#">Ürünler</a>
						<ul>
							<li><a href="?urunleri_listele">Ürünleri listele</a></li>
							<li><a href="?urun_ekle">Ürün Ekle</a></li>
						</ul>
					</li>
					<li><a href="?siparisler">Siparişler</a></li>
					<li><a href="?yorumlar">Yorumlar</a></li>
					<?php 
						$admin_mail = $_SESSION["admin_mail"];
						$sql_admin = mysqli_query($baglanti,"SELECT * FROM users WHERE mail='$admin_mail'");
						$admin_isim = mysqli_fetch_array($sql_admin);
					?>
					<li class="hesap"><a href="?yorumlar"><?php echo $admin_isim["ad"] ?></a>
						<ul>
							<li><a href="?do=admin_cikis">Çıkış</a></li>
						</ul>
					</li>
					
				</ul>

		</div>
		</div>
		


	</div>
	<div class="admin_content">



		<?php
			$mail = $_SESSION["admin_mail"];
			$sql_uyeler=mysqli_query($baglanti,"SELECT * FROM users WHERE mail!='$mail'");
			if (isset($_GET["uyeler"])) {
				if (mysqli_num_rows($sql_uyeler)>0) { 
				echo "<table cellpadding='5' cellspacing='0'>";
				echo "<tr><td>İsim</td><td>Mail</td><td>Kayıt Tarihi</td><td>Admin</td><td>Sil</td></tr>";
				while ($row = mysqli_fetch_array($sql_uyeler)) { ?>
					<tr>
					<td><?php echo $row["ad"] ?></td>
					<td><?php echo $row["mail"] ?></td>
					<td><?php echo $row["tarih"] ?></td>
					<td><?php if ($row["yetki"]==0) {  ?><a href="admin.php?uyeler&admin=<?php echo $row["id"]?>"><img src="images/content/if_administrator_star_67248.png" width="32" height="32"></a> <?php } else { ?> <a href="admin.php?uyeler&admin_cikart=<?php echo $row["id"]?>"><img src="images/content/if_administrator_delete_67245.png" width="32" height="32"></a><?php } ?></td>
					<td><a href="admin.php?uyeler&id=<?php echo $row["id"]?>"><img src="images/content/user-delete-icon.png" width="32" height="32"></a></td>
				</tr>
				<?php	
				}
				echo "</table>";
				}
				if (isset($_GET["admin"])) {
					$admin_id = $_GET["admin"];
					$admin_guncelle = mysqli_query($baglanti,"UPDATE users SET yetki=1 WHERE id='$admin_id'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}
				else if (isset($_GET["admin_cikart"])) {
					$admin_id = $_GET["admin_cikart"];
					$admin_guncelle = mysqli_query($baglanti,"UPDATE users SET yetki=0 WHERE id='$admin_id'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}
				if (isset($_GET["id"])) {
					$id = $_GET["id"];
					$sil_sql = mysqli_query($baglanti,"DELETE FROM users WHERE id ='$id'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}

			}
			
			else if(isset($_GET["urunleri_listele"])){
				$urun_sql = mysqli_query($baglanti,"SELECT * FROM urunler");
				echo "<table cellpadding='5' cellspacing='0'>";
				echo "<tr><td>Ürün Adı</td><td>Ürün Fiyatı</td><td>Ürün Puan Ortalaması</td><td>Ürün Ekleme Tarihi</td><td>Stok</td><td>Sil</td></tr>";
				while($yaz=mysqli_fetch_array($urun_sql)){ ?>
				<tr>
					<td><?php echo $yaz["urun_adi"] ?></td>
					<td><?php echo $yaz["urun_fiyat"] ?> TL</td>
					<td><?php echo $yaz["urun_ortalamasi"] ?></td>
					<td><?php echo $yaz["urun_tarih"] ?></td>
					<td><?php echo $yaz["stok"] ?></td>
					<td><a href="admin.php?urunleri_listele&urun_id=<?php echo $yaz["urun_id"] ?>"><img src="images/content/if_basket_1814090.png"></a></td>
				</tr>
				<?php

				}
				echo "</table>";
				if (isset($_GET["urun_id"])) {
					$urun_id = $_GET["urun_id"];
					$urun_sil_sql = mysqli_query($baglanti,"DELETE FROM urunler WHERE urun_id='$urun_id'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}

			}
			else if(isset($_GET["urun_ekle"])){ ?>
				<form method="post" action="">
					<input type="text" name="urun_adi" placeholder="Ürün adını yazınız..">	
					<input type="text" name="urun_fiyat" placeholder="Ürün fiyatını yazınız..">
					<?php 
					for ($i=0; $i < 4; $i++) {  ?>

					<label><?php echo ($i+1) ?>. fotoğrafı seçiniz :</label>  <input type="file" name="urun_foto<?php echo ($i+1) ?>" accept="image/*">
					<div class="clear"></div>
					<?php
					}
					?>
					<label>Cinsiyet : </label>
					<select name="cinsiyet">
						<option value="Erkek">Erkek</option>
						<option value="Kadın">Kadın</option>
					</select>
					<label>Kategoriyi seçiniz : </label>
					<select name="kategori">
						<?php 
							$kategoriler = mysqli_query($baglanti,"SELECT * FROM kategoriler WHERE ust_kategori_id!=0");
							while($yazdir = mysqli_fetch_array($kategoriler)) { ?>
								<option value="<?php echo $yazdir["kategori_id"]?>"><?php echo $yazdir["kategori_adi"]?></option>
							<?php

							}
						 ?>
					</select>
					<textarea name="urun_ozellikleri" placeholder="Ürün özelliklerini yazınız.."></textarea>
					<div class="clear"></div>
					<label>Ürün için ortalama yaşı yazınız :</label><input type="number" name="yas_ortalama" min="0" max="60">
					<div class="clear"></div>
					<label>Stok sayısını giriniz :</label><input type="number" name="stok" min="0" max="60">
					<input type="submit" name="gonder" value="Ekle">
				</form>
			<?php
				
				if (@$_POST["gonder"]) {
					$urun_adi =  $_POST["urun_adi"];
					$urun_fiyat =  $_POST["urun_fiyat"];
					$foto1 = $_POST["urun_foto1"];
					$foto2 = $_POST["urun_foto2"];
					$foto3 = $_POST["urun_foto3"];
					$foto4 = $_POST["urun_foto4"];
					$cinsiyet = $_POST["cinsiyet"];
					$kategori = $_POST["kategori"];
					$urun_ozellikleri = $_POST["urun_ozellikleri"];
					$yas_ortalama = $_POST["yas_ortalama"];
					$oto_tarih = date('d.m.Y ');
					$stok = $_POST["stok"];
					$urun_ekle = mysqli_query($baglanti,"INSERT INTO urunler(urun_adi,urun_fiyat,urun_foto1,urun_foto2,urun_foto3,urun_foto4,cinsiyet,kategoriid,urun_ozellikleri,urun_tarih,yas_aralik,stok) VALUES('$urun_adi','$urun_fiyat','$foto1','$foto2','$foto3','$foto4','$cinsiyet','$kategori','$urun_ozellikleri','$oto_tarih','$yas_ortalama','$stok')");
					
				}
			}

			else if (isset($_GET["siparisler"])) {
				$sql_siparisler = mysqli_query($baglanti,"SELECT * FROM siparis JOIN urunler ON siparis.urun_id = urunler.urun_id");
				echo "<table cellpadding='5' cellspacing='0'>";
				echo "<tr><td>Ad Soyad</td><td>Telefon</td><td>İl</td><td>Teslimat Adresi</td><td>Sipariş Notu</td><td>Ürün Adı</td><td>Tamamlandı</td></tr>";
				while($siparis=mysqli_fetch_array($sql_siparisler)){ ?>
				<tr>
					<td><?php echo $siparis["ad_soyad"] ?></td>
					<td><?php echo $siparis["telefon"] ?> </td>
					<td><?php echo $siparis["il_id"] ?></td>
					<td><?php echo $siparis["teslimat_adresi"] ?></td>
					<td><?php echo $siparis["siparis_not"] ?></td>
					<td><?php echo $siparis["urun_adi"] ?></td>
					<td><a href="admin.php?siparisler&siparis_id=<?php echo $siparis["siparis_id"] ?>"><img src="images/content/okay.png" style="padding-left: 25px"></a></td>
				</tr>
				<?php

				}
				echo "</table>";

				if (isset($_GET["siparis_id"])) {
					$siparis_id = $_GET["siparis_id"];
					$sil_siparis = mysqli_query($baglanti,"DELETE FROM siparis WHERE siparis_id='$siparis_id'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}
			}

			else if (isset($_GET["yorumlar"])) {
				$sql_yorumlar = mysqli_query($baglanti,"SELECT * FROM comments JOIN urunler ON comments.urunid=urunler.urun_id JOIN users ON comments.usersid=users.id");
				echo "<table cellpadding='5' cellspacing='0'>";
				echo "<tr><td>Kişi</td><td>Ürün</td><td>Yorum Başlığı</td><td>Yoruma Puanı</td><td>Yorumun İçeriği</td><td>Yorumun Tarihi</td><td>Tamamlandı</td></tr>";
				while($yorum=mysqli_fetch_array($sql_yorumlar)){ ?>
				<tr>
					<td><?php echo $yorum["ad"] ?></td>
					<td><?php echo $yorum["urun_adi"] ?></td>
					<td><?php echo $yorum["yorumbaslik"] ?></td>
					<td><?php echo $yorum["yorumpuan"] ?> </td>
					<td><?php echo $yorum["yorumicerik"] ?></td>
					<td><?php echo $yorum["yorumtarih"] ?></td>
					<td><a href="admin.php?yorumlar&yorum_id=<?php echo $yorum["yorumid"] ?>"><img src="images/content/sil.png" style="padding-left: 25px"></a></td>
				</tr>
				<?php

				}
				echo "</table>";
				if (isset($_GET["yorum_id"])) {
					$yorumid = $_GET["yorum_id"];
					$sil_yorum = mysqli_query($baglanti,"DELETE FROM comments WHERE yorumid='$yorumid'");
					header("location: ".$_SERVER['HTTP_REFERER']."");
				}

			}
			else {  

				?>

			<h1>HOŞGELDİNİZ <?php echo $admin_isim["ad"]  ?></h1>
			<?php
			}
		?>
	</div>


	<?php } 
 	else {  
 		echo "<script>alert('Bu sayfaya erişmeye yetkiniz yok.');</script>";
 		echo "<script>window.location = 'index.php'</script>";

 	?> 
<?php } ?>
	
</body>
</html>
