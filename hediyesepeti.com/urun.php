<html>
<head>
</head>
<body>
	<?php 
	ob_start();
	include("header.php"); 
	include("yorum.php");
	include("begenme.php");
	include("sepet_actions.php");
	$id = $_GET["do"];
	$fotograf = @$_GET["fotograf"];
	$urun_sql = mysqli_query($baglanti,"SELECT * FROM urunler WHERE urun_id='$id'");
	$kategori_sql = mysqli_query($baglanti,"SELECT * FROM urunler INNER JOIN kategoriler ON urunler.kategoriid = kategoriler.kategori_id WHERE urun_id='$id' ");
	$row = mysqli_fetch_array($kategori_sql);
	$goster = mysqli_fetch_array($urun_sql);
	?>
	<div id="urun_container">
		<div id="icerik_haritasi">
			<a href="#">Hediye Sepeti</a> <span>></span> <a href="#"> <?php echo $row["kategori_adi"] ?></a> <span>></span> <?php echo $goster["urun_adi"] ?>
		</div>

		<div  id="urun_detayi">
			<div id="img">
				<div id="img_container">
					<a href="#">
						<img src="images/urun_img/<?php  
						if(isset($fotograf)){
							echo $fotograf; 
						}
						else {
							echo $goster["urun_foto1"];
						} ?>">
					</a>
				</div>
				<div id="img_kucuk">
					<a href='urun.php?do=<?php echo $goster["urun_id"] ?>&fotograf=<?php echo $goster["urun_foto1"] ?>'>
						<img src="images/urun_img/<?php echo $goster["urun_foto1"]; ?>">
					</a>
					<a href='urun.php?do=<?php echo $goster["urun_id"] ?>&fotograf=<?php echo $goster["urun_foto2"] ?>'>
						<img src="images/urun_img/<?php echo $goster["urun_foto2"]; ?>">
					</a>
					<a href='urun.php?do=<?php echo $goster["urun_id"] ?>&fotograf=<?php echo $goster["urun_foto3"] ?>'>
						<img src="images/urun_img/<?php echo $goster["urun_foto3"]; ?>">
					</a>
					<a href='urun.php?do=<?php echo $goster["urun_id"] ?>&fotograf=<?php echo $goster["urun_foto4"] ?>'>
						<img src="images/urun_img/<?php echo $goster["urun_foto4"]; ?>">
					</a>
				</div>
				<!--ust kategori altına span ile yapılabilir -->
