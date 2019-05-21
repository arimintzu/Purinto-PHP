<?php
  include('koneksi.php');
  $username = $_POST['username'];

  $sql = "SELECT * FROM member WHERE username = '$username'";
  $cek = mysqli_query($con, $sql);
  $numrows = mysqli_num_rows($cek);

  echo $numrows;

 ?>
