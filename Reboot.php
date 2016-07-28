<?php
include "connect.php";
$e->write('/system/reboot');
$e->read();
session_start();
session_destroy();
echo "<script language='JavaScript'>
	alert('MikroTik being restarted!');
	document.location = 'index.php';
	</script>";
?>