<?php
include("koneksi.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';
if(isset($_POST['cetak']))
{
    $memberID = $_POST['memberID'];
    $printingID = $_POST['printingID'];
    $filexxx = $_POST['filePrinted'];
    $pages = $_POST['pages'];
    $cost = $_POST['cost'];
    $jarak = $_POST['jarak'];
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $input = mysqli_query($con,"INSERT INTO transaksi VALUES(null, '$memberID',
        '$printingID', CURDATE(), '$filexxx', '$pages', '$lat', '$long', '$jarak', '$cost', 0, null, null )") or die(mysqli_connect_error());

    if($input)
    {
      $query = "UPDATE printing SET total_transaksi = total_transaksi + 1,
                                    income = income + '$cost'
                                    WHERE id = '$printingID'";
      $goSQL = mysqli_query($con, $query);

      $queryMail = "SELECT * FROM member WHERE company_id='$printingID'";
      $goMail = mysqli_query($con, $queryMail);
      $row = mysqli_fetch_assoc($goMail);

      $toemail = $row['email'];
      $tonama = $row['nama'];

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
        $mail->addAddress($toemail);               // Name is optional
        $mail->addReplyTo('noreply@thekingcorp.org', 'noreply');
        $mail->addCC('purinto@thekingcorp.org');
        $mail->addBCC('purinto@thekingcorp.org');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Pemberitahuan Pemesanan oleh Purinto';
        $mail->Body = "

        Hai $tonama
        <br/>
        Anda memiliki 1 pesanan dari Purinto.
        <br/>
        Silahkan periksa tab JASA SAYA untuk melihat pesanan!
        <br/>
        Terimakasih.

          ";

          $mail->send();

        echo '<script type= "text/javascript">alert("Transaksi Berhasil!\n");</script>';
        echo '<script type= "text/javascript">window.location.href = "terimakasih.php";</script>';
        return true;
      } catch (Exception $e) {
          return false;
          echo "Gagal"  + $e;
      }

    }
    else
    {
      echo '<script type= "text/javascript">alert("Register Gagal");</script>';
      echo '<script type= "text/javascript">window.location.href = "member.php";</script>';
    }
}

 ?>
