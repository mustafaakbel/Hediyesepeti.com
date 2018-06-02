<html>
<head>
</head>
<body>

	<?php include("header.php");
	?>

	<?php if(@$_SESSION["oturum"]): 

	include("content.php");
	?>

	<?php else: 
	include("content.php");
	?>
	<?php endif; ?>
	<?php include("footer.php") ?>


</body>



</html>