<!-- 				<div id="ust_kategori">
					<span>
						<img src="images/urun/arrow.png">
						<a href="#">Erkek Deri Cüzdan Modelleri</a>
					</span>
				</div> -->
			</div>

			<div id="urun_info">
				<div id="urun_ismi">
					<h1><?php echo $goster["urun_adi"] ?></h1>

				</div>
				<div id="rate">
					<?php 
					for ($i=0; $i <$goster["urun_ortalamasi"]; $i++) { ?>
					<div class="star"></div>
					<?php } ?>
					<div id="yorum_sayisi">( <?php $yorum_kayitlari = mysqli_query($baglanti,"SELECT * FROM comments WHERE urunid='$id'"); echo mysqli_num_rows($yorum_kayitlari) ?> )</div>
					<div class="clear"></div>
				</div>
				<div id="urun_kodu">Ürün Kodu : S-<?php echo $goster["urun_id"] ?></div>
				<div class="urun_ucret"><?php echo $goster["urun_fiyat"] ?> TL</div>
			</div>
			
			<div id="sepet_ekle">
			<?php 
			if(isset($_COOKIE["urun"])) {
				foreach (@$_COOKIE['urun'] as $urun => $value) {
					if (@$_COOKIE["urun"][$urun]==$id) {
							@$kontrol = true;
						}
					}
				}
				$stok_kontrol = mysqli_query($baglanti,"SELECT * FROM urunler WHERE urun_id='$id'");
				$yaz = mysqli_fetch_array($stok_kontrol);
				?>

				<?php 
						if(@$kontrol==true){  ?>
						<a href="<?php if ($yaz["stok"]<1) { echo "#";  } else { echo "sepet.php";  }  ?>"><div id="sepete_ekle_buton">
							<img src="images/urun/cart.png"> 
							 <?php if ($yaz["stok"]<1) { echo "Stokta ürün yok";  } else { echo "Bu ürün zaten sepetinizde var (Sepetim)";  } ?>
						</div></a>

						<?php
						}
						else { 
						?>
							<a href="<?php if ($yaz["stok"]<1) { echo "#";  } else { echo "sepet.php?urun=".$goster["urun_id"]; } ?> "><div id="sepete_ekle_buton">
								<img src="images/urun/cart.png"> 
								 <?php if ($yaz["stok"]<1) { echo "Stokta ürün yok";  } else { echo "Sepete Ekle";  } ?>
								
							</div></a>
						<?php 
						}
				?>
				
				<div id="sepet_info">
					<img src="images/urun/cargo.png">
					<b>Şimdi</b> sipariş verirseniz <b style="color:#fe6500">yarın</b> kargoya verilecektir.
				</div>
				<div id="teslimat_secenekleri">Teslimat ve Ödeme Seçenekleri 
				</div>
				<div id="teslimat_secenekleri_liste">
					<ul>
						<li>Banka Kartı ile Güvenli Ödeme</li>
						<li>Tüm Kartlara 6 Taksit İmkanı</li>
						<li>Güvenli Alışveriş</li>
						<li>Kapıda Ödeme Kolaylığı</li>
						<li>100TL üzeri Kargo Bedava</li>
					</ul>
				</div>
			</div>
			<div id="urun_ozellikleri">
				<strong>Satın Almadan Önce Bilmeniz Gerekenler :</strong>

				<ul>
					<?php $urun_ozellikleri = explode ("\n",$goster["urun_ozellikleri"]); 
					for ($i=0; $i <count($urun_ozellikleri) ; $i++) { ?>
					<li><?php echo $urun_ozellikleri[$i] ?></li>
					<?php
				}
				?>


			</ul>

		</div>
	</div>
	<div class="clear"></div>
	<div id="yorumlar">

		<h3>Yorumlar (<?php  
			$yorum_kayitlari = mysqli_query($baglanti,"SELECT * FROM comments WHERE urunid='$id'");
			$yorum_sayisi = mysqli_num_rows($yorum_kayitlari);
			echo $yorum_sayisi;
			?>)</h3>


		<?php

		if(!isset($_GET["sayfa"])){
			$sayfa =1;
			$_GET["sayfa"]=1;
		}
		else{
			$sayfa=$_GET["sayfa"];
		}
		$sinir = 4;

		$toplam_kayit_sql = mysqli_query($baglanti,"SELECT * FROM comments INNER JOIN urunler ON urunler.urun_id = comments.urunid WHERE  urun_id='$id'");

		$toplam_kayit_sayisi = mysqli_num_rows($toplam_kayit_sql);

		$islem = ($sayfa-1)*$sinir;


		$yorum_sql = mysqli_query($baglanti,"SELECT * FROM users INNER JOIN comments ON users.id = comments.usersid JOIN urunler ON urunler.urun_id=comments.urunid WHERE urun_id='$id'  ORDER BY yorumid DESC LIMIT ".$islem.",".$sinir); 
		$mail = @$_SESSION["mail"]; $begenen = mysqli_query($baglanti,"SELECT id FROM users WHERE mail = '$mail'");
		$begenen_id = mysqli_fetch_array($begenen);  
		while( $sonuc=mysqli_fetch_array($yorum_sql) ){  ?>

		<div class="yorum">
			<div class="yorum_ismi"><a href="profil.php?uid=<?php echo $sonuc["id"] ?>"><?php echo $sonuc["ad"] ?></a></div> 
			<div class="urune_puani">
				<?php 
				for ($i=0; $i < $sonuc["yorumpuan"]; $i++) { ?>
				<div class="star"></div>
				<?php } ?>
			</div>
			<div class="clear"></div>

			<div class="yorum_baslik"><?php echo $sonuc["yorumbaslik"] ?></div>	
			<div class="yorum_icerik"><?php echo $sonuc["yorumicerik"] ?></div>
			<div class="yorum_tarih"><?php $date = new DateTime($sonuc["yorumtarih"]); echo $date->format('d.m.Y'); ?></div>

			<?php
			
			 
			

			$begenen_kisi=$begenen_id['id'];
			$begenilen_yorum =$sonuc['yorumid'];
			begenme($begenilen_yorum,$begenen_kisi,$baglanti);
			$begenme = yorum_say($begenilen_yorum,$begenen_kisi,$baglanti);
			?>
	
	<?php
	if (@$_SESSION["oturum"]) { ?>

	<div class="begeni"><a href='urun.php?do=<?php echo $goster["urun_id"] ?>&sayfa=<?php echo $sayfa ?>&yorum=<?php echo $sonuc["yorumid"]?>&user=<?php echo $begenen_kisi ?>&durum=<?php if ($begenme>0) echo "0"; else { echo "1"; } ?>'><?php if ($begenme>0) {  ?>Beğenmekten Vazgeç  <?php } else { ?>Beğen<?php } ?></a></div><?php }  ?>
	<div class="clear"></div>
	<?php
	
	?>


	<?php  
	if (@$_SESSION["oturum"]) { ?>

	<div class="yanit_yorum">
		<form action="" method="post">
			<textarea placeholder="Yorumu yanıtla..." name="yorum_yaniti" required></textarea>
			<input type="hidden" value="<?php echo $sonuc['yorumid']; ?>" name="ustyorum"> 
			<input type ="submit" value="Yanıtla" name="yorum_yanitla">
		</form>
	</div>

	<?php
}
?>	

	<?php  
	$ustyorum = $sonuc['yorumid'];
	$yorum_yanitlari = mysqli_query($baglanti,"SELECT * FROM comments_answer INNER JOIN users ON comments_answer.userid = users.id WHERE ustyorumid='$ustyorum' ORDER BY answer_date");
	
	while ($row = mysqli_fetch_array($yorum_yanitlari)) { ?>
			<div class="cevap">
				<div class="cevap_isim"><?php echo $row["ad"]." "; ?> : </div>
				<div class="cevap_icerik"><?php echo $row["cevapicerik"]; ?> </div>
				<div class="cevap_tarih"><?php echo $row["answer_date"]; ?> </div>
				<?php 
				$cevap_yorum =$row['cevapid'];
				begenme($cevap_yorum,$begenen_kisi,$baglanti);
				$say = yorum_say($cevap_yorum,$begenen_kisi,$baglanti);

				?>

				<div class="begeni">
				<a href='urun.php?do=<?php echo $goster["urun_id"] ?>&sayfa=<?php echo $sayfa ?>&yorum=<?php echo $row["cevapid"]?>&user=<?php echo $begenen_kisi ?>&durum=<?php if ($say>0) echo "0"; else { echo "1"; } ?>'><?php if ($say>0) {  ?>Beğenmekten Vazgeç  <?php } else { ?>Beğen<?php } ?></a>
				</div>
				<div class="clear"></div>
			</div>



	<?php
	}
?>


</div>
<?php
}
?>

