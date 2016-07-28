<?php
include "routeros_api.class.php";
include "css.php";


	//membuat instance
$e = new RouterosAPI();
session_start();
if (isset($_POST['btnlogin'])) {
	$hostname = $_POST['hostname'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	//create session for login to aplication
	$_SESSION['hostname'] = $hostname;
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
}

// $hostname	= "192.168.10.1";
// $username	= "admin";
// $pass		= "";

if (!$e->connect($_SESSION['hostname'], $_SESSION['username'], $_SESSION['password'])) {
	?>
	<div class="alert alert-danger">Connect to MikroTik Failed!</div>
	<?php
}
?>