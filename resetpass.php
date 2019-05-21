<?php
include("koneksi.php");

$id = $_GET['user_id'];
$sqlData = "SELECT * FROM member WHERE user_id='$id'" ;
$cekData = mysqli_query($con, $sqlData);
$rowData = mysqli_fetch_assoc($cekData);
function kosongkan($con, $data){
  $filter = trim($data);
  $filter = mysqli_real_escape_string($con, $data);
  $filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
  return $filter;
}

if(isset($_POST['reset']))
{
  $nothashed = kosongkan($con,$_POST['forget_confirmpass']);
  $passwordhashed = md5($nothashed);

  $sql = "UPDATE member SET password='$passwordhashed' WHERE user_id='$id'" ;
  $cek = mysqli_query($con, $sql);
  if($cek)
  {
    echo '<script type= "text/javascript">alert("Reset Success!");</script>';
    echo '<script type= "text/javascript">window.location.href = "index.php";</script>';
  }
  else
  {
       echo '<script type= "text/javascript">alert("Reset Gagal!");</script>';
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

  <script type="text/javascript">
  function myFunction(id) {
    var x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }

    check1 = false;
    var check = function () {
        if (document.getElementById('forget_pass').value ==
            document.getElementById('forget_confirmpass').value) {
            document.getElementById('forget_confirmpass').style.backgroundColor = '#36ff00a3';
            if (check1 == true) {
                document.getElementById('reset').style.pointerEvents = 'auto';
                document.getElementById('reset').style.backgroundColor = '#0d5c7d';
                document.getElementById('reset').style.color = '#FFFFFF';
            }

        } else {
            document.getElementById('forget_confirmpass').style.backgroundColor = '#ff000066';
            document.getElementById('reset').style.pointerEvents = 'none';
            document.getElementById('reset').style.backgroundColor = '#c0c0c0';
            document.getElementById('reset').style.color = '#4D4949';
        }
    }

    var syarat = function () {
        if (document.getElementById('forget_pass').value.length < 8) {
            document.getElementById('forget_pass').style.backgroundColor = '#ff000066';
            document.getElementById('message').innerHTML = "Password yang dimasukkan harus > 8!\n";
            check1 = false;
        } else {
            document.getElementById('forget_pass').style.backgroundColor = '#36ff00a3';
            document.getElementById('message').innerHTML = "";
            check1 = true;
        }
    }
  </script>

  <style>
  .fa-eye:before {
    position: relative;
    top: 10px;
    left: 30%;
  }

  </style>
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
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="sign.php"><i class="fas fa-user-alt"></i>&nbsp;Gabung</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


  <section id="login" >
    <div class="container">
      <div class="main" style="font-family:'Muli', sans-serif; margin-top:0px;
                              border:3px solid #2660a4; box-shadow: 0 0 2px 0px; border-radius:25px">
        <div class="header" >
          <h1>Masuk atau Buat Akun Gratis Sekarang!</h1>
        </div>
        <p></p>
          <form action="" method="post">
            <center>
              <ul class="left-form" style="float:none">
                <h2>Hi, <?php echo $rowData['nama']; ?></h2>
                <h2>Silahkan buat password baru</h2>
                <li>
                  <input type="password" name="forget_pass" id="forget_pass" onkeyup="syarat(); check();" placeholder="Password" required/>
                  <i class="fas fa-eye" onclick="myFunction('forget_pass')"></i>
                  <h4 style="color:red" id="message"><br/></h4><br/>

                  <div class="clear"> </div>
                </li>
                <li>
                  <input type="password" name="forget_confirmpass"  id="forget_confirmpass" onkeyup="check();"placeholder="Confirm Password" required/>
                  <i class="fas fa-eye" onclick="myFunction('forget_confirmpass')"></i>
                  <!-- itu error -->
                  <div class="clear"> </div>
                </li>
                <input type="submit" id="reset" value="RESET" name="reset">
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
