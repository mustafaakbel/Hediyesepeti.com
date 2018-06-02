<?php 
	if (isset($_COOKIE["urun"])) { ?>
	<?php
ob_start();
session_start();
include("sepet_actions.php");
include("vt.php");
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
	<div class="sepet_header"><div class="sepet_header_ic"><a href="index.php"><div class="sepet_logo"></div></a></div></div>
	<div class="sepet_content">

		<?php 
		if (isset($_GET['satin_al'])) {
			if (@$_SESSION['oturum']) {  ?>

					<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Teslimat Adresi (Alıcı)</b></div>
						<form action="" method="post">
							<input type="text" name="alici_ad_soyad" placeholder="Alıcının Adı Soyadı" class="form_elamanlari" required>
							<input type="tel" name="alici_telefon" placeholder="Telefon" class="form_elamanlari" required>
							<select class="form_elamanlari" style="width: 100%;" name="il" required>
								<?php 
									$il_sql = mysqli_query($baglanti,"SELECT * FROM iller"); ?>
										<option>İl seçiniz</option>
									<?php

									while($iller = mysqli_fetch_array($il_sql)) { ?>
										<option value="<?php echo $iller["il"] ?>"><?php echo $iller["il"] ?></option>
									<?php 

									}
								 ?>
								
							</select>
							<textarea placeholder="teslimat_adresiniz" name="teslimat_adresi" class="form_elamanlari" style="width: 100%; height:70px;"></textarea>
						
						<div class="clear"></div>
					</div>
					<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Sipariş Notunuz</b></div>
						<textarea placeholder="varsa sipariş hakkında yazmak istedikleriniz.." name="siparis_notu" class="form_elamanlari" style="width: 100%; height:70px;"></textarea>
						<input type ="checkbox" name="satin_alma_sozlesmesi" required>Sözleşmeyi okudum onaylıyorum.
						<input type ="submit" name="siparisi_tamamla" href="#" value="Siparişi Tamamla"></form>
						<div class="clear"></div>
					</div>
					</div>
				<?php
			}else {  ?>
				<?php 
					if (isset($_GET["uyeyim"])) { ?>
					<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Üye Girişi</b></div>
						<form action="" method="post">
						<input type="email" name="odeme_e_posta" placeholder="E-mail Adresini Giriniz" class="form_elamanlari" required>
						<input type="password" name="odeme_sifre" placeholder="Şifrenizi Giriniz" class="form_elamanlari" required>
						<div class="clear"></div>
						</div>
						<?php
					}
					else { ?>
						<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Üyelik Oluştur - [</b> <a href="?satin_al&uyeyim" >zaten üyeyim</a><b>]</b></div>
						<form action="" method="post">
						<input type="text" name="ad_soyad" placeholder="Ad Soyad" class="form_elamanlari" required>
						<input type="tel" name="telefon" placeholder="Telefon" class="form_elamanlari" required>
						<input type="email" name="e_posta" placeholder="E-mail Adresini Giriniz" class="form_elamanlari" required>
						<input type="password" name="sifre" placeholder="Şifrenizi Giriniz" class="form_elamanlari" required>
						<input type ="checkbox" name="uye_sozlesmesi" required>Üyelik sözleşmesini okudum onaylıyorum.
						<div class="clear"></div>
						</div>
					<?php

					}
				?>
				
 				<div class="clear"></div>
						<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Teslimat Adresi (Alıcı)</b></div>
							<input type="text" name="alici_ad_soyad" placeholder="Alıcının Adı Soyadı" class="form_elamanlari" required>
							<input type="tel" name="alici_telefon" placeholder="Telefon" class="form_elamanlari" required>
							<select class="form_elamanlari" style="width: 100%;" name="il" required>
								<option>İl seçiniz</option>
								<option value="İstanbul">İstanbul</option>
								<option value="Ankara">Ankara</option>
							</select>
							<textarea placeholder="teslimat_adresiniz" name="teslimat_adresi" class="form_elamanlari" style="width: 100%; height:70px;"></textarea>
						
						<div class="clear"></div>
					</div>
					<div class="teslimat_bilgileri">
						<div class="teslimat_baslik"><b>Sipariş Notunuz</b></div>
						<textarea placeholder="varsa sipariş hakkında yazmak istedikleriniz.." name="siparis_notu" class="form_elamanlari" style="width: 100%; height:70px;"></textarea>
						<input type ="checkbox" name="satin_alma_sozlesmesi" required>Sözleşmeyi okudum onaylıyorum. 
						<input type ="submit" name="siparisi_tamamla" href="#" value="Siparişi Tamamla"></form>
						<div class="clear"></div>
					</div>
					</div> 
				
				<?php
			}
		}
		?>
	
<div class="sepet_footer"><div class="copyright"><span>Copyright© <a href="#">hediyesepeti.com</a></span></div></div>
</body>
</html>

	<?php

	}
	else {
		header('location:index.php');
	}
?>



