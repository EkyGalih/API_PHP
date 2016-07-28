<?php
	//cek if button submit on click
if (isset($_POST['submit'])) {
		//get data from input form
	$name = $_POST['list'];
	$address = $_POST['address'];
	$comment = $_POST['comment'];
	$disabled = $_POST['disabled'];
		//include file connect.php
	include "connect.php";
		//excute synat MikroTik
	$e->write('/ip/firewall/address-list/add', false);
	$e->write('=list='.$name, false);
	$e->write('=address='.$address, false);
	$e->write('=comment='.$comment, false);
	$e->write('=disabled='.$disabled);
			//read syntax MikroTik
	$coba = $e->read();
	?>
		<!-- show message after input data to MikroTik success -->
	<script language='JavaScript'>
        alert('Add Firewall Success!!');
        document.location = 'AddressList.php';
    </script>
	<?php
}
?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/materialize.min.js"></script>