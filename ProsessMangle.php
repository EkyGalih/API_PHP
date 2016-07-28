<?php
if (isset($_POST['btnAdd'])) {
	//get input
	$chain	  = $_POST['chain'];
	$action	  = $_POST['action'];
	$int 	  = $_POST['src-address'];
	$comment  = $_POST['comment'];
	$disabled = $_POST['disable'];
	//include file connetcion
	include "connect.php";

	//excute sintak mikrotik
	$e->write('/ip/firewall/mangle/add', false);
	$e->write('=chain='.$chain, false);
	$e->write('=action='.$action, false);
	$e->write('=src-address='.$int, false);
	$e->write('=comment='.$comment, false);
	$e->write('=disabled='.$disabled);

	//read sintak mikrotik
	$e->read();
	?>

	 <script language='JavaScript'>
	alert('Add FirewallNat Success!');
	document.location = 'FirewallMangel.php';
	</script>

	<?php
}
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/materialize.min.js"></script>