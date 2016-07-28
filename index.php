<title>Login Page</title>
<link rel="shortcut icon" href="assets/images/mikrotik-logo.png">
<?php
include "css.php";
// include "connect.php";
?>
<br/><br/><br/>
<div class="col-sm-4"></div>
<div class="col-sm-4">
	<div class="animated bounceInRight panel panel-danger">
		<div class="panel-heading">
			<h4><label class="glyphicon glyphicon-log-in"></label> Login Form</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" action="connect.php" method="POST" onsubmit="return validateForm()">
				<div class="input-group">
					<span class="input-group-addon">
						<label class="glyphicon glyphicon-cloud-upload"></label>
					</span>
					<input type="text" name="hostname" class="form-control" placeholder="Hostname" required>
				</div><br/>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="glyphicon glyphicon-user"></label>
					</span>
					<input type="text" name="username" class="form-control" placeholder="Username" required>
				</div><br/>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="glyphicon glyphicon-lock"></label>
					</span>	
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div><br/>
				<button type="submit" name="btnlogin" class="btn btn-danger btn-sm">
					Login <label class="glyphicon glyphicon-send"></label>
				</button>
				<button type="reset" name="reset" class="btn btn-warning btn-sm">
					Reset <label class="glyphicon glyphicon-refresh"></label>
				</button>
			</form>
		</div>
	</div>
</div>