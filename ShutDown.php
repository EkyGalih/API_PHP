<?php
include "connect.php";
$e->write('/system/shutdown');
$e->read();
session_start();
session_destroy();
echo "<script language='JavaScript'>
	alert('MikroTik ShutDown!');
	document.location = 'index.php';
	</script>";
?>