<?php

include('koneksi.php');
session_start();
  if(isset($_GET['id_transaksi']))
  {
      $id=$_GET['id_transaksi'];

          $delete = mysqli_query($con,"UPDATE transaksi SET deleted_at_by_printing=CURDATE() WHERE id='$id'");

          if($delete)
          {
            echo '<script type= "text/javascript">alert("Hapus History Transaksi Sukses!");</script>';
            echo '<script type= "text/javascript">window.location.href = "infojasa.php";</script>';
          }

          else
          {
            echo '<script type= "text/javascript">alert("Hapus History Transaksi Gagal!");</script>';
            echo '<script type= "text/javascript">window.location.href = "infojasa.php";</script>';
          }
      }

  else
  {
      echo '<script>window.history.back()</script>';
  }

?>
