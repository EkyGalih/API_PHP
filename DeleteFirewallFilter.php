
<!DOCTYPE html>
<html>
<head>
	<title>Delete Firewall Success</title>
	<meta http-equiv="Refresh" content="1;URL=FirewallFilter.php">
</head>
<body>
<?php
	//menyisipkan file connect.php
	include "connect.php";

	//mengambil nilai id dari querystring
	$id = $_GET['id'];

	//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/filter/remove', false);
	$e->write('=.id='.$id);

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
?>
	<script language='JavaScript'>
        alert('Delete Firewall success!!');
        document.location = 'FirewallFilter.php';
    </script>

</body>
</html>