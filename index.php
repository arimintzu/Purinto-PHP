<?php
include("koneksi.php");
session_start();
 ?><!DOCTYPE html>
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

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" href="favicon.ico">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/fontstyle.css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/agency.css" rel="stylesheet">

  <script src="slider/jquery.min.js"></script>
  <script src="slider/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
  <link rel="stylesheet" href="css/testimonial.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="css/footer.css">
</head>

<body id="top" >

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container-fluid">
        <!-- <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a> -->
        <div class="navbar-brand js-scroll-trigger" id="picture-one">
            <img src="img/print_top.png" style="width:150px">
        </div>
        <div class="navbar-brand js-scroll-trigger hide" id="picture-two">
            <img src="img/print_top.png" style="width: 140px;">
        </div>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#top">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#tentang">Tentang</a>
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

  <section id="main" >

    <div class="js--fadeInside">
      <br/>
      <br/>
      <h1 class="myText" style="margin-bottom:30px">Solusi Segala<br/>Masalah Printmu</h1>
      <?php if(!isset($_SESSION['id'])){ ?>
        <a href="sign.php">
          <button class="btnJoin">Gabung Sekarang &nbsp;<i class="fas fa-arrow-right"></i></button>
        </a>
      <?php } else {?>
        <a href="step1.php">
          <button class="btnJoin">Print Sekarang &nbsp;<i class="fas fa-arrow-right"></i></button>
        </a>
      <?php } ?>
    </div>

  </section>

  <section id="tentang" >
    <div class="container">

        <center class="js--fadeInTop">
          <h4 style="text-align:left">TENTANG KAMI</h4>
          <br/>
        </center>

        <div class="row" >

          <div class="col-5" style="margin-left:30px">
            <h5>CETAK HARIMU BERSAMA KAMI</h5>
            <p>
              Purinto merupakan sebuah website yang tentunya sesuai dengan namanya, Print!
              <br/>
              Dengan website ini, kami memberikan layanan penuh bagi konsumen yang ingin melakukan print dokumen secara dadakan dengan mencari
              printer terdekat dari lokasi konsumen sekarang.
              <br/>
              Selain itu, konsumen bisa mendaftarkan diri sebagai jasa printer untuk membantu para kaum deadline lainnya! 
            </p>
          </div>

          <div class="col-6">
            <img src="img/wibu.png" style="width:100%" alt=""/>
          </div>
        </div>
        <br/><br/>
    </div>
  </section>


<section id="layanan">
  <div class="container-fluid">
    <div class="row">
      <div class="col-4" id="step1">
        <center>
          <h4>STEP 1</h4>
          <img src="img/pinloc.png" style="width:17%">
          <p>CARI LOKASI</p>
        </center>
      </div>

      <div class="col-4" id="step2">
        <center>
          <h4>STEP 2</h4>
          <img src="img/print.png" >
          <p>PILIH TEMPAT TERDEKAT</p>
        </center>
      </div>

      <div class="col-4" id="step3">
        <center>
          <h4>STEP 3</h4>
          <img src="img/unggah.png">
          <p>UNGGAH FILE ANDA</p>
        </center>
      </div>
    </div>
  </div>
</section>

<section id="testimonial">
  <div class="container">
    <center class="js--fadeInTop">
      <h4 style="text-align:left">TESTIMONIAL</h4>
      <br/>
    </center>
    <div class="row">
        <div class="col-md-12">
            <div id="testimonial-slider" class="owl-carousel">
                <div class="testimonial">
                    <p class="description">
                      Jadi gue pas pake fitur-fitur yang ada di web ini gila sih, keren banget, mempermudah pekerjaan kami-kami yang mahasiswa ini.
                        </p>
                    <div class="testimonial-content">
                        <div class="pic">
                            <img src="img/waifu.png">
                        </div>
                        <h3 class="title">Rizka Yulianti</h3>
                    </div>
                </div>

                <div class="testimonial">
                    <p class="description">
                        Code, Wibu, Repeat. Oops! Maksud saya, sebagai mahasiswa H-1 efisiensi waktu adalah kuncinya, dan PURINTO benar-benar membantu kami. Yoms!
                    </p>
                    <div class="testimonial-content">
                        <div class="pic">
                            <img src="img/waifu.png">
                        </div>
                        <h3 class="title">Albertus Ari Kristanto</h3>
                    </div>
                </div>

                <div class="testimonial">
                    <p class="description">
                      Innovation distinguishes between a leader and a follower.
                      <br/>
                      <br/>
                    </p>
                    <div class="testimonial-content">
                        <div class="pic">
                            <img src="img/waifu.png">
                        </div>
                        <h3 class="title">Azarya Abednego</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!isset($_SESSION['id'])){ ?>
      <h4 class="ezText">BELUM GABUNG?</h4>
      <center>
        <a href="sign.php"><button class="btn myBtn">DAFTAR SEKARANG</button></a>
      </center>
    <?php } else { ?>
      <center>
        <a href="step1.php"><button class="btn myBtn" style="margin-top:60px">PRINT SEKARANG</button></a>
      </center>
    <?php } ?>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/testimonial.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/scrollreveal.min.js"></script>

</body>


  <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

</html>
