<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['id'])){
$id = $_GET['user_id'];
$sql = 'SELECT * FROM member WHERE user_id= "'.$id.'"' ;
$cek = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($cek);

$myDateTime = DateTime::createFromFormat('Y-m-d', $row['join_date']);
$joinDate = $myDateTime->format('d M Y');
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>PrintAnywhere</title>
  <meta name="author" content="Mintzu">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

  <!-- SCRIPT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="slider/jquery.min.js"></script>
  <script src="slider/bootstrap.min.js"></script>
  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" href="favicon.ico">
  <link href="css/login-register.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/fontstyle.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/agency.css" rel="stylesheet">
  <link rel="stylesheet" href="css/profile.css">

  <link rel="stylesheet" href="css/testimonial.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="css/footer.css">

  <!-- UPLOAD PURPOSES -->
  <link href="bs_upload/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="bs_upload/piexif.min.js" type="text/javascript"></script>

  <style>
  .fa-eye:before {
    position: relative;
    top: 10px;
    left: 50%;
    float: right;
    display: block;
    text-align: right;
  }

  #lul:hover {
    text-decoration:none;
  }
  </style>

</head>

<body id="top" onload="getLocation()">

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container-fluid">
        <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a> -->
        <div class="navbar-brand js-scroll-trigger" id="picture-one">
            <a href="index.php"><img src="img/print_top.png" style="width:150px"></a>
        </div>
        <div class="navbar-brand js-scroll-trigger hide" id="picture-two">
            <a href="index.php"><img src="img/print_top.png" style="width: 140px;"></a>
        </div>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php#tentang">Tentang</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#kontak">Kontak</a>
            </li>
            <?php if(isset($_SESSION['id'])){
              $sqlKanan = 'SELECT * FROM member WHERE user_id= "'.$_SESSION['id'].'"' ;
              $cekKanan = mysqli_query($con, $sqlKanan);
              $rowKanan = mysqli_fetch_assoc($cekKanan);?>
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle js-scroll-trigger" href="#" id="navbarDropdown"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-alt"></i>&nbsp;<?php echo $rowKanan['nama']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="myprofile.php?user_id=<?php echo $_SESSION['id'];?>">Profile Saya</a>
                  <a class="dropdown-item" href="member.php">Member Area</a>
                  <a class="dropdown-item" href="logout.php">Keluar</a>
                </div>
              </li>
            <?php }else{ ?>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="sign.php"><i class="fas fa-user-alt"></i>&nbsp;Gabung</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>


  <section id="login" >
    <div class="container">
      <div class="main" style="font-family:'Muli', sans-serif; margin-top:0px;
                              border:2px solid #2660a4; box-shadow: 0 0 2px 0px; border-radius:25px">
        <div class="header" style="padding-bottom:0px">
          <h1 style="font-size: 50px;
    font-family: 'DoHyeon';
    padding-bottom: 0px;
    margin-bottom: 0px;
    text-transform:uppercase;
    letter-spacing:1px">#PROFILE OF <?php echo $row['username'];?></h1>
        </div>
        <br/>

        <div class="row">
          <div class="col-4">
            <center>
              <button class="btnChoose" type="button" name="button" id="goPhoto" onclick="goEditPhoto()">EDIT FOTO</button>
            </center>
          </div>

          <div class="col-4">
            <center>
              <button class="btnChoose" type="button" name="button" id="goPass" onclick="goEditPass()">EDIT PASSWORD</button>
            </center>
          </div>

          <div class="col-4">
            <center>
              <button class="btnChoose" type="button" name="button" id="goData" onclick="goEditData()">EDIT INFORMASI</button>
            </center>
          </div>
        </div>
        <p style="margin-top:0px; padding-top:0px"></p>

          <form action="proses-profile.php" method="post" enctype="multipart/form-data">
            <input type="text" name="id" value="<?php echo $id;?>" hidden>
            <input type="text" name="latitude" id="latitude" hidden>
            <input type="text" name="longitude" id="longitude" hidden>
            <ul class="left-form">
                <img src="<?php echo $row['profile_picture'];?>" style="width:250px; height:250px; border-radius:25%; margin-top:17%">
                <br/>

                <li>
                  <?php if($row['company_id']!=null) {
                    $company_id = $row['company_id'];
                    $queryTransaksi = "SELECT * FROM transaksi WHERE printing_id = '$company_id' AND status=0";
                    $cekTransaksi = mysqli_query($con, $queryTransaksi);
                    $numrows = mysqli_num_rows($cekTransaksi);
                    ?>
                  <center>
                    <a href="infojasa.php">
                      <h2 style="float:none; text-align:center; color:green; font-style:italic">Lihat Jasa Saya&nbsp;
                        <?php if($numrows>0) {?> <span class="badge badge-success"><?php echo $numrows; ?></span> <?php } ?>
                      </h2>
                    </a>
                  </center>
                <?php }

                else {

                 ?>
                   <center>
                     <h2 style="float:none; text-align:center; margin-bottom:0px; color:red; font-style:italic">Daftarkan diri anda sebagai jasa printing</h2>
                     <input style="margin-top:10px;"type="submit" value="Daftarkan Diri" name="fileToUpload" id="goJasa" onclick="goDaftar()">
                   </center>
                 <?php } ?>
                </li>

                <li>
                  <center>
                    <a href="historyuser.php">
                      <h2 style="float:none; text-align:center; color:green; font-style:italic">History Penggunaan Jasa di Purinto</h2>
                    </a>
                  </center>
                </li>
            </ul>


            <ul class="right-form">

              <center hidden id="fileToUploadField">
                <br/>
                  <input name="fileToUpload" id="fileToUpload" type="file" class="file"value="Update File"/>
                <br/>
              </center>

              <div hidden id="fieldPassword">
                <h3>Password Lama</h3>
                <li>

                  <input type="password" name="pass_lama" id="pass_lama" placeholder="Password Lama" required/>
                  <div class="clear"> </div>
                </li>

                <h3>Password Baru</h3>
                <li>

                  <input type="password" name="pass_baru" id="pass_baru" placeholder="Password Baru" required/>
                  <div class="clear"> </div>
                </li>

                <h3>Konfirmasi Password Baru</h3>
                <li>

                  <input type="password" name="conf_pass"  id="conf_pass" placeholder="Konfirmasi Password" required>

                  <!-- itu error -->
                  <div class="clear"> </div>
                </li>
              </div>
                <br/>
                <input type="submit" value="Update Password" name="fileToUpload" id="updatePass" hidden>

              <div class="clear"> </div>

              <div id="fieldInfo">
                <h3>Nama</h3>
                <div>
                  <li><input type="text" name="name" id="username" placeholder="Nama" required disabled value="<?php echo $row['nama']; ?>"/></li>
                </div>

                <h3>Email</h3>
                <div>
                  <li><input type="text" name="email" id="email" placeholder="Email" required disabled value="<?php echo $row['email']; ?>"/></li>
                </div>

                <h3>Nomor Telepon</h3>
                <div>
                  <li><input type="text" name="telp" id="telp" placeholder="+628xxxxxx" required disabled value="<?php echo $row['telp']; ?>"/></li>
                </div>

                <h3 style="font-style:italic">Bergabung pada <?php echo $joinDate; ?></h3>
                <div class="clear"> </div>
              </div>


              <div>
                <br/><input type="submit" id="updateData" value="Update Informasi" name="fileToUpload" hidden>
              </div>
              <div class="clear"> </div>
            </ul>
            <div class="clear"> </div>

          </form>
        </div>
    </div>
  </section>

<footer class="footer-distributed" id="kontak" style="border-top:5px solid #2660a4">
  <div class="container-fluid">
    <div class="row">
      <div class="footer-left">

    		<img src="img/print_top.png" style="width: 180px; margin:0px; margin-bottom:10px">

    		<p class="footer-company-name" style="font-style:italic; font-weight:bolder">PURINTO &copy; 2018</p>
    	</div>

    	<div class="footer-center">

    		<div>
          <i class="fas fa-map-marker-alt"></i>
    			<p><span>Jl. Babarsari </span> Indonesia</p>
    		</div>

    		<div>
          <i class="fas fa-phone"></i>
          <p>+6281225442133</p>
    		</div>

    		<div>
          <i class="far fa-envelope"></i>
    			<p><a href="mailto:admin.purinto@gmail.com">admin.purinto@gmail.com</a></p>
    		</div>

    	</div>

    	<div class="footer-right">

    		<p class="footer-company-about">
    			<span>Tentang Purinto</span>
    			Purinto adalah company independent yang bertujuan meningkatkan efisiensi
          waktu pada soal nge-print dadakan.
    		</p>

    		<div class="footer-icons">
    			<a href="#"><i class="fab fa-instagram"></i></a>
    			<a href="#"><i class="fab fa-line"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
    		</div>

    	</div>
    </div>

    <br/><br/>
    <center>
      <h4 id="footertitle">UNIVERSITAS ATMA JAYA YOGYAKARTA</h4>
    </center>
  </div>


</footer>

  <script type="text/javascript">
  var lt = document.getElementById("latitude");
  var lng = document.getElementById("longitude");
  function showLatitude(position) {
      lt.value= position.coords.latitude;
      //alert(lt.value);
  }

  function showLongitude(position) {
      lng.value = position.coords.longitude;
      //alert(lng.value);
  }

  function getLocation() {
        if (navigator.geolocation) {
            //alert("MASUK PAK EKO");
            navigator.geolocation.getCurrentPosition(showLatitude);
            navigator.geolocation.getCurrentPosition(showLongitude);
            //document.getElementById("nextstep").disabled = false;
            //document.getElementById("btnCari").style.display = "none";
            //p.innerHTML = "Lokasi ditemukan!";
        } else {
            //lt.innerHTML = "Geolocation is not supported by this browser.";
        }
  }

  function goDaftar() {
    document.getElementById('goData').style.backgroundColor = '#2660a4';
    document.getElementById('goData').style.color = '#FFFFFF';
    document.getElementById('goPhoto').style.backgroundColor = '#F3F3F3';
    document.getElementById('goPhoto').style.color = '#4D4949';
    document.getElementById('goPass').style.backgroundColor = '#F3F3F3';
    document.getElementById('goPass').style.color = '#4D4949';
    document.getElementById("username").disabled=true;
    document.getElementById("email").disabled=true;
    document.getElementById("telp").disabled=true;
    document.getElementById("fieldInfo").hidden=true;
    document.getElementById("updateData").hidden=true;
    document.getElementById("fileToUploadField").hidden=true;
    document.getElementById("updatePass").hidden=true;
    document.getElementById("fieldPassword").hidden=true;

    //required
    document.getElementById("username").required=false;
    document.getElementById("email").required=false;
    document.getElementById("telp").required=false;
    document.getElementById("pass_lama").required=false;
    document.getElementById("pass_baru").required=false;
    document.getElementById("conf_pass").required=false;

  }
    function goEditData() {
      document.getElementById('goData').style.backgroundColor = '#2660a4';
      document.getElementById('goData').style.color = '#FFFFFF';
      document.getElementById('goPhoto').style.backgroundColor = '#F3F3F3';
      document.getElementById('goPhoto').style.color = '#4D4949';
      document.getElementById('goPass').style.backgroundColor = '#F3F3F3';
      document.getElementById('goPass').style.color = '#4D4949';
      document.getElementById("username").disabled=false;
      document.getElementById("email").disabled=false;
      document.getElementById("telp").disabled=false;
      document.getElementById("fieldInfo").hidden=false;
      document.getElementById("updateData").hidden=false;
      document.getElementById("fileToUploadField").hidden=true;
      document.getElementById("updatePass").hidden=true;
      document.getElementById("fieldPassword").hidden=true;

      //required
      document.getElementById("username").required=true;
      document.getElementById("email").required=true;
      document.getElementById("telp").required=true;
      document.getElementById("pass_lama").required=false;
      document.getElementById("pass_baru").required=false;
      document.getElementById("conf_pass").required=false;
    }

    function goEditPhoto() {
      document.getElementById('goData').style.backgroundColor = '#F3F3F3';
      document.getElementById('goData').style.color = '#4D4949';
      document.getElementById('goPhoto').style.backgroundColor = '#2660a4';
      document.getElementById('goPhoto').style.color = '#FFFFFF';
      document.getElementById('goPass').style.backgroundColor = '#F3F3F3';
      document.getElementById('goPass').style.color = '#4D4949';
      document.getElementById("username").disabled=true;
      document.getElementById("email").disabled=true;
      document.getElementById("telp").disabled=true;
      document.getElementById("fieldInfo").hidden=true;
      document.getElementById("updateData").hidden=true;
      document.getElementById("fileToUploadField").hidden=false;
      document.getElementById("updatePass").hidden=true;
      document.getElementById("fieldPassword").hidden=true;
      //required
      document.getElementById("username").required=false;
      document.getElementById("email").required=false;
      document.getElementById("telp").required=false;
      document.getElementById("pass_lama").required=false;
      document.getElementById("pass_baru").required=false;
      document.getElementById("conf_pass").required=false;
    }

    function goEditPass() {
      document.getElementById('goData').style.backgroundColor = '#F3F3F3';
      document.getElementById('goData').style.color = '#4D4949';
      document.getElementById('goPhoto').style.backgroundColor = '#F3F3F3';
      document.getElementById('goPhoto').style.color = '#4D4949';
      document.getElementById('goPass').style.backgroundColor = '#2660a4';
      document.getElementById('goPass').style.color = '#FFFFFF';
      document.getElementById("username").disabled=true;
      document.getElementById("email").disabled=true;
      document.getElementById("telp").disabled=true;
      document.getElementById("fieldInfo").hidden=true;
      document.getElementById("updateData").hidden=true;
      document.getElementById("fileToUploadField").hidden=true;
      document.getElementById("updatePass").hidden=false;
      document.getElementById("fieldPassword").hidden=false;
      //required
      document.getElementById("username").required=false;
      document.getElementById("email").required=false;
      document.getElementById("telp").required=false;
      document.getElementById("pass_lama").required=true;
      document.getElementById("pass_baru").required=true;
      document.getElementById("conf_pass").required=true;
    }

  </script>


  <script src="bs_upload/sortable.min.js" type="text/javascript"></script>
  <script src="bs_upload/purify.min.js" type="text/javascript"></script>
  <script src="bs_upload/popper.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script> -->
  <script src="bs_upload/fileinput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/locales/LANG.js"></script>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/agency.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/scrollreveal.min.js"></script>

</body>


  <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

</html>
<?php }

  else {
    header("location:index.php");
  }
 ?>
