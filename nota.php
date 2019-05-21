<?php
include("koneksi.php");
session_start();

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


$id = $_GET['printingid'];
$sqlData = "SELECT * FROM member WHERE user_id='$id'" ;
$cekData = mysqli_query($con, $sqlData);
$rowData = mysqli_fetch_assoc($cekData);
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
                              border:3px solid #2660a4; box-shadow: 0 0 2px 0px; border-radius:25px; width:50%">
        <div class="header" style="padding-bottom:0px">
          <h1 style="font-size: 50px;
    font-family: 'DoHyeon';
    padding-bottom: 0px;
    margin-bottom: 0px;
    text-transform:uppercase;
    letter-spacing:1px">#NOTA</h1>
        </div>
        <p style="padding-top:0px; margin-bottom:30px"></p>
          <form action="proses-transaksi.php" method="post">
            <center>
              <ul class="left-form" style="float:none; width:60%">
                <h2 style="font-size:24px; font-family:'DoHyeon', sans-serif;">PELANGGAN</h2>
                <li>
                  <h2 style="color:#149cd7;
                  font-size:20px; text-align:center"><?php echo $rowKanan['nama'];?></h2>
                  <h2 style="color:#149cd7;
                  font-size:20px; text-align:center"><?php echo $rowKanan['telp'];?></h2>
                </li>

                <?php
                $queryPrinting = "SELECT * FROM printing WHERE id='$id'";
                $cekPrinting = mysqli_query($con, $queryPrinting);
                $rowPrinting = mysqli_fetch_assoc($cekPrinting);
                 ?>
                <h2 style="font-size:24px; font-family:'DoHyeon', sans-serif;margin-top:30px;">PRINTER</h2>
                <li>
                  <h2 style="color:#149cd7;
                  font-size:20px; text-align:center"><?php echo $rowPrinting['nama'];?></h2>
                </li>

                <h2 style="font-size:24px; font-family:'DoHyeon', sans-serif;margin-top:30px;">INFO FILE</h2>
                <li style="word-break:break-word">
                  <a href="<?php echo $_GET['file']; ?>"><h2 style="color:#149cd7;
                  font-size:20px; text-align:center"><?php echo substr($_GET['file'], 16);?></h2></a>
                </li>

                <h2 style="font-size:24px; font-family:'DoHyeon',
                sans-serif;margin-top:30px;">
                Jarak : <?php
                $distance = distance($_GET['latitude'], $_GET['longitude'], $rowPrinting['latitude'], $rowPrinting['longitude'], "K");
                $distance2dp = number_format((float)$distance, 2, '.', '');
                echo $distance2dp . " km" ?></h2>
                <h2 style="font-size:24px; font-family:'DoHyeon',
                  sans-serif;margin-top:30px;">Pages :
                  <?php
                  $num = count(file($_GET['file']));
                  echo $num % 22;
                  ?>
                </h2>

                <h2 style="font-size:24px; font-family:'DoHyeon',
                  sans-serif;margin-top:30px;">Harga : Rp
                  <?php
                  echo number_format($num%22*500 + $distance2dp*1000,2,",",".");
                  ?>
                </h2>
                <br/>
                <input type="text" name="memberID" value="<?php echo $_SESSION['id'];?>" hidden >
                <input type="text" name="printingID" value="<?php echo $id; ?>" hidden>
                <input type="text" name="latitude" value="<?php echo $_GET['latitude']?>" hidden>
                <input type="text" name="longitude" value="<?php echo $_GET['longitude']?>" hidden>
                <input type="text" name="filePrinted" value="<?php echo $_GET['file']?>" hidden>
                <input type="text" name="pages" value="<?php echo $num%22;?>" hidden >
                <input type="text" name="cost" value="<?php echo $num%22*500 + $distance2dp*1000;?>" hidden >
                <input type="text" name="jarak" value="<?php echo $distance2dp;?>" hidden >

                <input style="font-size:20px" type="submit" id="daftar" value="CETAK" name="cetak"
                onclick="return confirm(\'Yakin untuk membayar?\')">
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
