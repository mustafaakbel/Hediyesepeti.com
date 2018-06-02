<html>
<head>
</head>
<body>
<?php 
	ob_start();
	include("header.php"); 
	include("filtreleme.php"); 
	$kid = $_GET["kid"];
	if ($kid=="4") {
		$sorgu = "SELECT * FROM urunler WHERE urun_id>0 ";
	}
	else {
		$sorgu = "SELECT * FROM urunler JOIN kategoriler ON urunler.kategoriid = kategoriler.kategori_id  WHERE kategoriid='$kid' ";
	}
	
	if (isset($_POST["filtrele"])) { 
	    
	    if (isset($_POST["cinsiyet"])) {
	    	$cinsiyet = $_POST["cinsiyet"];
	        $sorgu.= "&& cinsiyet='$cinsiyet '";
	    }
	     if (isset($_POST["yas_araligi"])) {
	    	$yas_araligi = $_POST["yas_araligi"];
	    	if ($yas_araligi=="Çocuk") {
	    		$sorgu.= "&& yas_aralik>0 AND yas_aralik<18 ";
	    	}
	    	else if ($yas_araligi=="Genç") {
	    		$sorgu.= "&& yas_aralik>0 AND yas_aralik<35 ";
	    	}
	    	else if ($yas_araligi=="Yetişkin") {
	    		$sorgu.= "&& yas_aralik>18 AND yas_aralik<55 ";
	    	}
	        
	    }
	    if (isset($_POST["fiyat"])) {
	    	$fiyat = $_POST["fiyat"];
	    	if ($fiyat=="50 TL'ye kadar") {
	    		$sorgu.= "&& urun_fiyat>0 AND urun_fiyat<=50 ";
	    	}
	    	else if ($fiyat=="50-100 TL arası") {
	    		$sorgu.= "&& urun_fiyat>50 AND urun_fiyat<=100 ";
	    	}
	    	else if ($fiyat=="100-200 TL arası") {
	    		$sorgu.= "&& urun_fiyat>100 AND urun_fiyat<=200 ";
	    	}
	    	else if($fiyat=="Bütün Fiyatlar") {
	    		$sorgu.= "&& urun_fiyat>0 ";
	    	}
	        
	    }

	    if (isset($_POST["siralama"])) {
	    	$siralama = $_POST["siralama"];
	    	if ($siralama=="Ucuzdan Pahalıya") {
	    		$sorgu.= "ORDER BY urun_fiyat ";
	    	}
	    	else if ($siralama=="Pahalıdan Ucuza") {
	    		$sorgu.= "ORDER BY urun_fiyat DESC ";
	    	}
	    	else if ($siralama=="Yeniden Eskiye") {
	    		$sorgu.= "	ORDER BY urun_tarih DESC ";
	    	}
	        
	    }


	}
	$kategori_urunler = mysqli_query($baglanti,$sorgu);

	$kategori_ismi = mysqli_query($baglanti,"SELECT * FROM kategoriler WHERE kategori_id='$kid'");
	$goster = mysqli_fetch_array($kategori_ismi);
	?>

	<div class="kategori_content">
		<div class="filtreleme">
			<h1><?php echo $goster["kategori_adi"]; ?><span>(<?php echo mysqli_num_rows($kategori_urunler); ?> ürün)</span></h1>
			<div class="filtrelemeler">
			<form action="" method="post">
				<select name="cinsiyet" placeholder="Cinsiyet">
					<option disabled selected hidden>Cinsiyet</option>
						<option value="Erkek">Erkek</option>
						<option value="Kadın">Kadın</option>
				</select>
				<select name="yas_araligi">
					<option disabled selected hidden>Yaş Aralığı</option>
					<option value="Çocuk">Çocuk</option>
					<option value="Genç">Genç</option>
					<option value="Yetişkin">Yetişkin</option>
				</select>
				<select name="fiyat">
					<option disabled selected hidden>Fiyat</option>
					<option value="Bütün Fiyatlar">Bütün Fiyatlar</option>
					<option value="50 TL'ye kadar">50 TL'ye kadar</option>
					<option value="50-100 TL arası">50-100 TL arası</option>
					<option value="100-200 TL arası">100-200 TL arası</option>
				</select>
				<select name="siralama">
					<option disabled selected hidden>Sırala</option>
					<option value="Ucuzdan Pahalıya">Ucuzdan Pahalıya</option>
					<option value="Pahalıdan Ucuza">Pahalıdan Ucuza</option>
					<option value="Yeniden Eskiye">Yeniden Eskiye</option>
				</select>
				<input type="submit" value="Filtrele" name="filtrele">
			</form>
		</div>


		<div class="secimler"><?php if (!empty($cinsiyet)) { echo "<span> Cinsiyet  : </span> ".$cinsiyet; } ?></div>

		<div class="secimler"> <?php if (!empty($yas_araligi)) { echo "<span>Yaş Aralığı : </span> ".$yas_araligi; }  ?> </div>

		<div class="secimler"> <?php if (!empty($fiyat)) { echo "<span>Fiyat : </span>".$fiyat; }  ?> </div>

		<div class="secimler"> <?php if (!empty($siralama)) { echo "<span>Sıralama : </span>".$siralama; }  ?> </div>

		<div class="clear"></div>

		</div>
		<?php 
			 ?>
		<div class="filtrelenen_urunler">
							<div class="urun_sablon">
					<ul>
						<?php

						while($row = mysqli_fetch_array($kategori_urunler)){ ?>
						<li>
							<figure>
								<a href='urun.php?do=<?php echo $row["urun_id"] ?>'>
									<img src="images/urun_img/<?php echo $row["urun_foto1"]; ?>" alt="Sizin İçin Seçtiklerimiz" width="304" height="228">
								</a>
								<figcaption><?php echo $row["urun_adi"]; ?></figcaption>
							</figure>
							<div class="yildiz">
								<?php 
									if ($row["urun_ortalamasi"]==5) {
										echo "<img src='images/content/point5.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==4) {
										echo "<img src='images/content/point4.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==3) {
										echo "<img src='images/content/point3.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==2) {
										# code...
									}
									else if ($row["urun_ortalamasi"]==1) {
										# code...
									}
									else {

									}
								?>
								(<?php $id = $row["urun_id"]; $yorum_sayisi = mysqli_query($baglanti,"SELECT * FROM urunler INNER JOIN comments ON urunler.urun_id = comments.urunid WHERE urun_id='$id'");
										echo  mysqli_num_rows($yorum_sayisi);  ?>)
							</div>
							<div class="ucret">
								<?php 
									$dizi = explode (".",$row["urun_fiyat"]);
									echo $dizi[0]."<sub> ,".$dizi[1]."TL </sub>";
								 ?>
							</div>
						</li>

						<?php
					}
					?>
			</ul>
		</div>
		</div>

	</div>




<?php

	
	include("footer.php");
?>
</body>
</html>