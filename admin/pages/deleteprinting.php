<?php

include('../../koneksi.php');
session_start();
  if(isset($_GET['id_printing']))
  {
      $id=$_GET['id_printing'];

          $delete = mysqli_query($con,"DELETE FROM printing WHERE id='$id'");

          if($delete)
          {
            echo '<script type= "text/javascript">alert("Hapus Printer Sukses!");</script>';
            echo '<script type= "text/javascript">window.location.href = "printingtable.php";</script>';
          }

          else
          {
            echo '<script type= "text/javascript">alert("Hapus Printer Gagal!");</script>';
            echo '<script type= "text/javascript">window.location.href = "printingtable.php";</script>';
          }
      }

  else
  {
      echo '<script>window.history.back()</script>';
  }

?>
