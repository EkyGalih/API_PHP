<?php
if (isset($_POST['submit'])) {
	$default = $_POST['no-default'];

	include "connect.php";
	
	$e->write('/system/reset-configuration', false);	
	$e->write('=no-default='.$default);

	$e->read();
	?>
	<script language='JavaScript'>
        alert('Disconnect!!');
        document.location = 'index.php';
    </script>
	<?php	
}

?>