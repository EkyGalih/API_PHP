<?php
include "connect.php";

$e->write('/ip/firewall/nat/getall');

$nat = $e->read();

include "navbar.php";

?>
<div class="container">
	<h4 align="center" class="animated bounceInDown">List Firewall NAT</h4>
	<div class="col-sm-12">
		<table class="animated flip table table-bordered table-hover dataTables table-striped" id="table_eky">
			<thead>
				<tr align="center">
					<td>No.</td>
					<td>Id</td>
					<td>Chain</td>
					<td>Action</td>
					<td>Disabled</td>
					<td>Interface</td>
					<td>Comment</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<?php
			$no = 1;
			foreach ($nat as $s) {
				?>
				<tbody>
					<tr>
						<td align="center"><?php echo $no ?></td>
						<td align="center"><?php echo $s['.id'] ?></td>
						<td align="center"><?php echo $s['chain'] ?></td>
						<td align="center"><?php echo $s['action'] ?></td>
						<td align="center"><?php echo $s['disabled'] ?></td>
						<td align="center"><?php echo $s['out-interface'] ?></td>
						<td align="center"><?php echo $s['comment'] ?></td>
						<td>
							<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUpdate" href="UpdateNat.php?id=<?php echo $s['.id'] ?>">
								<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
							</a>
							<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteNat.php?id=<?php echo $s['.id'] ?>">
								<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
							</a>
							<?php
							if ($s['disabled'] == 'true') {
								echo '<a class="animated bounceInUp btn btn-success btn-sm" href="StatusNat.php?opr=true&id='.$s['.id'].'">
								<label class="glyphicon glyphicon-ok"></label> <u>E</u>nable
							</a>';
						}else{
							echo '<a class="animated bounceInUp btn btn-warning btn-sm" href="StatusNat.php?opr=false&id='.$s['.id'].'">
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
	<div class="modal fade" id="modalUpdate" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<button type="button" class="animated rollIn btn btn-success btn-sm" data-toggle="modal" data-target="#modalNat">
		<u>A</u>dd Firewall Nat <label class="glyphicon glyphicon-plus"></label>
	</button>

	<div class="animated rollIn modal fade" id="modalNat" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Firewall NAT</h4>
				</div>
				<div class="modal-body">
					<form action="ProsessNat.php" method="POST" onsubmit="return validateForm()">
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-pencil"></label>
							</span>
							<select name="chain" class="form-control">
								<option>Chain</option>
								<option value="srcnat">srcnat</option>
								<option value="dstnat">dstnat</option>
							</select>
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-font"></label>
							</span>
							<select name="action" class="form-control">
								<option class="caret">Action</option>
								<option value="masquerade">Masquerade</option>
								<option value="accept">Accept</option>
								<option value="redirect">Redirect</option>
							</select>
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-compressed"></label>
							</span>
							<select name="out-interface" class="form-control">
								<option>Out-Interface</option>
								<?php
								$e->write('/interface/getall');
								$inter = $e->read();
								foreach ($inter as $row){
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
								<label class="glyphicon glyphicon-edit"></label>
							</span>
							<input placeholder="Comment" type="text" name="comment" class="form-control">
						</div><br/>
						<p>
							Disable :
							<input type="radio" name="disable" value="yes"> Yes
							<input type="radio" name="disable" value="no"> No
						</p>
						<button type="submit" name="save" class="btn btn-danger btn-sm">
							<u>A</u>dd <label class="glyphicon glyphicon-plus"></label>
						</button>
						<button type="reset" name="reset" class="btn btn-warning btn-sm">
							<u>R</u>eset <label class="glyphicon glyphicon-refresh"></label>
						</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">
						<label class="glyphicon glyphicon-remove"></label> Close
					</button>
				</div>
			</div>

		</div>
	</div>
</div>
</div>
<?php include "footer.php"; ?>
<script type="text/javascript">
	$(document).ready( function () {
		$('#table_eky').DataTable();
	} );
</script>