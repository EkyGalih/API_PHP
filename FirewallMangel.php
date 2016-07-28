<?php
include "connect.php";

	//mengeksekusi perintah mikrotik untuk menampilkan system user
$e->write('/ip/firewall/mangle/getall');

		//membaca hasil eksekusi perintah mikrotik
$mangle = $e->read();

include "navbar.php";

session_start();
?>
<div class="alert alert-default">
	<h4 class="animated bounceInLeft" align="center">DAFTAR FIREWALL MANGEL</h4>
</div>
<div class="col-sm-12">
	<table class="animated bounceInRight table table-bordered table-hover table-striped dataTables" id="table_suru">
		<thead>
			<tr align="center">
				<td>NO.</td>
				<td>ID</td>
				<td>CHAIN</td>
				<td>ACTION</td>
				<td>TARGET ADDRESS</td>
				<td>DISABLED</td>
				<td>COMMENT</td>
				<td>ACTION</td>
			</tr>
		</thead>
		<?php $no = 1; foreach ($mangle as $eky) { ?>
		<tr>
			<td align='center'><?php echo $no ?></td>
			<td align='center'><?php echo $eky['.id'] ?></td>
			<td align="center"><?php echo $eky['chain'] ?></td>
			<td align="center"><?php echo $eky['action'] ?></td>
			<td align="center"><?php echo $eky['src-address'] ?></td>
			<td align="center"><?php echo $eky['disabled'] ?></td>
			<td align="center"><?php echo $eky['comment'] ?></td>
			<td align="center">
				<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSuru" href="UpdateMangle.php?id=<?php echo $eky['.id'] ?>">
					<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
				</a>
				<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteMangle.php?id=<?php echo $eky['.id'] ?>" onclick="return confirm('Firewall Must Deleted!\n\Are You sure?');">
					<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
				</a>
				<?php
				if ($eky['disabled'] == 'true') {
					echo '<a class="animated bounceInUp btn btn-success btn-sm" href="StatusMangle.php?opr=true&id='.$eky['.id'].'">
					<label class="glyphicon glyphicon-ok"></label> <u>E</u>nable
				</a>';
			}else{
				echo '<a class="animated bounceInUp btn btn-warning btn-sm" href="StatusMangle.php?opr=false&id='.$eky['.id'].'">
				<label class="glyphicon glyphicon-remove"></label> <u>D</u>isable</a>';
			}
			?>
		</td>
	</tr>
	<?php
	$no++;
}
?>
</table>
<div class="modal fade" id="modalSuru" role="dialog">
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
</div>
<!-- Trigger the modal with a button -->
<button type="button" class="animated flip btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
	<u>A</u>dd Firewall <label class="glyphicon glyphicon-plus"></label>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Firewall Mangle</h4>
			</div>
			<div class="modal-body">
				<form name="mangle" action="ProsessMangle.php" method="POST" onsubmit="return validateForm()">
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-pencil"></label>
						</span>
						<input type="text" name="comment" class="form-control" placeholder="Comment">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-link"></label>
						</span>
						<select name="chain" class="form-control">
							<option>--Chain--</option>
							<option value="forward">Forward</option>
							<option value="input">Input</option>
							<option value="output">Output</option>
							<option value="prerouting">PreRouting</option>
							<option value="postrouting">PostRouting</option>
						</select>
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-font"></label>
						</span>
						<select name="action" class="form-control">
							<option>--Action--</option>
							<option value="accept">Accept</option>
							<option value="clear-df">Clear DF</option>
							<option value="log">Log</option>
							<option value="return">Return</option>
						</select>
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-road"></label>
						</span>
						<input type="text" name="src-address" class="form-control" placeholder="Target Address">
					</div><br/>
					<p>
						Disable :
						<input type="radio" name="disable" value="yes"> Yes
						<input type="radio" name="disable" value="no"> No
					</p><br/>
					<button type="submit" name="btnAdd" class="btn btn-danger btn-sm">
						<label class="glyphicon glyphicon-plus"></label> <u>A</u>dd
					</button>
					<button type="reset" name="reset" class="btn btn-warning btn-sm">
						<label class="glyphicon glyphicon-refresh"></label> <u>R</u>eset
					</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">
					<label class="glyphicon glyphicon-remove"></label> <u>C</u>lose
				</button>
			</div>
		</div>

	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table_suru').DataTable();
		} );
	</script>
	<?php include "footer.php"; ?>