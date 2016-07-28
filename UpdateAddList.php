<?php
ob_start();
// include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$id = $_POST['id'];
	$list = $_POST['list'];
	$address = $_POST['address'];
	$name = $_POST['comment'];
	$disabled = $_POST['disable'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/ip/firewall/address-list/set', false);
	$e->write('=list='.$list, false);
	$e->write('=address='.$address, false);
	$e->write('=comment='.$name, false);
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
	$e->write('/ip/firewall/address-list/print',false);
	$e->write('=.proplist=list',false);
	$e->write('=.proplist=address',false);
	$e->write('=.proplist=comment',false);
	$e->write('=.proplist=disabled',false);
	$e->write('?.id='.$id);
		//membaca hasil eksekusi
	$list = $e->read();
		//menampilkan ke layar
		// echo "<pre>";
		// print_r($list);
		// echo "</pre>";
	foreach ($list as $row) {
		$list = $row['list'];
		$time = $row['timeout'];
		$dynamic = $row['dynamic'];
		$address = $row['address'];
		$name = $row['comment'];
		$disabled = $row['disabled'];
	}
}
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Update Data Address List</h4>
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
						<input class="form-control" type="text" name="list" value="<?php if (isset($list)){echo $list; } ?>">
					</td>
				</tr>
				<tr>
					<td>Target Address</td>
					<td>:</td>
					<td>
						<input class="form-control" type="text" name="address" value="<?php if (isset($address)){echo $address; } ?>">
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