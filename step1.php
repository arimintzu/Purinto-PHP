<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['id'])){
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
  <link rel="stylesheet" href="css/member.css">

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
              <a class="nav-link js-scroll-trigger" href="index.php#top">Beranda</a>
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

  <section id="step1top" style="padding-bottom:0px; margin-top:0px" >

    <div class="js--fadeInside">
      <h1 class="myText" style="    margin-top: 30px;
    margin-right: 50px;
    color: #494747;
    text-align: center;">STEP 1</h1>

    <hr>

    <h1 class="myText" style="
  margin-bottom: 0px;
  margin-right: 53px;
  margin-top:0px;
  font-size:50px;
  color: #2660a4;
  text-align: center;">CARI LOKASIMU<br/><i class="fas fa-map-pin"></i></h1>
      <br/>
      <br/>
    </div>
  </section>

<section style="padding-top:0px">
  <div class="container-fluid" style="padding-right:0px">
    <center>
      <button class="btn myBtn" onclick="getLocation()" id="btnCari" style="margin-top:0px">CARI LOKASI</button>
      <h4 style="font-style:italic; font-size:35px;" id="message"></h4>
      <h4 style="color:green" id="latMsg"></h4>
      <h4 style="color:green" id="lngMsg"></h4>
    </center>
    <form action="step2.php" method="get">
      <center>
        <input type="text" name="latitude" id="latitude" value="" readonly hidden="hidden"/>
        <input type="text" name="longitude" id="longitude" value="" readonly hidden="hidden"/>
        <br/>
        <button class="btn myBtn" type="submit" id="nextstep" disabled>NEXT</button>
      </center>
    </form>
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

<script>
  var lt = document.getElementById("latitude");
  var lng = document.getElementById("longitude");
  var ltMsg = document.getElementById("latMsg");
  var lngMsg = document.getElementById("lngMsg");
  var p = document.getElementById("message");
  function getLocation() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showLatitude);
          navigator.geolocation.getCurrentPosition(showLongitude);
          document.getElementById("nextstep").disabled = false;
          document.getElementById("btnCari").style.display = "none";
          p.innerHTML = "Lokasi ditemukan!"
      } else {
          lt.innerHTML = "Geolocation is not supported by this browser.";
      }
  }

  function showLatitude(position) {
      lt.value= position.coords.latitude;
      ltMsg.innerHTML = "Latitude : " + position.coords.latitude;
      //alert(position.coords.latitude);
  }

  function showLongitude(position) {
      lng.value = position.coords.longitude;
      lngMsg.innerHTML = "Longitude : " + position.coords.longitude;
      //alert(position.coords.latitude);
  }
</script>
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
<?php }

  else {
    header("location:index.php");
  }
 ?>
