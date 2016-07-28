<!DOCTYPE html>
<html>
<?php
include "connect.php";
$e->write('/system/scheduler/getall');

$sch = $e->read();

include "navbar.php";
?>

<body>
	<div class="alert alert-default">
		<h4 class="animated bounceInLeft" align="center">DAFTAR SCHEDULER</h4>
	</div>
	<div class="col-sm-12">
		<table class="animated bounceInRight table table-bordered table-hover table-striped dataTables" id="table_suru">
			<thead>
				<tr align="center">
					<td>ID</td>
					<td>NAME</td>
					<td>START DATE</td>
					<td>START TIME</td>
					<td>INTERVAL</td>
					<td>RUN COUNT</td>
					<td>DISABLED</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<?php foreach ($sch as $eky) { ?>
			<tr>
				<td align='center'><?php echo $eky['.id'] ?></td>
				<td align="center"><?php echo $eky['name'] ?></td>
				<td align="center"><?php echo $eky['start-date'] ?></td>
				<td align="center"><?php echo $eky['start-time'] ?></td>
				<td align="center"><?php echo $eky['interval'] ?></td>
				<td align="center"><?php echo $eky['run-count']  ?>x Run</td>
				<td align="center"><?php echo $eky['disabled'] ?></td>
				<td align="center">
					<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#sch" href="UpdateScheduler.php?id=<?php echo $eky['.id'] ?>">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
					<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteScheduler.php?id=<?php echo $eky['.id'] ?>" onclick="return confirm('Scheduler Must Deleted!\n\Are You sure?');">
						<i class="glyphicon glyphicon-trash"></i>
					</a>
					<?php
					if ($eky['disabled'] == 'true') {
						echo '<a class="animated bounceInUp btn btn-success btn-sm" href="StatusScheduler.php?opr=true&id='.$eky['.id'].'">
						<i class="glyphicon glyphicon-ok"></i>
					</a>';
				}else{
					echo '<a class="animated bounceInUp btn btn-warning btn-sm" href="StatusScheduler.php?opr=false&id='.$eky['.id'].'">
					<i class="glyphicon glyphicon-remove"></i></a>';
				}
				?>
			</td>
		</tr>
		<?php
	}
	?>
</table>

<div class="animated shake modal fade" id="sch" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>

<button type="button" class="animated flip btn btn-success btn-sm" data-toggle="modal" data-target="#scheduler">
	<u>A</u>dd Scheduler <label class="glyphicon glyphicon-plus"></label>
</button>

<div class="animated shake modal fade" id="scheduler" role="dialog">
	<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Scheduler</h4>
			</div>
			<div class="modal-body">
				<form name="scheduler" action="ProsessScheduler.php" method="POST" onsubmit="return validateForm()">
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-pencil"></label>
						</span>
						<input type="text" name="name" class="form-control" placeholder="name Scheduler">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-calendar"></label>
						</span>
						<input type="text" placeholder="mm/dd/yy (date)" name="start-date" class="form-control">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-time"></label>
						</span>
						<input type="text" placeholder="00:00:00 (start time)" name="start-time" class="form-control">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-time"></label>
						</span>
						<input type="text" placeholder="00:00:00 (interval)" name="interval" class="form-control">
					</div><br/>
					<p>
						Policy :<br/>
						<input type="checkbox" name="policy[]" value="write"> Write
						<input type="checkbox" name="policy[]" value="read"> Read
						<input type="checkbox" name="policy[]" value="sniff"> Sniff
						<input type="checkbox" name="policy[]" value="test"> Test
						<input type="checkbox" name="policy[]" value="policy"> Policy
						<input type="checkbox" name="policy[]" value="password"> Password
						<input type="checkbox" name="policy[]" value="reboot"> Reboot
						<input type="checkbox" name="policy[]" value="sensitive"> Sensitive
					</p>
					<p>
						Disabled :<br/>
						<input type="radio" name="disable" value="yes"> Yes
						<input type="radio" name="disable" value="no"> No
					</p>
					<button type="submit" name="submit" class="btn btn-danger btn-sm">
						<label class="glyphicon glyphicon-plus"></label> <u>A</u>dd
					</button>
					<button type="reset" name="reset" class="btn btn-warning btn-sm">
						<label class="glyphicon glyphicon-refresh"></label> <u>R</u>eset
					</button>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn" data-dismiss="modal">
				<label class="glyphicon glyphicon-remove"></label> <u>C</u>lose
			</button>
		</div>
	</div>
</div>
</div>
</div>

</body>
<?php include "footer.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table_suru').DataTable();
	});
</script>
</html>