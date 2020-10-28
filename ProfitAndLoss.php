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
    <title>Profit And Loss Report - Dashboard</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <style>
    label {
        font-weight: bold;
    }

    table tr th {
        background-color: #33F3FF;
    }

    .table-bordered td,
    .table-bordered th {
        border-color: black !important;
    }
    </style>
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
                                    <li class="breadcrumb-item active">PNL Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <br>
                <!-- end page title end breadcrumb -->
                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>OVER ALL INCOME</u></b></h3>
                    </div>
                    
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $totalIncome = 0;
                                $count = 1;
                                $sql = 'SELECT *, SUM(Amount) FROM overallprofit ';
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo'
                                    <tr>
                                        <td scope="row"><b>'.$count++.'</b></td>
                                        <td>'.number_format($row['SUM(Amount)'], 2).'</td>
                                    </tr>';
                                    $totalIncome = floatval($totalIncome) + floatval($row['SUM(Amount)']);
                                }
                            ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>

                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>OVER ALL EXPENSE</u></b></h3>
                    </div>
                    
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $totalExpense = 0;
                                $count = 1;
                                $sql = 'SELECT *, SUM(Amount) FROM overallloss';
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    echo'
                                    <tr>
                                        <td scope="row"><b>'.$count++.'</b></td>
                                        <td>'.number_format($row['SUM(Amount)'], 2).'</td>
                                    </tr>';
                                    $totalExpense = floatval($totalExpense) + floatval($row['SUM(Amount)']);
                                }
                            ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>

                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>TOTAL PROFIT AND LOSS</u></b></h3>
                    </div>
                    
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $count = 1;
                                echo'
                                <tr>
                                    <td scope="row"><b>'.$count++.'</b></td>
                                    <td>'.number_format(floatval(floatval($totalIncome) - floatval($totalExpense)), 2).'</td>
                                </tr>';
                            ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <input class="btn btn-success" id="printpagebutton" type="button" value="Print"
                            onclick="printpage()" />
                    </div>
                </div>
                <br>
                <br>
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

    <script>
    $('#headername').html("Profit And Loss Report");
    </script>

    <!-- Print Document -->
    <script type="text/javascript">
    function printpage() {

        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';

        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        printButton.style.visibility = 'visible';
    }
    </script>

</body>

</html>