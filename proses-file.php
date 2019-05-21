<?php
include("koneksi.php");
session_start();
$id=$_POST['printingid'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

if ($_FILES["fileToUpload"]["name"]!=null)
{
  if(!is_dir("uploaded_file/". $id)) {
      mkdir("uploaded_file/". $id);
  }
  $target_dir = "uploaded_file/" . $id ."/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $toobig = 0;
  $same = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  if ($uploadOk == 0 && $same==0 && $toobig==0) {
    echo '<script type= "text/javascript">alert("Maaf, file anda gagal diupload!");</script>';
    echo '<script type= "text/javascript">window.location.href = "step1.php"</script>';
  // if everything is ok, try to upload file
  }

  else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $nama = basename( $_FILES["fileToUpload"]["name"]);
        $link = $target_dir . rawurlencode($nama);
        echo '<script type= "text/javascript">alert("File telah tersimpan di database!");</script>';
        echo '<script type= "text/javascript">alert("'.$link.'");</script>';
        echo '<script type= "text/javascript">window.location.href = "nota.php?latitude='.$latitude.'&longitude='.$longitude.'&printingid='.$id.'&file='.$link.'"</script>';
      } else {
        echo '<script type= "text/javascript">alert("Foto profile gagal di update!");</script>';
        echo '<script type= "text/javascript">window.location.href = "step1.php"</script>';
      }
  }
}



?>
