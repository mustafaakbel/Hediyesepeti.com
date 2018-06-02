<html>

<head>
</head>
<body>
	<div id="content">
		<div id="slider">
			<div class="sol">
				<div class="ust"><img src="images/content/main_sbt_2_1522667939_4702.jpg"></div>
				<div class="alt"> <img src="images/content/main_sbt_2_1526365790_8285.jpg"></div>
			</div>
			<div class="sag"> <img src="images/content/main_1522656865_6251.jpg" height="315"></div>
		</div>
		<div id="sic">
			<h2>Sizin İçin Seçtiklerimiz</h2>
			<div id="urun_slider">
				<div class="urun_sablon">
					<ul>
						<?php

						$sic_sql = mysqli_query($baglanti,"SELECT * FROM urunler LIMIT 4");

						while($row = mysqli_fetch_array($sic_sql)){ ?>
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
										echo "<img src='images/content/point2.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==1) {
										echo "<img src='images/content/point1.jpg'>";
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
		<div id="left_button"></div>
		<div id="right_button"></div>
	</div>
</div>

<div id="eb">
	<h2>En Beğenilenler</h2><a href="#" class="eb_link">Tümünü Gör</a>
	<div class="clear"></div>
	<div class="urun_sablon">
		<ul>
						<?php

						$eb_sql = mysqli_query($baglanti,"SELECT * FROM urunler ORDER BY urun_ortalamasi DESC LIMIT 32");

						while($row = mysqli_fetch_array($eb_sql)){ ?>
						<li class="sic_li"> 
							<figure>
								<a href="urun.php?do=<?php echo $row["urun_id"] ?>">
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
										echo "<img src='images/content/point2.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==1) {
										echo "<img src='images/content/point1.jpg'>";
									}
									else {

									}
								?>
								(<?php $id = $row["urun_id"]; $yorum_sayisi = mysqli_query($baglanti,"SELECT * FROM urunler INNER JOIN comments ON urunler.urun_id = comments.urunid WHERE urun_id='$id'");
										echo  mysqli_num_rows($yorum_sayisi); ?>)
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

<div id="yu">
	<h2>Yeni Ürünler</h2><a href="#" class="yu_link">Tümünü Gör</a>
	<div class="clear"></div>
	<div class="urun_sablon">
		<ul>
						<?php

						$yu_sql = mysqli_query($baglanti,"SELECT * FROM urunler ORDER BY urun_tarih DESC LIMIT 8");

						while($row = mysqli_fetch_array($yu_sql)){ ?>
						<li class="sic_li"> 
							<figure>
								<a href="urun.php?do=<?php echo $row["urun_id"] ?>">
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
										echo "<img src='images/content/point2.jpg'>";
									}
									else if ($row["urun_ortalamasi"]==1) {
										echo "<img src='images/content/point1.jpg'>";
									}
									else {

									}
								?>
								(<?php $id = $row["urun_id"]; $yorum_sayisi = mysqli_query($baglanti,"SELECT * FROM urunler INNER JOIN comments ON urunler.urun_id = comments.urunid WHERE urun_id='$id'");
										echo  mysqli_num_rows($yorum_sayisi); ?>)
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