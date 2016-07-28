<?php
	//cek if button submit klik
if (isset($_POST['submit'])) {
		//mengambil inputan
	$name = $_POST['comment'];
	$chain = $_POST['chain'];
	$action = $_POST['action'];
	// $address = $_POST['src-address'];
	$list	 = $_POST['address-list'];
	$disabled = $_POST['disable'];
		//include file connect.php
	include "connect.php";
		//read synatx MikroTik
	$e->write('/ip/firewall/filter/add', false);
	$e->write('=comment='.$name, false);
	$e->write('=chain='.$chain, false);
	$e->write('=action='.$action, false);
	// $e->write('=src-address='.$address, false);
	$e->write('=address-list='.$list, false);
	$e->write('=disabled='.$disabled);
			//read excute syntax MikroTik
	$e->read();
		//show message after excute syntax MikroTik
	?>
	 <script language='JavaScript'>
        alert('Add Firewall Success!!');
        document.location = 'FirewallFilter.php';
    </script>
	<?php
}
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/materialize.min.js"></script>