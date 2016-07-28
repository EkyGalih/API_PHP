<!DOCTYPE html>
<html>
<?php
include "connect.php";
$e->write('/system/script/getall');

$srpt = $e->read();

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
					<td>SOURCE</td>
					<td>RUN COUNT</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<?php foreach ($srpt as $eky) { ?>
			<tr>
				<td align='center'><?php echo $eky['.id'] ?></td>
				<td align="center"><?php echo $eky['name'] ?></td>
				<td align="center"><?php echo $eky['source'] ?></td>
				<td align="center"><?php echo $eky['run-count']." x Run" ?></td>
				<td align="center">
					<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSuru" href="UpdateFirewallFilter.php?id=<?php echo $eky['.id'] ?>">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
					<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteScript.php?id=<?php echo $eky['.id'] ?>" onclick="return confirm('Script Must Deleted!\n\Are You sure?');">
						<i class="glyphicon glyphicon-trash"></i>
					</a>
					<a href="RunScript.php?id=<?php echo $eky['.id'] ?>" class="animated bounceInUp btn btn-success btn-sm">
						<i class="glyphicon glyphicon-play"></i>
					</a>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<button type="button" class="animated flip btn btn-success btn-sm" data-toggle="modal" data-target="#script">
		<u>A</u>dd Script <label class="glyphicon glyphicon-plus"></label>
	</button>

	<div class="animated rubberBand modal" id="script" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Script</h4>
				</div>
				<div class="modal-body">
					<form name="script" action="AddScript.php" method="POST">
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-pencil"></label>
							</span>
							<select name="name" class="form-control">
								<option>Name</option>
								<option>----</option>
								<?php
								$e->write('/system/scheduler/getall');
								$show = $e->read();
								foreach ($show as $row) {
									$name = $row['name'];
									?>
									<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
									<?php
								}
								?>
							</select>
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-file"></label>
							</span>
							<textarea name="source" class="form-control">
"/ip firewall filter disable [/ip firewall filter find comment=client-local]"
							</textarea>
						</div><br/>
						<button type="submit" name="submit" class="btn btn-danger btn-sm">
							<label class="glyphicon glyphicon-plus"></label> <u>A</u>dd
						</button>
						<button type="reset" name="reset" class="btn btn-warning btn-sm">
							<label class="glyphicon glyphicon-refresh"></label> <u>R</u>eset
						</button>
					</form>
				</div>
				<div class="-modal-footer">
					<button type="button" class="btn" data-dismiss="modal">
						<label class="glyphicon glyphicon-remove"></label> <u>C</u>lose
					</button>
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