<?php
if (@$_GET) {
	if (!empty($_GET["yorum"])) {
		$yorum_id = $_GET["yorum"];
		$user_id = $_GET["user"];
		$durum = $_GET["durum"];
		$sql = mysqli_query($baglanti,"SELECT * FROM begenme WHERE yorum_id='$yorum_id' && 	user_id ='$user_id' && begen='1'");
		$kontrol = mysqli_num_rows($sql);

		if ($kontrol<1) {
			if ($durum==1) {
				$begeni_ekle = mysqli_query($baglanti,"INSERT INTO begenme(yorum_id,user_id,begen) VALUES('$yorum_id','$user_id','1')");
			}
			
		}
		else {
			if ($durum==0) {
				$begeni_kaldir = mysqli_query($baglanti,"DELETE FROM begenme WHERE  yorum_id='$yorum_id' && user_id ='$user_id' && begen='1'");
			}
		}

		
	}


}
?>