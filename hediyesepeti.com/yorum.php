
		<?php 
				@$mail = $_SESSION["mail"];
				$user_id = mysqli_query($baglanti,"SELECT id FROM users WHERE mail = '$mail'");
				$goster = mysqli_fetch_array($user_id);
			if(@$_POST["yorumuyap"]){
				$yorum_basligi = $_POST["yorum_basligi"];
				$yorum_puan = $_POST["yorum_puan"];
				$yorum_icerik = $_POST["yorum_icerik"];
				$otomatik_tarih = date('Y-m-d ');
				$urun_id = $_POST["urunid"];
				$yorum_ekleme = mysqli_query($baglanti,"INSERT INTO comments(yorumbaslik,yorumpuan,yorumicerik,yorumtarih,urunid,usersid) VALUES('$yorum_basligi','$yorum_puan','$yorum_icerik','$otomatik_tarih',$urun_id,'$goster[0]')");

				$toplam_puan = mysqli_query($baglanti,"SELECT AVG(yorumpuan) as ortalama FROM comments WHERE urunid='$urun_id'");
				$sonuc = mysqli_fetch_array($toplam_puan);
				$ortalama = ceil($sonuc["ortalama"]);
				$puan_guncelle= mysqli_query($baglanti,"UPDATE urunler SET urun_ortalamasi='$ortalama' WHERE urun_id='$urun_id'");
				header('location:'.$_SERVER["HTTP_REFERER"]);
			}
			else if (@$_POST["yorum_yanitla"]) {
				
				if (empty(!$_POST["yorum_yaniti"])) {
					$yorum_yaniti = $_POST["yorum_yaniti"];
					$id = $_POST["ustyorum"];
					$tarih = date('d.m.Y ');	
					$yorum_cevap_sql = mysqli_query($baglanti,"INSERT INTO comments_answer(cevapicerik,ustyorumid,userid,answer_date) VALUES('$yorum_yaniti','$id','$goster[0]','$tarih')");
					
				}
				else{
					echo  "<script type='text/javascript'>alert('Yanıt boş bırakılamaz!');</script>";
				}
				
			}
			
			if (@$_POST["yanita_yanit"]) {
				$yanit_icerik = $_POST["yanit_icerik"];
				$yanit_id = $_POST["yanit_id"];
				$tarih = date('d.m.Y ');	
				$yorum_cevap_sql = mysqli_query($baglanti,"INSERT INTO comments_answer(cevapicerik,ustyorumid,userid,answer_date) VALUES('$yanit_icerik','$yanit_id','$goster[0]','$tarih')");
			}
			function yorum_say($yorum_id,$begenen_kisi,$baglanti){
				$kontrol_cevap = mysqli_query($baglanti,"SELECT * FROM begenme WHERE user_id='$begenen_kisi' && yorum_id='$yorum_id' && begen='1'");
				return mysqli_num_rows($kontrol_cevap);
			}

			function begenme($yorum_id,$begenen_kisi,$baglanti){
				$kontrol_cevap = mysqli_query($baglanti,"SELECT * FROM begenme WHERE user_id='$begenen_kisi' && yorum_id='$yorum_id' && begen='1'");
				$sayac_cevap = mysqli_query($baglanti,"SELECT * FROM begenme WHERE yorum_id = $yorum_id");
				$cevap_begenme = mysqli_query($baglanti,"SELECT * FROM begenme INNER JOIN users ON begenme.user_id = users.id WHERE yorum_id='$yorum_id'");
				$say = mysqli_num_rows($kontrol_cevap);
				 if (mysqli_num_rows($sayac_cevap)!=0) { ?>
								<div class="sayac"> <img src="images/urun/begeni.png">
									<?php
									echo mysqli_num_rows($sayac_cevap);
									?>
									<div class="kimler_begenmis">
										<ul>
											<?php
											while ($yazdir = mysqli_fetch_array($cevap_begenme)) { ?>
											<li><?php echo $yazdir["ad"];?></li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>

							<?php
						} 

			}
		?>