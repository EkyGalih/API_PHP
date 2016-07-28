<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<meta http-equiv="Refresh" content="0;URL=Script.php">
</head>
<body>
<?php
	//menyisipkan file connect.php
	include "connect.php";

	//mengambil nilai id dari querystring
	$id = $_GET['id'];

	//mengeksekusi perintah mikrotik
	$e->write('/system/script/run', false);
	$e->write('=.id='.$id);

	//membaca hasil eksekusi
	$e->read();
?>

</body>
</html>