<?php 
if (@$_SESSION["oturum"]) { 
	?>

	<div id="yorum_yap"  >Yorum Yap</div>
	<div id="yorum_ekrani">
		<form action="" method="post">
			
			<input type="text" name="yorum_basligi" placeholder="Yorum Başlığı.." class="yorum_textbox"	 >
			<span>Ürüne Puanınız : </span><input type="number" max="5" min="1" name="yorum_puan" required> 
			<textarea name="yorum_icerik" required></textarea>
			<input type="hidden" value="<?php echo $goster['urun_id']; ?>" name="urunid"> 
			<input type="submit" value="Yorum Yap" name="yorumuyap">
		</form>
	</div>
	<?php
}
if (@$_GET["sayfa"]!=1) { ?>
<div class="sayfalama"><a href="urun.php?do=<?php echo $goster["urun_id"] ?>&sayfa=<?php echo ($_GET["sayfa"]-1) ?>"> < Önceki</a></div>
<?php
}
for ($sayfa=1; $sayfa <=ceil($toplam_kayit_sayisi /$sinir); $sayfa++) {  ?>
<div class="sayfalama"><a href="urun.php?do=<?php echo $goster["urun_id"] ?>&sayfa=<?php echo $sayfa ?>"><?php echo $sayfa ?></a></div>
<?php
} 
if (@$_GET["sayfa"]!=ceil($toplam_kayit_sayisi /$sinir)) { ?>
<div class="sayfalama"><a href="urun.php?do=<?php echo $goster["urun_id"] ?>&sayfa=<?php echo ($_GET["sayfa"]+1) ?>">Sonraki > </a></div>
<?php
}

?>



</div>
</div>

<?php include("footer.php") ?>
</body>
<script>
	var ge = document.getElementById('giris_ekrani');

	window.onclick = function(event) {
		if (event.target == ge) {
			ge.style.display = "none";
		}
	}

</script>
</html>