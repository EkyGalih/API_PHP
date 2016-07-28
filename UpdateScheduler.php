<?php
ob_start();
// include "navbar.php";
	//cek if click button submit
if (isset($_POST['submit'])) {
		//get input
	$id = $_POST['id'];
	$name = $_POST['name'];
	$date = $_POST['start-date'];
	$time = $_POST['start-time'];
	$interval = $_POST['interval'];
	$disabled = $_POST['disable'];
		//include file connect
	include "connect.php";
		//excute syntax MikroTik
	$e->write('/system/scheduler/set', false);
	$e->write('=name='.$name, false);
	$e->write('=start-date='.$date, false);
	$e->write('=start-time='.$time, false);
	$e->write('=interval='.$interval, false);
	$e->write('=disabled='.$disabled, false);
	$e->write('=.id='.$id);
			//membaca hasil eksekusi perintah
	$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
	echo "<script language='JavaScript'>
        alert('Update Scheduler Success!!');
        document.location = 'Scheduler.php';
    </script>";
}else{
		// mengambil data sebelumnya
	include "connect.php";
		// mengambil nilai parameter id dari querysrting
	$id = $_GET['id'];
		//mengeksekusi perintah mikrotik
	$e->write('/system/scheduler/print',false);
	$e->write('=.proplist=name',false);
	$e->write('=.proplist=start-date',false);
	$e->write('=.proplist=start-time',false);
	$e->write('=.proplist=interval',false);
	$e->write('=.proplist=disabled',false);
	$e->write('?.id='.$id);
		//membaca hasil eksekusi
	$sch = $e->read();

	foreach ($sch as $row) {
		$name = $row['name'];
		$date = $row['start-date'];
		$time = $row['start-time'];
		$interval = $row['interval'];
		$disabled = $row['disabled'];
	}
}
?>
<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Update Data Scheduler</h4>
		</div>
		<div class="panel-bofy">
			<form name="frmsch" method="POST" action="UpdateScheduler.php">
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
						<input class="form-control" type="text" name="name" value="<?php if (isset($name)){echo $name; } ?>">
					</td>
				</tr>
				<tr>
					<td>Start Date</td>
					<td>:</td>
					<td>
					<br/>
						<input class="form-control" type="text" name="start-date" value="<?php if (isset($date)){echo $date; } ?>">
					</td>
				</tr>
				<tr>
					<td>Start Time</td>
					<td>:</td>
					<td>
					<br/>
						<input class="form-control" type="text" name="start-time" value="<?php if (isset($time)){echo $time; } ?>">
					</td>
				</tr>
				<tr>
					<td>Interval</td>
					<td>:</td>
					<td>
					<br/>
						<input class="form-control" type="text" name="interval" value="<?php if (isset($interval)){echo $interval; } ?>">
					</td>
				</tr>
				<tr>
					<td>Disable</td>
					<td>:</td>
					<td>
					<br/>
						<input type="radio" name="disable" value="yes" <?php if(isset($disabled) && $disabled=='true') { echo "checked"; } ?>> Yes <input type="radio" name="disable" value="no" <?php if(isset($disabled) && $disabled=='false') { echo "checked"; } ?>> No
						<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; } ?>">
					</td>
				</tr>
				<tr>
					<td>
					<br/>
						<button class="btn btn-primary" type="submit" name="submit" value="Update">
							<u>U</u>pdate <label class="glyphicon glyphicon-send"></label>
						</button>
						<button class="btn" type="reset" name="reset" value="Reset">
							<u>R</u>eset <label class="glyphicon glyphicon-refresh"></label>
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