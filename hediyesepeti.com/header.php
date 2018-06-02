<?php 
include("login.php");
include("kategori_cekme.php");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[type=radio][name=uyelik]').change(function() {
				if (this.value == 'uye_ol') {
					$("#form_grup").show();
					$("#giris_yap_form").hide();
					$("#gonderme").show();
					$("#giris_yap_buton").hide();
					
				}
				else if (this.value == 'giris_yap') {
					$("#form_grup").hide();
					$("#giris_yap_form").show();
					$("#gonderme").hide();
					$("#giris_yap_buton").show();
				}
			});
			

		});	
		$(document).ready(function(){
			$("#help").click(function(){
				$("#help_info").toggle();
			});
		});

		$(document).ready(function(){
			$("#yorum_yap").click(function(){
				$("#yorum_ekrani").toggle(500);
			});
		});
		$(document).ready(function(){
			$("#teslimat_secenekleri").click(function(){
				$("#teslimat_secenekleri_liste").toggle(500);
			});
		});
	</script>
</head>
<body>
	<div id="header">
		<div id="top">
			<div id="container">
				<a href="index.php"><div id="logo"></div></a>
				
				<div id="searchbox">
					<form name="searchform" method="get" action="ara.php">
						<input type="text" name="aranacak_kelime" placeholder="Aramak istediğiniz ürünü yazınız...">
						<input type="submit" name="ara" value="Ara">
					</form>
				</div>
				
				<div id="user-login">
					<div id="help">Yardım
						<span class="help_icon"></span>
					</div>
					<div id="help_info">
						asdasd
					</div>
					
					<?php if(@$_SESSION["oturum"]):  ?>
						<?php 
							$mail=$_SESSION["mail"];
							$isim = mysqli_query($baglanti,"SELECT * FROM users WHERE mail = '$mail'"); 
							$goster_isim=mysqli_fetch_array($isim);  ?>
						<div class="hesabim"  > Hesabım
							<span class="giris_icon"></span>
							<div class="hesabim_ic">
								<ul>
									<li><a href="profil.php?uid=<?php echo $goster_isim["id"] ?>"><?php echo $goster_isim["ad"] ?></a></li>
									<li><a href='login.php?do=cikis'>Çıkış</a> </li>
								</ul>
							
							
							</div>
						</div>

					<?php else: ?>
						<div id="giris" onclick="document.getElementById('giris_ekrani').style.display='block'" >Giriş
							<span class="giris_icon"></span>
						</div>
					<?php endif; ?>


					<div id="giris_ekrani" class="ge">
						
						<form class="giris_ekrani_icerik animasyon" action="" method="post" id="uye" id="uye">
							<label><input type="radio" name="uyelik" checked="checked" value="uye_ol" id="uye_ol">Üye Ol</label>
							<label><input type="radio" name="uyelik" value="giris_yap">Giriş Yap(Zaten Üyeyim)</label>
							<div id="form_grup">
								<span><input type="text"  placeholder="Ad Soyad" class="kontrol"  style="width: 100%; float: left;"  name="uye_isim" required="" /> </span>
								<div class="mail"><input type="email" placeholder="E-Posta Adresinizi Girin" class="kontrol" name ="kayit_mail" required=""></div>
								<div class="sifre"><input type="password" placeholder="Lütfen Şifrenizi Belirleyin" class="kontrol" name="kayit_sifre" required=""> </div>
								<input type ="checkbox" name="sozlesme" required="">
								<a href="#SozlesmePopup">Üyelik Sözleşmesi</a>'ni okudum/onaylıyorum.
							</div>
							<div id="gonderme"><input type ="submit" value="ÜYE OL " href="#" name="uye_ol_buton"></div>
							</form>
								<form class="giris_yap animasyon" action="" method="post" id="giris">
									<div id="giris_yap_form">
										<div class="mail"><input type="email" name="giris_mail" placeholder="E-Posta Adresinizi Girin" class="kontrol" id="email" value="<?php if (isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" required></div>
										<div class="sifre"><input type="password" name="giris_sifre" placeholder="Şifre" class="kontrol" id="pass" value="<?php if (isset($_COOKIE["sifre"])) { echo $_COOKIE["sifre"]; } ?>" required></div>
										<input type="checkbox" name="beni_hatirla" value="1"> Beni Hatırla
									</div>
									<div id="giris_yap_buton"><input type ="submit" value="Giriş Yap " href="#" name="giris_yap_buton"></div>
							</form>
						
						

						
					</div>

					<a href="sepet.php"><div id="sepet"><span><?php if (!empty($_COOKIE["urun"])) { echo count($_COOKIE["urun"]); }  ?></span></div></a>
				</div>
			</div>
		</div>
		<div id="bottom">
			<div id="container">
				<?php kategori(0,$baglanti); ?>
	</div>
</div>
</div>
</body>
</html>
