<html>
<head>
		<link rel="stylesheet" type="text/css" href="css/theme.css">
	</head>
	<body>
		<div class="sepet_header"><div class="sepet_header_ic"><a href="index.php"><div class="sepet_logo"></div></a></div></div>
		<?php
			include("vt.php");
			$uid = $_GET["uid"];
			$profil_sql = mysqli_query($baglanti,"SELECT * FROM users WHERE id = '$uid'");
			$profil = mysqli_fetch_array($profil_sql);
		?>
		<div class="profil_content">
			<div class="profil_foto"> <img src="images/profil_fotograflari/<?php echo $profil["foto"]; ?>"></div>

			<div class="profil_detay">
				<h1><?php echo $profil["ad"] ?></h1>
			</div>
			<div class="profil_detay">Mail : <?php echo $profil["mail"] ?></div>
			<div class="profil_detay">Kayıt Tarihi : <?php echo $profil["tarih"] ?></div>
		</div>


		<div class="sepet_footer"><div class="copyright"><span>Copyright© <a href="#">hediyesepeti.com</a></span></div></div>
	</body>
</html>