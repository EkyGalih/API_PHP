<?php
include "navbar.php";
	//mengecek apakah terjadi penekanan tombol submit
	if (isset($_POST['submit'])) {
		//mengambil inputan
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
		$e->write('/user/add', false);
		$e->write('=name='.$name, false);
		$e->write('=group='.$group, false);
		$e->write('=password='.$sandi, false);
		$e->write('=disabled='.$disabled, false);
		$e->write('=comment='.$comment);
			//membaca hasil eksekusi perintah
		$e->read();
		//menampilkan pesan setelah berhasil eksekusi perintah
		echo "Data user berhasil ditambahkan";
		echo "<a href=show_user.php>kembali ke home</a>";
	}
?>
<pre>
<form name="frmuser" method="POST" action="">
Name : <input type="text" name="name">
Group :<select name="group">
<option value="read">Read</option>
<option value="write">Write</option>
<option value="full">Full</option>
</select>
Password : <input type="password" name="password">
Re-type Password : <input type="password" name="repassword">
comment : <input type="text" name="comment">
Disable : <input type="radio" name="disable" value="yes"> Yes <input type="radio" name="disable" value="no"> No

<input type="submit" name="submit" value="Tambah"> <input type="reset" name="reset" value="Reset">
</form>
</pre>