<?php
ob_start();
session_start();
include("sepet_actions.php");
include("vt.php");
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
	<div class="sepet_header"><div class="sepet_header_ic"><a href="index.php"><div class="sepet_logo"></div></a></div></div>
	<div class="sepet_content">



		<?php 

		if (isset($_COOKIE['urun'])) { ?>

		<div class="sepet_siparis_ozet">
			<div class="sepet_siparis_ozet_baslik">Sipariş Özeti</div>
			<div class="sepet_siparis_ozet_detay">
				<h4>Sepetiniz</h4>
				<ul>

					<?php if (isset($_COOKIE['urun'])) {
						foreach ($_COOKIE['urun'] as $urun => $value) {  
							$urun_cekme_sql = mysqli_query($baglanti,"SELECT * FROM urunler WHERE urun_id='$urun'");
							$goster = mysqli_fetch_array($urun_cekme_sql);
							@$toplam_tutar+= $goster["urun_fiyat"];
							?>
							<li><b><?php echo $goster["urun_adi"] ?></b><span>1 Adet</span><span><?php echo $goster["urun_fiyat"] ?><small>TL</small></span></li>

							<?php 

						} }  ?>

						<li>Genel Toplam : <?php echo @$toplam_tutar; ?> TL</li>

					</ul>
				</div>
			</div>
			<?php
			foreach ($_COOKIE['urun'] as $urun => $value) {  

				$urun_cekme_sql = mysqli_query($baglanti,"SELECT * FROM urunler WHERE urun_id='$urun'");
				$yazdir = mysqli_fetch_array($urun_cekme_sql);
				?>

				<div class="sepet_urun">
					<div class="sepet_urun_fotograf"><img src="images/urun_img/<?php echo $yazdir["urun_foto1"]; ?>"></div>
					<div class="sepet_urun_detayları">
						<div class="sepet_urun_isim"><a href="#"><?php echo $yazdir["urun_adi"] ?></a></div>
						<div class="sepet_urun_cikart"><a href="sepet.php?urunu_cikart=<?php echo $urun ?>">X</a></div>
						<div class="clear"></div>
							
						<div class="tutar"><?php echo $yazdir["urun_fiyat"]; ?> TL</div>
					</div>
				
				</div>
			
				<?php
			}

			?>
			<div class="clear"></div>
			<a href="index.php"><div class="alisverise_devam">« Alışverişe Devam</div></a>
				<div class="genel_toplam">Genel Toplam :<?php echo @$toplam_tutar; ?> TL </div>
				<a href="odeme.php?satin_al"><div class="satin_al">Satın Al</div></a>
			<?php

		}
		else { ?>
		<div style="text-align: center; padding-top: 50px; height: 250px; display: block;">
			<h3 class="stil1">Sepetinizde ürün bulunmamaktadır.</h3>
			<p class="spot">Birşeyler satın almak için ürün kategorilerimize göz atmalısınız</p>
			<div class="alisveris"><a href="index.php">Alışverişe Devam</a></div>
		</div>
		<?php
	}
	?>


</div>
<!-- 
	
-->

<div class="clear"></div>

<div class="sepet_footer"><div class="copyright"><span>Copyright© <a href="#">hediyesepeti.com</a></span></div></div>
</body>
</html>