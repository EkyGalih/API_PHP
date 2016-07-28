<?php
include "connect.php";

$e->write('/ip/hotspot/user/getall');
$hotspot = $e->read();

include "navbar.php";
session_start();
?>

<div class="alert alert-default">
	<h4 class="animated bounceInRight" align="center">Daftar Ip Hotspot</h4>
</div>
<div class="col-md-8 col-md-offset-2">
	<table class="animated bounceInLeft table table-hover table-bordered table-striped dataTables" id="table_hotspot">
		<thead>
			<tr align="center">
				<td>No.</td>
				<td>Server</td>
				<td>Name</td>
				<td>Profile</td>
				<td>Uptime</td>
				<td>Limit Uptime</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<?php
		$no=1;
		foreach ($hotspot as $h){
			?>
			<tbody>
				<tr>
					<td align="center"><?php echo $no ?></td>
					<td align="center"><?php echo $h['server'] ?></td>
					<td align="center"><?php echo $h['name'] ?></td>
					<td align="center"><?php echo $h['profile'] ?></td>
					<td align="center"><?php echo $h['uptime'] ?></td>
					<td align="center"><?php echo $h['limit-uptime'] ?></td>
					<td align="center">
						<a title="Update" class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalHotspot" href="UpdateHotspot.php?id=<?php echo $h['.id'] ?>">
							<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
						</a>
						<a title="Delete" class="animated bounceInDown btn btn-danger btn-sm" href="DeleteHotspot.php?id=<?php echo $h['.id'] ?>" onclick="return confirm('Firewall Must Deleted!\n\Are You sure?');">
							<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
						</a>
						<?php
						if ($h['disabled'] == 'true') {
							echo '<a title="Enable" class="animated bounceInUp btn btn-success btn-sm" href="StatusHotspot.php?opr=true&id='.$h['.id'].'">
							<label class="glyphicon glyphicon-ok"></label> <u>E</u>nable
						</a>';
					}else{
						echo '<a title="Disable" class="animated bounceInUp btn btn-warning btn-sm" href="StatusHotspot.php?opr=false&id='.$h['.id'].'">
						<label class="glyphicon glyphicon-remove"></label> <u>D</u>isable</a>';
					}
					?>
				</td>
			</tr>
		</tbody>
		<?php
		$no++;
	}
	?>
</table>
<div class="modal fade" id="modalHotspot" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
        <!-- <div class="modal-body">
          
    </div> -->
    <div class="modal-footer">
    	<button type="button" class="btn btn-default" data-dismiss="modal"><u>C</u>lose</button>
    </div>
</div>
</div>