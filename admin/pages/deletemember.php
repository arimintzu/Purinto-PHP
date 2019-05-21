<?php

include('../../koneksi.php');
session_start();
  if(isset($_GET['id_member']))
  {
      $id=$_GET['id_member'];

          $delete = mysqli_query($con,"DELETE FROM member WHERE user_id='$id'");

          if($delete)
          {
            echo '<script type= "text/javascript">alert("Hapus Member Sukses!");</script>';
            echo '<script type= "text/javascript">window.location.href = "membertable.php";</script>';
          }

          else
          {
            echo '<script type= "text/javascript">alert("Hapus Member Gagal!");</script>';
            echo '<script type= "text/javascript">window.location.href = "membertable.php";</script>';
          }
      }

  else
  {
      echo '<script>window.history.back()</script>';
  }

?>
