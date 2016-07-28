
<!DOCTYPE html>
<html>
<head>
	<title>Change Success</title>
	<meta http-equiv="Refresh" content="0;URL=FirewallNat.php">

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
	$e->write('/ip/firewall/nat/enable', false);
	$e->write('=.id='.$id);
	}else{
	$e->write('/ip/firewall/nat/disable', false);
	$e->write('=.id='.$id);
	}

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
?>
</body>
</html>