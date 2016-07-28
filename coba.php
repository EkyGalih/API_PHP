<?php
 if (isset($_POST['submit'])){
  $policy = $_POST['policy'];
  // print_r($policy);
  $data = implode(",",$policy);
  echo $data;
 }
  //  $string = array('a','b','c');
  // $data= implode(",",$string);
  // echo $data;
?>
<pre>
<form action="coba.php" method="POST">
  <input type="checkbox" name="policy[]" value="read"> Read
  <input type="checkbox" name="policy[]" value="write"> write
  <input type="checkbox" name="policy[]" value="reboot"> Reboot
  <input type="checkbox" name="policy[]" value="sniff"> sniff
  <input type="submit" name="submit">
</form>
</pre>