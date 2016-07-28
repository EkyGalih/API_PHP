<?php
ob_start();
// include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$id = $_POST['id'];
	$chain = $_POST['chain'];
	$action = $_POST['action'];
	$address = $_POST['out-interface'];
	$name = $_POST['comment'];
	$disabled = $_POST['disable'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/nat/set', false);
	$e->write('=chain='.$chain, false);
	$e->write('=action='.$action, false);
	$e->write('=out-interface='.$address, false);
	$e->write('=comment='.$name, false);
	$e->write('=disabled='.$disabled, false);
	$e->write('=.id='.$id);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	echo "<script language='JavaScript'>
        alert('Update Firewall Success!!');
        document.location = 'FirewallNat.php';
    </script>";
}else{
		// mengambil data sebelumnya
	include "connect.php";
		// mengambil nilai parameter id dari querysrting
	$id = $_GET['id'];
		//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/nat/print',false);
	$e->write('=.proplist=chain',false);
	$e->write('=.proplist=action',false);
	$e->write('=.proplist=out-interface',false);
	$e->write('=.proplist=comment',false);
	$e->write('=.proplist=disabled',false);
	$e->write('?.id='.$id);
		//membaca hasil eksekusi
	$nat = $e->read();
		//menampilkan ke layar
		// echo "<pre>";
		// print_r($user);
		// echo "</pre>";
	foreach ($nat as $row) {
		$chain = $row['chain'];
		$action = $row['action'];
		$interface = $row['out-interface'];
		$name = $row['comment'];
		$disabled = $row['disabled'];
	}
}
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Update Data Nat</h4>
		</div>
		<div class="panel-bofy">
			<form name="frmnat" method="POST" action="UpdateNat.php">
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
					<td>Chain</td>
					<td>:</td>
					<td>
						<select class="form-control" name="chain">
							<option value="srcnat" <?php if (isset($chain) && $chain=='srcnat') { echo "selected"; } ?>>srcnat</option>
							<option value="dstnat" <?php if (isset($chain) && $chain=='dstnat') { echo "selected"; } ?>>dstnat</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Action</td>
					<td>:</td>
					<td>
						<select class="form-control" name="action">
							<option value="accept" <?php if (isset($action) && $action=='accept') { echo "selected"; } ?>>Accept</option>
							<option value="masquerade" <?php if (isset($action) && $action=='masquerade') { echo "selected"; } ?>>Masquerade</option>
							<option value="redirect" <?php if (isset($action) && $action=='redirect') { echo "selected"; } ?>>Redirect</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Out-Interface</td>
					<td>:</td>
					<td>
					<select class="form-control" name="out-interface">
							<option value="ether2" <?php if (isset($interface) && $interface=='ether2') { echo "selected"; } ?>>Ether 2</option>
							<option value="ether3" <?php if (isset($interface) && $interface=='ether3') { echo "selected"; } ?>>Ether 3</option>
							<option value="ether4" <?php if (isset($interface) && $interface=='ether4') { echo "selected"; } ?>>Ether 4</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Comment</td>
					<td>:</td>
					<td>
						<input class="form-control" type="text" name="comment" value="<?php if (isset($name)){echo $name; } ?>">
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