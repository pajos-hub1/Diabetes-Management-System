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

    <title>Ontology Diabetes Management | Medication Events</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Medication Event</h1>
                        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Download Report</a>
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"></h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daily Medication Event</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php 
                                if (isset($_POST['submit'])) {
                                $username=$_SESSION['aid'];
                                $pdate=$_POST['pdate'];
                                $insulin=$_POST['1'];
                                $Aspirin=$_POST['2'];
                                $InsulinII=$_POST['3'];
                                $CholesterolLowering=$_POST['4'];
                                $PressureMedication=$_POST['5'];
                                $InsulinIII=$_POST['6'];
                                $HighBloodPressure=$_POST['7'];
                                $Drug=$_POST['8'];
                                $sql = "INSERT INTO tblmedication (user, pdate, insulin, Aspirin, InsulinII,  CholesterolLowering, PressureMedication, InsulinIII, HighBloodPressure, Drug) VALUES ('$username', '$pdate', '$insulin', '$Aspirin', '$InsulinII', '$CholesterolLowering', '$PressureMedication', '$InsulinIII', '$HighBloodPressure', '$Drug')";
            if (mysqli_query($con, $sql)) {
                echo "Result uploaded successfully";
            }}
                                ?>
                                <div class="container">
                                <form method="post">
                                    <div style="">
                                     <input type="date" name="pdate"/></div><br>                                    
                                     <div style="float: right;"><label style="font-weight: bold;">Insulin: </label><input type="text" name="1" placeholder="Nos of dose" /><br>
                                     <label style="font-weight: bold;">Aspirin: </label><input type="text" name="2" placeholder="Nos of dose" /><br>
                                     <label style="font-weight: bold;">Insulin II: </label><input type="text" name="3" placeholder="Nos of dose" /><br>
                                     <label style="font-weight: bold;">Drug: </label>
                                     <select name="4" style="width: 50%;">
                                         <option>Drugs</option>
                                         <option name="dd">dd</option>
                                     </select>
                                     <br>
                                     </div>
                                     <div><label style="font-weight: bold;">Cholestrol Lowering: </label><input type="text" name="5" placeholder="Nos of dose" /><br>
                                     <label style="font-weight: bold;">Pressure Medication: </label><input type="text" name="6" placeholder="Name of Drug & dosage" /><br>
                                     <label style="font-weight: bold;">Insulin III: </label><input type="text" name="7" placeholder="Nos of dose" /><br>
                                     <label style="font-weight: bold;">High BLood Pressure: </label><input type="text" name="8" placeholder="Nos of dose" /></div>
                                     <div><input type="submit" name="submit" value="submit" /></div>
                                 </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Medication Record</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form name="assignto" method="post">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Insulin</th>
                                            <th>Aspirin</th>
                                            <th>Insulin II</th>
                                            <th>Cholestrol Lowering</th>
                                            <th>Pressure Medication</th>                                     
                                            <th>Insulin III</th>
                                            <th>High BLood Pressure</th>
                                            <th>Drug</th>
                                        </tr>
                                    </thead>
                                      <tfoot>
                                            <tr>
                                            <th>Date</th>
                                            <th>Insulin</th>
                                            <th>Aspirin</th>
                                            <th>Insulin II</th>
                                            <th>Cholestrol Lowering</th>
                                            <th>Pressure Medication</th>                                     
                                            <th>Insulin III</th>
                                            <th>High BLood Pressure</th>
                                            <th>Drug</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<?php 
$username=$_SESSION['aid'];
$sql = "SELECT pdate, insulin, Aspirin, InsulinII,  CholesterolLowering, PressureMedication, InsulinIII, HighBloodPressure, Drug FROM tblmedication where user='".$_SESSION['aid']."'";
$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
    $data = array();
    while( $rows = mysqli_fetch_assoc($resultset) ){
?>
            
                                        <tr>
                                            <td><?php echo $rows['pdate'];?></td>
                                            <td><?php echo $rows['insulin'];?></td>
                                            <td><?php echo $rows['Aspirin'];?></td>
                                            <td><?php echo $rows['InsulinII'];?></td>
                                            <td><?php echo $rows['CholesterolLowering'];?></td>
                                             <td><?php echo $rows['PressureMedication'];?></td>
                                            <td><?php echo $rows['InsulinIII'];?></td>
                                            <td><?php echo $rows['HighBloodPressure'];?></td>
                                             <td><?php echo $rows['Drug'];?></td>
                                            <td>

                            </td>
                                        </tr>
<?php } ?>
                                    </tbody>
                                </table>
                                     </form>
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