<?php
include("koneksi.php");
session_start();
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
$sql = 'SELECT * FROM member WHERE user_id= "'.$id.'"' ;
$cek = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($cek);
$company_id = $row['company_id'];

$sqlCompany = "SELECT * FROM printing WHERE id = '$company_id'";
$cekCompany = mysqli_query($con, $sqlCompany);
$rowCompany = mysqli_fetch_assoc($cekCompany);

$myDateTime = DateTime::createFromFormat('Y-m-d', $rowCompany['since']);
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
  </style>

</head>

<body id="top">

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
                              border:2px solid #2660a4; box-shadow: 0 0 2px 0px; border-radius:25px; width:100%;
                              ">
        <div class="header" style="padding-bottom:0px">
          <h1 style="font-size: 40px;
    font-family: 'DoHyeon';
    padding-bottom: 0px;
    margin-bottom: 0px;
    text-transform:uppercase;
    letter-spacing:1px"><?php echo $rowCompany['nama']; ?></h1>

          <h1 style="font-size: 25px;
      font-family: 'DoHyeon';
      font-style:italic;
      color:#2660a4;
      padding-bottom: 0px;
      margin-bottom: 0px;
      text-transform:uppercase;
      letter-spacing:1px">- <?php echo $rowCompany['tagline']; ?> -</h1>

            <h1 style="font-size: 14px;
        font-family: 'DoHyeon';
        padding-bottom: 0px;
        color:#d4d4d4;
        margin-bottom: 0px;
        text-transform:uppercase;
        letter-spacing:5px">sejak <?php echo $joinDate; ?></h1>
        </div>
        <br/>

        <!-- <div class="row">
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
        </div> -->

        <?php $no =0;
        $queryTransaksi = "SELECT * FROM transaksi WHERE printing_id = '$company_id' ORDER BY status ASC";
        $cekTransaksi = mysqli_query($con, $queryTransaksi);
        if(mysqli_num_rows($cekTransaksi)>0) { ?>

            <ul class="left-form" style="float:none; text-align:center; margin-bottom:50px">
              <center>
                <table class="table table-bordered table-hover" style="text-align:center; margin-left:11%">
                  <thead>
                    <th>#</th>
                    <th>Pemesan</th>
                    <th>File</th>
                    <th>Jarak</th>
                    <th>Bayar</th>
                    <th>Tanggal</th>
                    <th>Option</th>
                  </thead>
                  <?php
                    while($rowTransaksi = mysqli_fetch_assoc($cekTransaksi))
                    {
                      if($rowTransaksi['deleted_at_by_printing']==null) {

                      $no++;
                      $memberID=$rowTransaksi['member_id'];
                      $queryMember = "SELECT * FROM member WHERE user_id = '$memberID'";
                      $cekEachMember = mysqli_query($con, $queryMember);
                      $rowPemesan = mysqli_fetch_assoc($cekEachMember);


                   ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $rowPemesan['nama']; ?></td>
                    <td><a href="<?php echo $rowTransaksi['file']; ?>">
                      <?php echo substr($rowTransaksi['file'], 16); ?></a></td>
                    <td><?php echo $rowTransaksi['jarak']; ?> km</td>
                    <td>Rp<?php echo number_format($rowTransaksi['cost'],2,',','.'); ?></td>
                    <td><?php echo $rowTransaksi['print_date']; ?></td>
                    <td>
                      <?php if($rowTransaksi['status']==0) {?>
                        <a href="printit.php?id_transaksi=<?php echo $rowTransaksi['id']; ?>">
                        <button class="btn btn-info" onclick="return confirm('\Transaksi ini akan dinyatakan selesai. Lanjutkan?')">Print</button> </a>
                      <?php } else {?>
                        <a href="hapustransaksi.php?id_transaksi=<?php echo $rowTransaksi['id']; ?>">
                          <button class="btn btn-success" onclick="return confirm('\History transaksi ini akan dihapus. Lanjutkan?')"
                                  onmouseover="this.innerHTML='Hapus'" onmouseout="this.innerHTML='Selesai'">Selesai</button> </a>
                      <?php } ?>
                    </td>

                  </tr>

                <?php }
              }
                 ?>
                </table>
              </center>

              <div class="clear"> </div>
            </ul>
            <div class="clear"> </div>

          <?php   }

          else { ?>
            <center>
              <p class="alert alert-info" style="margin-top:50px; width:50%; margin-bottom:40px">Belum ada transaksi.</p>
            </center>
          <?php } ?>
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
