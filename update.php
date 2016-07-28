<?php
ob_start();
// include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
	if (isset($_POST['submit'])) {
		//mengambil inputan
		$id = $_POST['id'];
		$name = $_POST['name'];
		$group = $_POST['group'];
		$sandi = $_POST['password'];
		$resandi = $_POST['repassword'];
		$disabled = $_POST['disable'];
		$comment = $_POST['comment'];
		//menampilkan ke layar
		echo "Name : $name <br/>";
		echo "Group : $group <br/>";
		echo "Sandi : $sandi <br/>";
		echo "Disabled : $disabled <br/>";
		echo "comment : $comment <br/>";
		//menyisipkan file koneksi
		include "connect.php";
		//mengeksekusi perintah mikrotik
		$e->write('/user/set', false);
		$e->write('=name='.$name, false);
		$e->write('=group='.$group, false);
		$e->write('=password='.$sandi, false);
		$e->write('=disabled='.$disabled, false);
		$e->write('=comment='.$comment, false);
		$e->write('=.id='.$id);
			//membaca hasil eksekusi perintah
		$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
		echo "Data user berhasil diubah";
		header("location: show_user.php");
	}else{
		// mengambil data sebelumnya
		include "connect.php";
		// mengambil nilai parameter id dari querysrting
		$id = $_GET['id'];
		//mengeksekusi perintah mikrotik
		$e->write('/user/print',false);
		$e->write('=.proplist=name',false);
		$e->write('=.proplist=group',false);
		$e->write('=.proplist=disabled',false);
		$e->write('=.proplist=comment',false);
		$e->write('?.id='.$id);
		//membaca hasil eksekusi
		$user = $e->read();
		//menampilkan ke layar
		foreach ($user as $row) {
			$name = $row['name'];
			$group = $row['group'];
			$disabled = $row['disabled'];
			$comment = $row['comment'];
		}
	}
?>
<pre>
<form name="frmuser" method="POST" action="update.php">
Name : <input type="text" name="name" value="<?php if (isset($name)){echo $name; } ?>">
Group :<select name="group">
<option value="read" <?php if (isset($group) && $group=='read') { echo "selected"; } ?>>Read</option>
<option value="write" <?php if (isset($group) && $group=='write') { echo "selected"; } ?>>Write</option>
<option value="full" <?php if (isset($group) && $group=='full') { echo "selected"; } ?>>Full</option>
</select>
Password : <input type="password" name="password">
Re-type Password : <input type="password" name="repassword">
comment : <input type="text" name="comment" value="<?php if (isset($name)){echo $comment; } ?>">
Disable : <input type="radio" name="disable" value="yes" <?php if(isset($disabled) && $disabled=='true') { echo "checked"; } ?>> Yes <input type="radio" name="disable" value="no" <?php if(isset($disabled) && $disabled=='false') { echo "checked"; } ?>> No
<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; } ?>">

<input type="submit" name="submit" value="Update"> <input type="reset" name="reset" value="Reset">
</form>
</pre>
<?php 
ob_end_flush();
?>