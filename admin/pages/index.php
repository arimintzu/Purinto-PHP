<?php
  include("../../koneksi.php");
  date_default_timezone_set('Asia/Jakarta');
  $now = date('d');
  $sql_user = 'SELECT * FROM member';
  $cek_user = mysqli_query($con, $sql_user);
  $row_user = mysqli_fetch_assoc($cek_user);

  $sql_printing = 'SELECT * FROM printing';
  $cek_printing = mysqli_query($con, $sql_printing);
  $row_printing = mysqli_fetch_assoc($cek_printing);

  $sql_transaksi = 'SELECT * FROM transaksi';
  $cek_transaksi = mysqli_query($con, $sql_transaksi);
  $row_transaksi = mysqli_fetch_assoc($cek_transaksi);

  function onopirobosqu($tanggal) {
    include('../../koneksi.php');
    $sql = 'SELECT * FROM transaksi';
    $cek = mysqli_query($con, $sql);
    $count = 0;
    //echo $tanggal . "<br/>";
    while ($row = mysqli_fetch_assoc($cek)) {
      $myDateTime = DateTime::createFromFormat('Y-m-d', $row['print_date']);
      $printDate = $myDateTime->format('d');

      if($printDate==$tanggal) {
        $count++;
        //echo $count;
      }

    }

    return $count;

  }
  $nowmin0 = onopirobosqu($now);
  $nowmin1 = onopirobosqu($now-1);
  $nowmin2 = onopirobosqu($now-2);
  $nowmin3 = onopirobosqu($now-3);
  $nowmin4 = onopirobosqu($now-4);
  $nowmin5 = onopirobosqu($now-5);
  $nowmin6 = onopirobosqu($now-6);


$sql_transaksi0 = 'SELECT * FROM transaksi WHERE status=0';
$cek_transaksi0 = mysqli_query($con, $sql_transaksi0);

$sql_transaksi1 = 'SELECT * FROM transaksi WHERE status=1';
$cek_transaksi1 = mysqli_query($con, $sql_transaksi1);
  $dataPoints = array(
  	array("label"=>"Telah Di Print", "symbol" => "P","y"=>mysqli_num_rows($cek_transaksi0)),
  	array("label"=>"Dalam Proses", "symbol" => "O","y"=>mysqli_num_rows($cek_transaksi1)),

  );

  $dataPoints2 = array(
  	array("x"=>$now-6, "y"=>$nowmin6),
    array("x"=>$now-5, "y"=>$nowmin5),
    array("x"=>$now-4, "y"=>$nowmin4),
    array("x"=>$now-3, "y"=>$nowmin3),
    array("x"=>$now-2, "y"=>$nowmin2),
    array("x"=>$now-1, "y"=>$nowmin1),
    array("x"=>$now, "y"=>$nowmin0),

  );

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Status Transaksi"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#\"\"",
		showInLegend: false,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart2 = new CanvasJS.Chart("lineContainer", {
	animationEnabled: true,
	title:{
		text: "Transaksi Harian"
	},
	axisY: {
		title: "Transaksi",
		suffix: ""
	},

  axisX: {
		title: "Tanggal",
	},
	data: [{
		xValueFormatString: "Transaksi",
		type: "spline",
		dataPoints:  <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>

	}]
});
chart2.render();
}
</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel='icon' href='../../favicon.ico' type='image/x-icon'/ >

    <title>Purinto Admin Site</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
.huge {
  font-size: 26px !important;
}
</style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Purinto Admin v.1.0</a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="membertable.php">Member</a>
                                </li>
                                <li>
                                    <a href="printingtable.php">Printer</a>
                                </li>
                                <li>
                                    <a href="transaksitable.php">Transaksi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>

                        </li>
                        <li>

                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>

                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo mysqli_num_rows($cek_user);?></div>
                                    <div>Member Terdaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-print fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo mysqli_num_rows($cek_printing);?> </div>
                                    <div>Jasa Printer Terdaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo mysqli_num_rows($cek_transaksi);?></div>
                                    <div>Total Transaksi</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Diagram Transaksi Harian Selama 1 Minggu
                        </div>
                        <div class="panel-body">
                            <div id="lineContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                    <!-- /.panel -->

                    <!-- /.panel -->
                    <div class="panel panel-default">
                                            </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Diagram Donut Status Transaksi
                        </div>
                        <div class="panel-body">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                        <!-- /.panel-
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../canvas.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
