				
<html>
<head>
</head>
<body>

	<?php 
	include("vt.php");

	function kategori($ust_kategori_id = 0,$baglan) {
		$query= mysqli_query($baglan,"SELECT * FROM kategoriler WHERE ust_kategori_id = '$ust_kategori_id'");
		if (mysqli_num_rows($query)<1) {
			return false;
		}else {  ?>
		<ul>
			<?php
			while ($row = mysqli_fetch_array($query)) { ?>
			<li><a href="kategori.php?kid=<?php echo $row["kategori_id"] ?>"><?php echo  $row["kategori_adi"]; ?></a> <?php kategori($row["kategori_id"],$baglan); ?></li>
			<?php } ?>
		</ul>
		<?php
	}
}
?>
</body>
</html>