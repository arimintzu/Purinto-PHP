<?php

include('../../koneksi.php');
session_start();
  if(isset($_GET['id_transaksi']))
  {
      $id=$_GET['id_transaksi'];

          $delete = mysqli_query($con,"DELETE FROM transaksi WHERE id='$id'");

          if($delete)
          {
            echo '<script type= "text/javascript">alert("Hapus Transaksi Sukses!");</script>';
            echo '<script type= "text/javascript">window.location.href = "transaksitable.php";</script>';
          }

          else
          {
            echo '<script type= "text/javascript">alert("Hapus Transaksi Gagal!");</script>';
            echo '<script type= "text/javascript">window.location.href = "transaksitable.php";</script>';
          }
      }

  else
  {
      echo '<script>window.history.back()</script>';
  }

?>
