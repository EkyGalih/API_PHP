
<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<meta http-equiv="Refresh" content="0;URL=FirewallFilter.php">
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
		$e->write('/ip/firewall/filter/enable', false);
		$e->write('=.id='.$id);
	}else{
		$e->write('/ip/firewall/filter/disable', false);
		$e->write('=.id='.$id);
	}

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
	?>

</body>
</html>