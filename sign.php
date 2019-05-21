<?php
include("koneksi.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

function kosongkan($con, $data){
  $filter = trim($data);
  $filter = mysqli_real_escape_string($con, $data);
  $filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
  return $filter;
}

if(isset($_POST['masuk']))
{
  $username = kosongkan($con,$_POST['in_username']);
  $password = kosongkan($con,$_POST['in_password']);

  if($username== "admin" && $password== "admin") {
    echo '<script type= "text/javascript">window.location.href = "admin/pages/index.php";</script>';
  }

  else {
    $sql = 'SELECT * FROM member WHERE Username= "'.$username.'"' ;
    $cek = mysqli_query($con, $sql);
    $row1 = mysqli_fetch_assoc($cek);
    if(md5($password)==$row1['password'])
    {
      if($row1['verified']==0) {
        echo '<script type= "text/javascript">alert("Silahkan verifikasi terlebih dahulu akun anda!");</script>';
        echo '<script type= "text/javascript">window.location.href = "cekyourmail.html";</script>';
      }

      else {
        $_SESSION['id'] = $row1['user_id'];
        echo '<script type= "text/javascript">alert("Login Sukses!");</script>';
        echo '<script type= "text/javascript">window.location.href = "member.php";</script>';
      }

    }

    else
    {
         echo '<script type= "text/javascript">alert("ID / Password tidak sesuai!");</script>';
    }

  }
}

else if(isset($_POST['daftar']))
{
    $nama = kosongkan($con,$_POST['reg_nama']);
    $username = kosongkan($con,$_POST['reg_username']);
    $email = kosongkan($con,$_POST['reg_email']);
    $telp = kosongkan($con,$_POST['reg_telp']);
    $nothashed = kosongkan($con,$_POST['reg_pass']);
    $password = md5($nothashed);
    $confirmpass = kosongkan($con, $_POST['reg_confirmPass']);

    if($confirmpass==$nothashed)
    {

      $sqlcekusername = "SELECT * FROM member WHERE username='$username'";
      $cekUsername = mysqli_query($con, $sqlcekusername);
      if(mysqli_num_rows($cekUsername)==0)
      {
        $input = mysqli_query($con,"INSERT INTO member VALUES(null, '$nama',
            '$username', '$email', '$telp', '$password', null, CURDATE(), 0, 'profile_pic/default.png')");
      	if($input)
      	{
          echo '<script type= "text/javascript">alert("Register Berhasil!\n");</script>';

          $sql = 'SELECT * FROM member WHERE username= "'.$username.'"' ;
          $cek = mysqli_query($con, $sql);
          if(mysqli_num_rows($cek) == 1)
          {
            $row = mysqli_fetch_assoc($cek);
            $tonama = $row['nama'];
            $toemail = $row['email'];
            $touserid = $row['user_id'];
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        		try {
        			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
        			$mail->isSMTP();                                      // Set mailer to use SMTP
        			$mail->Host = 'kakuna.rapidplex.com;www.thekingcorp.org';  // Specify main and backup SMTP servers
        			$mail->SMTPAuth = true;                               // Enable SMTP authentication
        			$mail->Username = 'purinto@thekingcorp.org';                 // SMTP username
        			$mail->Password = 'Tqs549_bc85';                           // SMTP password
        			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        			$mail->Port = 465 ;                                    // TCP port to connect to

        			//Recipients
        			$mail->setFrom('purinto@thekingcorp.org', 'Purinto');
        			$mail->addAddress($email);               // Name is optional
        			$mail->addReplyTo('noreply@thekingcorp.org', 'noreply');
        			$mail->addCC('purinto@thekingcorp.org');
        			$mail->addBCC('purinto@thekingcorp.org');

        			//Content
        			$mail->isHTML(true);                                  // Set email format to HTML
        			$mail->Subject = 'Permintaan Verifikasi oleh Purinto';
        			$mail->Body = "

        			Thanks for signing up!
        			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
              <br/><br/>
        			------------------------
        			Full name: $tonama
        			------------------------
              <br/>
        			Please click this link to activate your account:
        			https://purinto.thekingcorp.org/verify.php?user_id=$touserid
              <br/>
              <br/>
              If you still use localhost:
              localhost:8080/ProjectUTS/verify.php?user_id=$touserid

        				";

        				$mail->send();
                //echo '<script type= "text/javascript">alert("Register Gagal");</script>';
                echo '<script type= "text/javascript">window.location.href = "sukses.html";</script>';
        			return true;
          		} catch (Exception $e) {
          				return false;
          				echo "Gagal"  + $e;
          		}

            }


          }

          else
        	{
        		echo '<script type= "text/javascript">alert("Register Gagal");</script>';
        	}

  }

    else {
      echo '<script type= "text/javascript">alert("Username ini telah digunakan! Silahkan mencoba username lainnya");</script>';
    }
  }

  else {
    echo '<script type= "text/javascript">alert("Konfirmasi password salah!");</script>';
  }

}




else if(isset($_POST['lupa']))
{
    $email = kosongkan($con,$_POST['lupa_email']);

    $sql = 'SELECT * FROM member WHERE email= "'.$email.'"' ;
    $cek = mysqli_query($con, $sql);
    if(mysqli_num_rows($cek) == 1)
    {
      $row = mysqli_fetch_assoc($cek);
      $nama = $row['nama'];
      $user_id = $row['user_id'];
      $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
      try {
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'kakuna.rapidplex.com;www.thekingcorp.org';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'purinto@thekingcorp.org';                 // SMTP username
        $mail->Password = 'Tqs549_bc85';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465 ;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('purinto@thekingcorp.org', 'Purinto');
        $mail->addAddress($email);               // Name is optional
        $mail->addReplyTo('noreply@thekingcorp.org', 'noreply');
        $mail->addCC('purinto@thekingcorp.org');
        $mail->addBCC('purinto@thekingcorp.org');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Permintaan Reset Password oleh Purinto';
        $mail->Body = "

        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
        <br/>
        ------------------------
        Full name: $nama
        ------------------------
        <br/><br/>
        Please click this link to activate your account:
        https://purinto.thekingcorp.org/resetpass.php?user_id=$user_id
        <br/>
        <br/>
        If you still use localhost:
        localhost:8080/ProjectUTS/resetpass.php?user_id=$user_id


          ";

          $mail->send();
          echo '<script type= "text/javascript">alert("Email telah dikirim!");</script>';
          echo '<script type= "text/javascript">window.location.href = "emailreset.html";</script>';
        return true;
      } catch (Exception $e) {
          return false;
          echo "Gagal";
      }
    }
    else
    {
         echo '<script type= "text/javascript">alert("Email tidak terdaftar di database!");</script>';
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
    function myCreate() {
      document.getElementById("in_username").required = false;
      document.getElementById("in_password").required = false;
      document.getElementById("lupa_email").required = false;
    }

    function myLogin() {
      document.getElementById("reg_nama").required = false;
      document.getElementById("reg_username").required = false;
      document.getElementById("reg_telp").required = false;
      document.getElementById("reg_email").required = false;
      document.getElementById("reg_pass").required = false;
      document.getElementById("reg_confirmPass").required = false;
      document.getElementById("lupa_email").required = false;
    }

    function myForgot() {
      document.getElementById("in_username").required = false;
      document.getElementById("in_password").required = false;
      document.getElementById("reg_nama").required = false;
      document.getElementById("reg_username").required = false;
      document.getElementById("reg_telp").required = false;
      document.getElementById("reg_email").required = false;
      document.getElementById("reg_pass").required = false;
      document.getElementById("reg_confirmPass").required = false;
    }
  </script>

  <script>
$(document).ready(function(){
	$('#reg_username').keyup(check_username);
});

function check_username(){
	var username = $('#reg_username').val();
	if(username == '' || username.length < 6){
		$('#reg_username').removeClass("available").addClass("notavailable");
	}
	else {
		jQuery.ajax({
			type: 'POST',
			url: 'checkusername.php',
			data: 'username='+ username,
			cache: false,
			success: function(response){
				if(response == 1){
					$('#reg_username').removeClass("available").addClass("notavailable");
				}
				else {
					$('#reg_username').removeClass("notavailable").addClass("available");
				}
			}
		});
	}
}
</script>

<style media="screen">
.notavailable {
  border: 2px #C33 solid !important;
}
.available {
  border: 2px #090 solid !important;
}
</style>
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
            <ul class="left-form">
              <h2>Daftar</h2>
              <li>
                <input type="text" name="reg_nama" id="reg_nama" placeholder="Nama Lengkap" required/>
                <div class="clear"> </div>
              </li>
              <li>
                <input type="text" name="reg_username" id="reg_username" placeholder="Username" required/>
                <div class="clear"> </div>
              </li>
              <li>
                <input type="email" name="reg_email"  id="reg_email"placeholder="Email" required/>
                <div class="clear"> </div>
              </li>
              <li>
                <input type="text" name="reg_telp" id="reg_telp" placeholder="Nomor Telepon" required/>
                <div class="clear"> </div>
              </li>
              <li>
                <input type="password" name="reg_pass" id="reg_pass" placeholder="Password" required/>
                <div class="clear"> </div>
              </li>
              <li>
                <input type="password" name="reg_confirmPass" id="reg_confirmPass" placeholder="Confirm Password" required/>

                <!-- itu error -->
                <div class="clear"> </div>
              </li>
              <input type="submit" onclick="myCreate()" value="Daftar" name="daftar"><br/><br/>
              <!-- <a href="companysign.php"><h4 style="font-size:18px;color:blue">Atau daftar sebagai tempat print</h4></a> -->
                <div class="clear"> </div>
            </ul>


            <ul class="right-form">
              <h3>Masuk</h3>
              <div>
                <li><input type="text" name="in_username" id="in_username" placeholder="Username" required/></li>
                <li> <input type="password" name="in_password" id="in_password"  placeholder="Password" required/></li>
                  <input type="submit" style="margin-top:10px" onclick="myLogin()" value="Masuk" name="masuk">
              </div>
              <div class="clear"> </div>

              <h3 style="margin-top:45px">Lupa Password</h3>
              <div>
                <li><input type="email" name="lupa_email" id="lupa_email" placeholder="Email" required/></li>
                <h4 style="color:red">Kami akan mengirimkan surat ke email anda.<br/>Ikuti instruksi untuk membuat password baru!<br/></h4><br/>
                <br/><input type="submit" onclick="myForgot()" value="Kirim" name="lupa" >
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
