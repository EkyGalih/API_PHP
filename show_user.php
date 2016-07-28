<?php
include "connect.php";

	//mengeksekusi perintah mikrotik untuk menampilkan system user
$e->write('/user/getall');

		//membaca hasil eksekusi perintah mikrotik
$user = $e->read();

include "navbar.php";
?>
	<div class="alert alert-default">
		<h4 align="center" class="animated rubberBand">DAFTAR USER MIKROTIK</h4>
	</div>
	<div class="col-sm-12">
		<table class="animated pulse table dataTables table-bordered table-hovertable-striped" id="table_eky" role="grid">
			<thead>
				<tr align="center">
					<td>NO.</td>
					<td>ID USER</td>
					<td>NAME</td>
					<td>GROUP</td>
					<td>COMMENT</td>
					<td>DISABLED</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<?php $no = 1; foreach ($user as $eky) { ?>
				<tr>
					<td align='center'><?php echo $no ?></td>
					<td align='center'><?php echo $eky['.id'] ?></td>
					<td><?php echo $eky['name'] ?></td>
					<td align="center"><?php echo $eky['group'] ?></td>
					<td><?php echo $eky['comment'] ?></td>
					<td align="center"><?php echo $eky['disabled'] ?></td>
					<td align="center">
						<a class="animated bounceInDown btn btn-primary btn-sm" href="update.php?id=<?php echo $eky['.id'] ?>">
							<label class="glyphicon glyphicon-edit"></label> <u>U</u>pdate
						</a> |
						<a class="animated zoomInUp btn btn-danger btn-sm" href="delete.php?id=<?php echo $eky['.id'] ?>">
							<label class="glyphicon glyphicon-trash"></label> <u>D</u>elete
						</a> |
						<?php
							if ($eky['disabled'] == 'true') {
								echo '<a class="animated bounceInLeft btn btn-success btn-sm" href="status.php?opr=true&id='.$eky['.id'].'">
								<label class="glyphicon glyphicon-ok-sign"></label> <u>E</u>nable
								</a>';
							}else{
								echo '<a class="animated bounceInRight btn btn-warning btn-sm" href="status.php?opr=false&id='.$eky['.id'].'">
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
		<a href="add_user.php" class="animated rollIn btn btn-danger btn-sm">
			<label class=" glyphicon glyphicon-plus"></label> <u>A</u>dd User
		</a>
	</div>
</body>
<?php include "footer.php"; ?>
<script type="text/javascript">
	$(document).ready( function () {
    $('#table_eky').DataTable();
} );
</script>
</html>
