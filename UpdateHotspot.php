<?php
ob_start();
// include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
if (isset($_POST['submit'])) {
		//mengambil inputan
	$id = $_POST['id'];
	$server = $_POST['server'];
	$name = $_POST['name'];
	$profile = $_POST['profile'];
	$uptime = $_POST['uptime'];
	$luptime = $_POST['limit-uptime'];
	$disabled = $_POST['disable'];
		//menyisipkan file koneksi
	include "connect.php";
		//mengeksekusi perintah mikrotik
	$e->write('/ip/hotspot/user/set', false);
	$e->write('=server='.$server, false);
	$e->write('=name='.$name, false);
	$e->write('=profile='.$profile, false);
	$e->write('=uptime='.$uptime, false);
	$e->write('=limit-uptime='.$luptime, false);
	$e->write('=disabled='.$disabled, false);
	$e->write('=.id='.$id);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	echo "<script language='JavaScript'>
	alert('Update Firewall Success!!');
	document.location = 'hotspot.php';
</script>";
}else{
		// mengambil data sebelumnya
	include "connect.php";
		// mengambil nilai parameter id dari querysrting
	$id = $_GET['id'];
		//mengeksekusi perintah mikrotik
	$e->write('/ip/hotspot/user/print', false);
	$e->write('=.proplist=server', false);
	$e->write('=.proplist=name', false);
	$e->write('=.proplist=profile', false);
	$e->write('=.proplist=uptime', false);
	$e->write('=.proplist=limit-uptime', false);
	$e->write('=.proplist=disabled', false);
	$e->write('?.id='.$id);
		//membaca hasil eksekusi
	$hotspot = $e->read();
		//menampilkan ke layar
		// echo "<pre>";
		// print_r($user);
		// echo "</pre>";
	foreach ($hotspot as $row) {
		$server = $row['server'];
		$name = $row['name'];
		$profile = $row['profile'];
		$uptime = $row['uptime'];
		$luptime = $row['limit-uptime'];
		$disabled = $row['disabled'];
	}
}
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Update Data User</h4>
		</div>
		<div class="panel-bofy">
			<form name="frmuser" method="POST" action="UpdateHotspot.php">
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
							<td>Server</td>
							<td>:</td>
							<td>
								<input class="form-control" type="text" name="server" value="<?php if (isset($Server)){echo $Server; } ?>">
							</td>
						</tr>
						<tr>
							<td>Profile</td>
							<td>:</td>
							<td>
								<input class="form-control" type="text" name="profile" value="<?php if (isset($profile)){echo $profile; } ?>">
							</td>
						</tr>
						<tr>
							<td>Uptime</td>
							<td>:</td>
							<td>
								<input class="form-control" type="text" name="uptime" value="<?php if (isset($uptime)){echo $uptime; } ?>">
							</td>
						</tr>
						<tr>
							<td>Limit Uptime</td>
							<td>:</td>
							<td>
								<input class="form-control" type="text" name="profile" value="<?php if (isset($luptime)){echo $luptime; } ?>">
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