<?php
include("koneksi.php");
session_start();
$id = $_GET['user_id'];
$sqlData = "SELECT * FROM member WHERE user_id='$id'" ;
$cekData = mysqli_query($con, $sqlData);
$rowData = mysqli_fetch_assoc($cekData);
if($rowData['company_id']!=null) {
  echo '<script type= "text/javascript">alert("Anda telah mendaftarkan jasa sebelumnya!\n");</script>';
  echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
}

else if($_GET['latitude']=="" || $_GET['longitude']=="") {
  echo '<script type= "text/javascript">alert("Aktifkan lokasi anda!\n");</script>';
  echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
}

else {
  if(isset($_POST['daftar']))
  {
      //echo '<script type= "text/javascript">alert("Aktifkan lokasi anda3!\n");</script>';
      $nama = $_POST['jasa_nama'];
      $tagline = $_POST['jasa_tagline'];
      $latitude = $_GET['latitude'];
      $longitude = $_GET['longitude'];

      $input = mysqli_query($con,"INSERT INTO printing VALUES(null, '$nama',
          '$tagline', '$latitude', '$longitude', 0, 0, CURDATE() )");
        
    	if($input)
    	{
    	    //echo '<script type= "text/javascript">alert("Aktifkan lokasi andaasdasdasd3!\n");</script>';
            $last = mysqli_insert_id($con);
            $sql = "UPDATE member SET company_id='$last' WHERE user_id='$id'" ;
            $cek = mysqli_query($con, $sql);
            echo '<script type= "text/javascript">alert("Pendaftaran Jasa Berhasil!\n");</script>';
            echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$id.'";</script>';
            
    	}
    	else
    	{
    		echo '<script type= "text/javascript">alert("Register Gagal");</script>';
    	}
    }


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

  <link rel="stylesheet" href="css/testimonial.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="css/footer.css">
</head>

<body id="top" >

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container-fluid">
        <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a> -->
        <div class="navbar-brand js-scroll-trigger" id="picture-one">
            <a href="index.html"><img src="img/print_top.png" style="width:150px"></a>
        </div>
        <div class="navbar-brand js-scroll-trigger hide" id="picture-two">
            <a href="index.html"><img src="img/print_top.png" style="width: 140px;"></a>
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
                              border:3px solid #2660a4; box-shadow: 0 0 2px 0px; border-radius:25px">
        <div class="header" >
          <h1>Buka Jasa Print dan Bantulah Sesama!</h1>
        </div>
        <p></p>
          <form action="" method="post">
            <center>
              <ul class="left-form" style="float:none">
                <h2>Hi, <?php echo $rowData['nama']; ?></h2>
                <h2 style="color:red; font-style:italic">Silahkan lengkapi data dibawah ini</h2>

                <li></li>
                  <h3 style="    font-size: 16px;
    margin-bottom: 5px;">Nama Jasa</h3>
                  <li>
                    <input type="text" name="jasa_nama" id="jasa_nama" placeholder="ex : <?php echo $rowData['nama']; ?> Company" required/>
                    <div class="clear"> </div>
                  </li>
                  <br/>

                  <h3 style="    font-size: 16px;
    margin-bottom: 5px;">Tagline Jasa</h3>
                  <li>
                    <input type="text" name="jasa_tagline" id="jasa_tagline" placeholder="ex : Mantuy paling Oke Oce" required/>
                    <div class="clear"> </div>
                  </li>
                <input type="submit" id="daftar" value="DAFTAR" name="daftar">
                  <div class="clear"> </div>
              </ul>

              <div class="clear"> </div>
            </center>
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
<?php } ?>
