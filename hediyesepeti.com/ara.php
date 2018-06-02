<html>
<head>
</head>
<body>

	<?php include 'header.php'; ?>

	<?php 
	$aranacak_kelime = $_GET["aranacak_kelime"];
	$arama_sql = mysqli_query($baglanti,"SELECT * FROM urunler WHERE urun_adi LIKE '%$aranacak_kelime%'");
	?>
							
	<div class="ara_content">
			<div class="urun_sablon">
					<ul>
						<?php

						while($row = mysqli_fetch_array($arama_sql)){ ?>
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
	<?php include 'footer.php'; ?>
</body>
</html>
