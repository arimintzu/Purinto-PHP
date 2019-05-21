<?php
include("koneksi.php");
  $user_id = $_GET['user_id'];

  $query = "UPDATE member SET verified=1 WHERE user_id = '$user_id'";
  $sql = mysqli_query($con, $query);

  if($sql)
  {
    echo '<script type= "text/javascript">window.location.href = "akunverified.html";</script>';
  }
  else
  {
    echo '<script type= "text/javascript">alert("Verifikasi gagal!");</script>';
    echo '<script type= "text/javascript">window.location.href = "index.php";</script>';
  }

?>
