<?php
include("koneksi.php");
$id=$_POST['id'];
if ($_FILES["fileToUpload"]["name"]!=null)
{

  if(!is_dir("profile_pic/". $id ."/")) {
      mkdir("profile_pic/". $id ."/");
  }
  $target_dir = "profile_pic/" . $id ."/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $nama = basename( $_FILES["fileToUpload"]["name"]);
    $link = $target_dir . rawurlencode($nama);
    $masukkan = mysqli_query($con, "UPDATE member SET profile_picture='$link'") or die(mysqli_error());
    if($masukkan)
    {
      echo '<script type= "text/javascript">alert("Foto profile telah di update!");</script>';
      echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
    }
    else
    {
      echo '<script type= "text/javascript">alert("Foto profile gagal di update!");</script>';
      echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
    }

  } else {
    echo '<script type= "text/javascript">alert("Foto profile gagal di update!");</script>';
    echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
  }
}

else if ($_POST['fileToUpload'] == 'Daftarkan Diri') {
  $latitude = $_POST['latitude'];
  $longitude = $_POST['longitude'];
  echo '<script type= "text/javascript">
  window.location.href = "companysign.php?user_id='.$id.'&latitude='.$latitude.'&longitude='.$longitude.'";</script>';
}

else if ($_POST['fileToUpload'] == 'Update Password') {
  $getPassword = "SELECT * from member WHERE user_id='$id'";
  $cekDatabase = mysqli_query($con, $getPassword);
  $row = mysqli_fetch_assoc($cekDatabase);
  $passwordlama = $row['password'];
  $inputPasswordlama = $_POST['pass_lama'];
  $passwordbaru_dec = $_POST['pass_baru'];
  $passwordbaru_conf_dec = $_POST['conf_pass'];
  if (md5($inputPasswordlama)!=$passwordlama) {
    echo '<script type= "text/javascript">alert("Password lama anda salah!");</script>';
    echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
  }

  else {
    if ($passwordbaru_dec != $passwordbaru_conf_dec) {
      echo '<script type= "text/javascript">alert("Konfirmasi password tidak sama!");</script>';
      echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
    }

    else {
      $passwordhashed = md5($passwordbaru_dec);
      $sql = "UPDATE member SET password='$passwordhashed' WHERE user_id='$id'" ;
      $cek = mysqli_query($con, $sql);
      if($cek)
      {
        echo '<script type= "text/javascript">alert("Update Password Sukses!");</script>';
        echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
      }
      else
      {
        echo '<script type= "text/javascript">alert("Update Password Gagal!");</script>';
        echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
      }
    }
  }

}

else if ($_POST['fileToUpload'] == 'Update Informasi') {
  $nama = $_POST['name'];
  $email = $_POST['email'];
  $telp = $_POST['telp'];
  $sql = "UPDATE member SET nama='$nama', email='$email', telp='$telp' WHERE user_id='$id'" ;
  $cek = mysqli_query($con, $sql);
  if($cek)
  {
    echo '<script type= "text/javascript">alert("Update Informasi Sukses!");</script>';
    echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
  }
  else
  {
    echo '<script type= "text/javascript">alert("Update Informasi Gagal!");</script>';
    echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
  }
}
?>
