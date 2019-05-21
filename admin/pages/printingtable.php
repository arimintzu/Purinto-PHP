<?php
  include("../../koneksi.php");
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='icon' href='../../images/favicon.ico' type='image/x-icon'/ >

    <title>Purinto Admin Site</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<style >
  td {
    vertical-align: middle !important;
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
                    <h1 class="page-header">Admin Privilleges</h1>
                    <a href="printingtopdf.php" target="_blank">
                      <button class="btn btn-success" style="margin-bottom:30px">Download report ini dalam PDF</button>
                    </a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Jasa Printer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center">Nama</th>
                                            <th style="text-align:center">Tagline</th>
                                            <th style="text-align:center">Transaksi</th>
                                            <th style="text-align:center">Income</th>
                                            <th style="text-align:center">Sejak</th>
                                            <th style="text-align:center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $member = "SELECT * FROM printing";
                                      $cek = mysqli_query($con, $member);
                                      $no=1;
                                      while($row = mysqli_fetch_assoc($cek)) {
                                        $myDateTime = DateTime::createFromFormat('Y-m-d', $row['since']);
                                        $joinDate = $myDateTime->format('d M Y');
                                       ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['tagline']; ?></td>
                                            <td><?php echo $row['total_transaksi']; ?></td>
                                            <td>Rp<?php echo number_format($row['income'],2,',','.'); ?>-</td>
                                            <td><?php echo $joinDate; ?></td>
                                            <td>
                                              <a href="deleteprinting.php?id_printing=<?php echo $row['id']; ?>">
                                                <button class="btn btn-danger"
                                                onclick="return confirm('\Jasa printer ini akan dihapus dari database. Lanjutkan?')">
                                                  DELETE</button>
                                              </a>
                                            </td>
                                        </tr>
                                      <?php $no++;} ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

        <!-- /#page-wrapper -->

      </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
