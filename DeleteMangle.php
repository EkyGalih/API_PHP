
<!DOCTYPE html>
<html>
<head>
	<title>Delete Success</title>
</head>
<body>
<?php
	//menyisipkan file connect.php
	include "connect.php";

	//mengambil nilai id dari querystring
	$id = $_GET['id'];

	//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/mangle/remove', false);
	$e->write('=.id='.$id);

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
?>
	<script language='JavaScript'>
		alert('Deleted Success!');
		document.location = 'FirewallMangel.php';
	</script>

</body>
</html>