<?php
ob_start();
// include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$id = $_POST['id'];
	$name = $_POST['comment'];
	$chain = $_POST['chain'];
	$action = $_POST['action'];
	// $address = $_POST['src-address'];
	$disabled = $_POST['disable'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/filter/set', false);
	$e->write('=comment='.$name, false);
	$e->write('=chain='.$chain, false);
	$e->write('=action='.$action, false);
	// $e->write('=src-address='.$address, false);
	$e->write('=disabled='.$disabled, false);
	$e->write('=.id='.$id);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	echo "<script language='JavaScript'>
        alert('Update Firewall Success!!');
        document.location = 'FirewallFilter.php';
    </script>";
}else{
		// mengambil data sebelumnya
	include "connect.php";
		// mengambil nilai parameter id dari querysrting
	$id = $_GET['id'];
		//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/filter/print',false);
	$e->write('=.proplist=comment',false);
	$e->write('=.proplist=chain',false);
	$e->write('=.proplist=action',false);
	$e->write('=.proplist=src-address',false);
	$e->write('=.proplist=disabled',false);
	$e->write('?.id='.$id);
		//membaca hasil eksekusi
	$user = $e->read();
		//menampilkan ke layar
		// echo "<pre>";
		// print_r($user);
		// echo "</pre>";
	foreach ($user as $row) {
		$name = $row['comment'];
		$chain = $row['chain'];
		$action = $row['action'];
		$address = $row['src-address'];
		$disabled = $row['disabled'];
	}
}
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Update Data Firewall</h4>
		</div>
		<div class="panel-bofy">
			<form name="frmuser" method="POST" action="UpdateFirewallFilter.php">
		<table border="0">
			<th>
			<tr>
				<td height="30px" width="40px"></td>
				<td height="30px" width="40px"></td>
				<td height="30px" width="40px"></td>
			</tr>
			</th>
			<tbody>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td>
						<input class="form-control" type="text" name="comment" value="<?php if (isset($name)){echo $name; } ?>">
					</td>
				</tr>
				<tr>
					<td>Chain</td>
					<td>:</td>
					<td>
						<select class="form-control" name="chain">
							<option value="forward" <?php if (isset($chain) && $chain=='forward') { echo "selected"; } ?>>Forward</option>
							<option value="input" <?php if (isset($chain) && $chain=='input') { echo "selected"; } ?>>Input</option>
							<option value="output" <?php if (isset($chain) && $chain=='output') { echo "selected"; } ?>>Output</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Action</td>
					<td>:</td>
					<td>
						<select class="form-control" name="action">
							<option value="accept" <?php if (isset($action) && $action=='accept') { echo "selected"; } ?>>Accept</option>
							<option value="drop" <?php if (isset($action) && $action=='drop') { echo "selected"; } ?>>Drop</option>
							<option value="reject" <?php if (isset($action) && $action=='reject') { echo "selected"; } ?>>Reject</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Target Address</td>
					<td>:</td>
					<td>
						<input class="form-control" type="text" name="src-address" value="<?php if (isset($name)){echo $address; } ?>">
					</td>
				</tr>
				<tr>
					<td>Disable</td>
					<td>:</td>
					<td>
						<input type="radio" name="disable" value="yes" <?php if(isset($disabled) && $disabled=='true') { echo "checked"; } ?>> Yes <input type="radio" name="disable" value="no" <?php if(isset($disabled) && $disabled=='false') { echo "checked"; } ?>> No
						<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; } ?>">
					</td>
				</tr>
				<tr>
					<td>
						<button class="btn btn-primary" type="submit" name="submit" value="Update">
							Update <label class="glyphicon glyphicon-send"></label>
						</button>
						<button class="btn" type="reset" name="reset" value="Reset">
							Reset <label class="glyphicon glyphicon-refresh"></label>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
		</div>
	</div>
</div>
<?php 
ob_end_flush();
?>