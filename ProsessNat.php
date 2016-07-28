<?php
if (isset($_POST['save'])) {
	//get input
	$chain	  = $_POST['chain'];
	$action	  = $_POST['action'];
	$int 	  = $_POST['out-interface'];
	$comment  = $_POST['comment'];
	$disabled = $_POST['disable'];
	//include file connetcion
	include "connect.php";

	//excute sintak mikrotik
	$e->write('/ip/firewall/nat/add', false);
	$e->write('=chain='.$chain, false);
	$e->write('=action='.$action, false);
	$e->write('=out-interface='.$int, false);
	$e->write('=comment='.$comment, false);
	$e->write('=disabled='.$disabled);

	//read sintak mikrotik
	$e->read();
	?>

	 <script language='JavaScript'>
	alert('Add FirewallNat Success!');
	document.location = 'FirewallNat.php';
	</script>

	<?php
}
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/materialize.min.js"></script>