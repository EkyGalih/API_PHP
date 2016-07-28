<?php
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$name = $_POST['name'];
	$source = $_POST['source'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/system/script/add', false);
	$e->write('=name='.$name, false);
	$e->write('=source='.$source, false);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	?>
	<script language='JavaScript'>
		alert('Add Script Success!!');
		document.location = 'Script.php';
	</script>
	<?php
}
?>