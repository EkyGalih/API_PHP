<?php
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$name = $_POST['name'];
	$date = $_POST['start-date'];
	$time = $_POST['start-time'];
	$interval = $_POST['interval'];
	$comment = $_POST['comment'];
	$policy  = $_POST['policy'];
	$policy_implode = implode(",",$policy);
	$disabled = $_POST['disable'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/system/scheduler/add', false);
	$e->write('=name='.$name, false);
	$e->write('=start-date='.$date, false);
	$e->write('=start-time='.$time, false);
	$e->write('=interval='.$interval, false);
	$e->write('=comment='.$comment, false);
	$e->write('=policy='.$policy_implode, false);
	$e->write('=disabled='.$disabled);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	?>
	 <script language='JavaScript'>
        alert('Add Scheduler Success!!');
        document.location = 'Scheduler.php';
    </script>
	<?php
}
?>