
<!DOCTYPE html>
<html>
<head>
	<title>Delete Success</title>
	<meta http-equiv="Refresh" content="1;URL=show_user.php">
</head>
<body>
<?php
	//menyisipkan file connect.php
	include "connect.php";

	//mengambil nilai id dari querystring
	$id = $_GET['id'];

	//mengeksekusi perintah mikrotik
	$e->write('/user/remove', false);
	$e->write('=.id='.$id);

	//membaca hasil eksekusi
	$e->read();

	//menampilkan pesan eksekusi
?>
	<div class="alert alert-success"> Data User berhasil dihapus</div>

</body>
</html>