<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
}

include_once('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>RICEMILL - Dashboard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description">
    <meta content="Mannatthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Top Bar Start -->
    <?php
    include_once('header.php');
    ?>
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        <?php
            include_once('sidebar.php');
        ?>

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">RiceMill</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Rice Variety Available</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-sign-caution text-warning"></i></div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">1121 Kainaat</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "1121 Kainaat" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 55%;"
                                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-sign-caution text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">Super Kernal Basmati Sindh-Punjab</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Super Kernal Basmati Sindh-Punjab" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 39%;"
                                        aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-sign-caution text-warning"></i></div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted">Rice 386 Basmati</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Rice 386 Basmati" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?> 
                                            <!-- <span class="badge badge-soft-warning mt-1 shadow-none">Active</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;"
                                        aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-diamond-stone text-success"></i></div>
                                    </div>
                                    <div class="col-sm-8 col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">Rice 386 Supri</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Rice 386 Supri" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 22%;"
                                        aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-diamond-stone text-success"></i></div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">Super Fine</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Super Fine" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 55%;"
                                        aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-diamond-stone text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">Irri 9-C9</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Irri 9-C9" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 39%;"
                                        aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-rice text-pink"></i></div>
                                    </div>
                                    <div class="col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-0 text-muted">Irri 6</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "Irri 6" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-pink" role="progressbar" style="width: 48%;"
                                        aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-rice text-pink"></i></div>
                                    </div>
                                    <div class="col-sm-8 col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">D-98</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "D-98" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-pink" role="progressbar" style="width: 22%;"
                                        aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 col-4 align-self-center">
                                        <div class="icon-info"><i class="mdi mdi-rice text-pink"></i></div>
                                    </div>
                                    <div class="col-sm-8 col-8 align-self-center text-right">
                                        <div class="ml-2">
                                            <p class="mb-1 text-muted">KS-282</p>
                                            <?php
                                             $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo WHERE Variety = "KS-282" ';
                                             $result = mysqli_query($conn,$sql);
                                             if(mysqli_num_rows($result) > 0 ){
                                                $row = mysqli_fetch_assoc($result);
                                                    echo'
                                                       <h4 class="mt-0 mb-1">'.$row['TotalBags'].'</h4>
                                                    ';
                                             }
                                             else{
                                                echo'
                                                <h4 class="mt-0 mb-1"> 0 </h4>
                                             ';
                                             }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height:3px;">
                                    <div class="progress-bar bg-pink" role="progressbar" style="width: 22%;"
                                        aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!-- container -->
            <footer class="footer text-center text-sm-left">&copy; <b>2020 <a href="https://matz.group/"> MATZ SOLUTIONS
                        PVT.LTD</a> </b> <span class="text-muted d-none d-sm-inline-block float-right"></i> All Right
                    Reserved</span>
            </footer>
            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/waves.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <!--Plugins-->
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="assets/pages/jquery.projects_dashboard.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>