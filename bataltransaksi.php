<?php

include('koneksi.php');
session_start();
  if(isset($_GET['id_transaksi']))
  {
      $id=$_GET['id_transaksi'];

          $delete = mysqli_query($con,"DELETE FROM transaksi WHERE id='$id'");

          if($delete)
          {
            echo '<script type= "text/javascript">alert("Pembatalan Transaksi Sukses!");</script>';
            echo '<script type= "text/javascript">window.location.href = "historyuser.php";</script>';
          }

          else
          {
            echo '<script type= "text/javascript">alert("Pembatalan Transaksi Gagal!");</script>';
            echo '<script type= "text/javascript">window.location.href = "historyuser.php";</script>';
          }
      }

  else
  {
      echo '<script>window.history.back()</script>';
  }

?>
