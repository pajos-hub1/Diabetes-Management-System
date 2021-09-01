<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>

<?php session_start();
//DB conncetion
include_once('includes/config.php');
//error_reporting(0);
//validating Session
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ontology Diabetes Management | Blood Event</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
  <?php include_once('includes/sidebar.php');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
<?php include_once('includes/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Blood Glucose Level Event</h1>
                        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Download Report</a>
                    </div>
                    <h1 class="h3 mb-2 text-gray-800"></h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Blood Glucose Level Event</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php 
                                if (isset($_POST['submit'])) {
                                $username=$_SESSION['aid'];
                                $bslf=$_POST['bslf'];
                                $pdate=$_POST['pdate'];
                                $sql = "INSERT INTO tblresult (user, value, label) VALUES ('$username', '$bslf', '$pdate')";
            if (mysqli_query($con, $sql)) {
                echo "Result uploaded successfully";
            }}
                                ?>
                                <div class="container">
                                <form method="post">
                                     <input type="date" name="pdate"/>
                                     <input type="text" name="bslf" placeholder="Result in figure" />
                                     <input type="submit" name="submit" value="submit" />
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Blood Glucose Level Event</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="container">
    <?php
    $username=$_SESSION['aid'];
    $sql = "SELECT Label, Value FROM tblresult where user='".$_SESSION['aid']."'";
    $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
    $data = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) { 
       $data[] = $rows;
    }
    $josn_data = json_encode($data);
    ?>  
    
    <div id="chart-1"></div>
    
    <?php
    include("includes/fusioncharts.php");
    $columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart-1", "json", "{  
                'chart':{  
                  'caption':'Blood Glucose Level Event',
                  'subCaption':'Result Chart',
                  'numberPrefix':'',
                  'theme':'ocean'
                },
                'data':$josn_data
            }");
    // Render the chart
    $columnChart->render();
    ?>
    
</div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <!-- Footer -->
    <?php include_once('includes/footer.php');?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include_once('includes/footer2.php');?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
<?php } ?>