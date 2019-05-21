<?php
include("koneksi.php");
session_start();
if($_GET['latitude']=="" || $_GET['longitude']=="") {
  echo '<script type= "text/javascript">alert("Aktifkan lokasi anda!\n");</script>';
  echo '<script type= "text/javascript">window.location.href = "myprofile.php?user_id='.$_SESSION['id'].'";</script>';
}
else if(isset($_SESSION['id'])){
  $latitude1 = $_GET['latitude'];
  $longitude1 = $_GET['longitude'];
  $sqlPrinting = "SELECT * FROM printing";
  $cekPrinting = mysqli_query($con, $sqlPrinting);

  function distance($lat1, $lon1, $lat2, $lon2, $unit) {

      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);

      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
            return $miles;
          }
    }
//
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
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
    text-align: center;">STEP 2</h1>

    <hr>

    <h1 class="myText" style="
  margin-bottom: 0px;
  margin-right: 53px;
  margin-top:0px;
  font-size:50px;
  color: #2660a4;
  text-align: center;">PILIH TEMPAT PRINT<br/><i class="fas fa-print"></i></h1>
      <br/>
      <br/>


    </div>
  </section>

<section style="padding-top:0px">
  <div class="container-fluid" style="padding-right:0px">
    <center>

    </center>
    <form action="step3.php" method="get">

      <input type="text" name="latitude" id="latitude1" value="<?php echo $latitude1; ?>" hidden >
      <input type="text" name="longitude" id="longitude1" value="<?php echo $longitude1; ?>" hidden>
      <center>
        <center>
          <div class="form-group" style="width:30%">
            <select class="form-control" id="sel1" name="printingid">
              <?php while($rowPrinting = mysqli_fetch_assoc($cekPrinting)){
                      $idPrinting = $rowPrinting['id'];
                      $namaPrinting = $rowPrinting['nama'];
                      $latitude2 = $rowPrinting['latitude'];
                      $longitude2 = $rowPrinting['longitude'];
                      $distance = distance($latitude1, $longitude1, $latitude2, $longitude2, "K");
                      $distance2dp = number_format((float)$distance, 2, '.', '');
                      echo "<option
                      value=$idPrinting>$namaPrinting - $distance2dp km</option>";

                     } ?>

            </select>
          </div>
        </center>
        <br/>
        <button class="btn myBtn" type="submit" id="nextstep">NEXT</button>
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
 function getDistance(lat2, lon2) {
   lat1 = document.getElementById("latitude1").value;
   lon1 = document.getElementById("longitude1").value;
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2-lat1);  // deg2rad below
    var dLon = deg2rad(lon2-lon1);
    var a =
      Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
      Math.sin(dLon/2) * Math.sin(dLon/2)
      ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c; // Distance in km
    //document.getElementById("message").innerHTML = d.toFixed(2) + " km";
    alert(d.toFixed(2));
    return d;
  }

  function deg2rad(deg) {
    return deg * (Math.PI/180)
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
