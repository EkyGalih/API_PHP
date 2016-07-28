
<!DOCTYPE html>
<html>
<head>
	<title>Update status success</title>
	<meta http-equiv="Refresh" content="0;URL=Scheduler.php">
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
	$e->write('/system/scheduler/enable', false);
	$e->write('=.id='.$id);
	}else{
	$e->write('/system/scheduler/disable', false);
	$e->write('=.id='.$id);
	}

	//membaca hasil eksekusi
	$e->read();
?>

</body>
</html>