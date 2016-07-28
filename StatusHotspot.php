
<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<meta http-equiv="Refresh" content="1;URL=hotspot.php">
</head>
<body>
<?php
	//menyisipkan file connect.php
	include "connect.php";

	//mengambil nilaiopr dan id dari querystring
	$opr = $_GET['opr'];
	$id = $_GET['id'];

	//mengeksekusi perintah mikrotik
	if ($opr == 'true') {	
	$e->write('/ip/hotspot/user/enable', false);
	$e->write('=.id='.$id);
	}else{
	$e->write('/ip/hotspot/user/disable', false);
	$e->write('=.id='.$id);
	}

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
?>
	<div class="alert alert-success"> status user berhasil diubah</div>

</body>
</html>