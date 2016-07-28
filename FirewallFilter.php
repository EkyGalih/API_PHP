<?php
include "connect.php";

	//excute syntax mikrotik
$e->write('/ip/firewall/filter/getall');

		//read syntax
$user = $e->read();

include "navbar.php";

session_start();
?>
<div class="alert alert-default">
	<h4 class="animated bounceInLeft" align="center">DAFTAR FIREWALL FILTER</h4>
</div>
<div class="col-sm-12">
	<table class="animated bounceInRight table table-bordered table-hover table-striped dataTables" id="table_suru">
		<thead>
			<tr align="center">
				<td>NO.</td>
				<td>ID</td>
				<td>COMMENT</td>
				<td>CHAIN</td>
				<td>ACTION</td>
				<td>TARGET ADDRESS</td>
				<td>DISABLED</td>
				<td>ACTION</td>
			</tr>
		</thead>
		<?php $no = 1; foreach ($user as $eky) { ?>
		<tr>
			<td align='center'><?php echo $no ?></td>
			<td align='center'><?php echo $eky['.id'] ?></td>
			<td align="center"><?php echo $eky['comment'] ?></td>
			<td align="center"><?php echo $eky['chain'] ?></td>
			<td><?php echo $eky['action'] ?></td>
			<td align="center"><?php echo $eky['src-address'] ?></td>
			<td align="center"><?php echo $eky['disabled'] ?></td>
			<td align="center">
				<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSuru" href="UpdateFirewallFilter.php?id=<?php echo $eky['.id'] ?>">
					<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
				</a>
				<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteFirewallFilter.php?id=<?php echo $eky['.id'] ?>" onclick="return confirm('Firewall Must Deleted!\n\Are You sure?');">
					<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
				</a>
				<?php
				if ($eky['disabled'] == 'true') {
					echo '<a class="animated bounceInUp btn btn-success btn-sm" href="StatusFirewall.php?opr=true&id='.$eky['.id'].'">
					<label class="glyphicon glyphicon-ok"></label> <u>E</u>nable
				</a>';
			}else{
				echo '<a class="animated bounceInUp btn btn-warning btn-sm" href="StatusFirewall.php?opr=false&id='.$eky['.id'].'">
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
<div class="container">
	
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
					<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Firewall Filter</h4>
				</div>
				<div class="modal-body">
					<form name="frmuser" method="POST" action="AddFirewallFilter.php">
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-pencil"></label>
							</span>
							<input class="form-control" type="text" name="comment" placeholder="Firewall Name">
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-link"></label>
							</span>
							<select class="form-control" name="chain">
								<option>Chain</option>
								<option value="forward">Forward</option>
								<option value="input">Input</option>
								<option value="output">OutPut</option>
							</select>
						</div><br/>
						<div class="input-group">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-font"></label>
							</span>
							<select class="form-control" name="action">
								<option>Action</option>
								<option value="accept">Accept</option>
								<option value="drop">Drop</option>
								<option value="reject">Reject</option>
							</select>
						</div><br/>
						<p>
							Target Address :
							<input type="radio" name="srcAdd" value="yes" class="detail"> Yes
							<input type="radio" name="srcAdd" value="no" class="detail"> No
						</p>
						<div class="input-group" id="form-input2">
							<span class="input-group-addon">
								<label class="glyphicon glyphicon-screenshot"></label>
							</span>
							<input class="form-control" type="text" name="src-address" placeholder="0.0.0.0">
						</div><br/>
						<p>
							Address list :
							<input type="radio" name="addlist" value="yes" class="detail"> Yes
							<input type="radio" name="addlist" value="no" class="detail"> No
						</p>
						<div id="form-input" class="input-group">
							<span class="input-group-addon">Address List</span>
							<select class="form-control" name="address-list">
								<option>Address List</option>
								<?php
								$e->write('/ip/firewall/address-list/getall');

								$show = $e->read();

								foreach ($show as $r) {
									$list = $r['list'];
									?>
									<option value="<?php echo $r['list'] ?>"><?php echo $r['list'] ?></option>
									<?php
								}
								?>
							</select>
						</div><br/>
						<p>
							Disabled :
							<input type="radio" name="disable" value="yes"> Yes
							<input type="radio" name="disable" value="no"> No
						</p><br/>
						<button type="submit" name="submit" class="btn btn-danger btn-sm" >
							<u>S</u>end <i class="glyphicon glyphicon-send"></i>
						</button>
						<button type="reset" name="reset" class="btn btn-warning btn-sm"> <u>R</u>eset
							<i class="glyphicon glyphicon-refresh"></i>
						</button>
						<!-- <input class="btn waves-effect waves-light" type="submit" name="submit" value="Tambah"> <input type="reset" name="reset" value="Reset"> -->
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
</div>
</body>
<?php include "footer.php"; ?>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table_suru').DataTable();
	});
</script>
<script>
	$(document).ready(function(){
		$("#form-input").css("display","none"); 
		$(".detail").click(function(){ 
			if ($("input[name='addlist']:checked").val() == "yes" ) { 
				$("#form-input").slideDown("fast"); 
			} else {
				$("#form-input").slideUp("fast"); 
			}
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#form-input2").css("display","none"); 
		$(".detail").click(function(){ 
			if ($("input[name='srcAdd']:checked").val() == "yes" ) { 
				$("#form-input2").slideDown("fast"); 
			} else {
				$("#form-input2").slideUp("fast"); 
			}
		});
	});
</script>
</html>
