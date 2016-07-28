<?php
include "connect.php";

$e->write('/ip/firewall/address-list/getall');

$address = $e->read();

include "navbar.php";
?>
<h4 align="center" class="animated flipInX">Address List</h4><br/>
<!-- <div class="col-sm-"></div> -->
<div class="col-sm-12">
	<table class="animated zoomIn table table-hover table-striped dataTables table-bordered" id="table_suru">
		<thead>
			<tr align="center">
				<td>NO.</td>
				<td>ID</td>
				<td>Name</td>
				<td>Address</td>
				<td>Disabled</td>
				<td>Comment</td>
				<td>Action</td>
			</tr>
		</thead>
		<?php $no=1; foreach ($address as $eky) { ?>
		<tr>
			<td align="center"><?php echo $no ?></td>
			<td align="center"><?php echo $eky['.id'] ?></td>
			<td align="center"><?php echo $eky['list'] ?></td>
			<td align="center"><?php echo $eky['address'] ?></td>
			<td align="center"><?php echo $eky['disabled'] ?></td>
			<td align="center"><?php echo $eky['comment'] ?></td>
			<td align="center">
				<a class="animated bounceInUp btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddLst" href="UpdateAddList.php?id=<?php echo $eky['.id'] ?>">
					<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
				</a>
				<a class="animated bounceInDown btn btn-danger btn-sm" href="DeleteAddList.php?id=<?php echo $eky['.id'] ?>" onclick="return confirm('AddressList Must Deleted!\n\Are You Sure?);">
					<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
				</a>
				<?php
				if ($eky['disabled'] == 'true') {
					echo '<a class="animated bounceInLeft btn btn-success btn-sm" href="StatusAddList.php?opr=true&id='.$eky['.id'].'">
					<label class="glyphicon glyphicon-ok-sign"></label> <u>E</u>nable
				</a>';
			}else{
				echo '<a class="animated bounceInRight btn btn-warning btn-sm" href="StatusAddList.php?opr=false&id='.$eky['.id'].'">
				<label class="glyphicon glyphicon-remove-sign"></label> <u>D</u>isable
			</a>';
		}
		?>
	</td>
</tr>
<?php
$no++;
}
?>
</table>
</div>
<div class="modal fade" id="modalAddLst" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Address List </h4>
			</div>
        <!-- <div class="modal-body">
          
    </div> -->
    <div class="modal-footer">
    	<button type="button" class="btn btn-default" data-dismiss="modal"><u>C</u>lose</button>
    </div>
</div>
</div>
</div>
<button type="button" class="animated bounceInUp btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddressList">
	<u>A</u>dd Address List <label class="glyphicon glyphicon-plus"></label>
</button>

<div class="animated bounceInRight modal fade" id="modalAddressList" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><label class="glyphicon glyphicon-plus"></label> Add Address List</h4>
			</div>

			<div class="modal-body">
				<form name="addlist" action="ProccessAddList.php" method="POST">
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-pencil"></label>
						</span>
						<input type="text" class="form-control" name="list" placeholder="name">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-road"></label>
						</span>
						<input type="text" class="form-control" name="address" placeholder="0.0.0.0 (Address)">
					</div><br/>
					<div class="input-group">
						<span class="input-group-addon">
							<label class="glyphicon glyphicon-edit"></label>
						</span>
						<input type="text" name="comment" class="form-control" placeholder="Comment">
					</div><br/>
					<!-- <p>
						<b>Dynamic :</b><br/>
						<input type="radio" name="dynamic" value="yes" class="detail"> Yes
						<input type="radio" name="dynamic" value="no" class="detail"> No
					</p> -->
					<p>
						<div>
							<b>Disabled :</b><br/>
							<input type="radio" name="disabled" value="yes"> Yes
							<input type="radio" name="disabled" value="no"> No
						</p>
					</div>
					<button type="submit" name="submit" class="btn btn-danger btn-sm">
						<u>S</u>end <label class="glyphicon glyphicon-send"></label>
					</button>
					<button type="reset" name="reset" class="btn btn-danger btn-sm">
						<u>R</u>eset <label class="glyphicon glyphicon-refresh"></label>
					</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">
					<u>C</u>lose <label class="glyphicon glyphicon-remove"></label>
				</button>
			</div>
		</div>

	</div>
</div>
</div>
<?php include "footer.php"; ?>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/DataTables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#table_suru').DataTable();
	} );
</script>
<script>
	$(document).ready(function(){
		$("#form-input").css("display","none"); 
		$(".detail").click(function(){ 
			if ($("input[name='dynamic']:checked").val() == "no" ) { 
				$("#form-input").slideDown("fast"); 
			} else {
				$("#form-input").slideUp("fast"); 
			}
		});
	});
</script>