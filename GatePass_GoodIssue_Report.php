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
    <title>GatePass Report - Dashboard</title>
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
    <style>
    label {
        font-weight: bold;
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
                                    <li class="breadcrumb-item active">GatePasses Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="" method="">
                    <br>
                    <div class="col-md-12 text-center">
                        <h3><b><u>GOODS ISSUE NOTE</u></b></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="name_select">
                            <div class="form-group">
                                <label>GIN NO # :</label>
                                <select class="form-control" name="GINNo" id="GINNo" required>
                                    <option selected disabled value="">Select GIN No</option>
                                    <?php
                                        $sql = 'SELECT * FROM gatepass_g_issue';
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo'
                                            <option value="'.$row['GIN_No'].'">'.$row['GIN_No'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- print ke time pr ye visible hoga GIN NO (start) -->
                        <div class="col-md-4" id="print_ginno" style="display: none">
                            <div class="form-group">
                                <label>GIN No #:</label>
                                <input type="text" name="gin_no" id="gin_no" value="" class="form-control">
                            </div>
                        </div>
                        <!-- (end) -->
                    </div>
                    <div class="row" id="goodissuenoteReport" style="display:none">
                        <div class="col-md-9"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name Of Consignee:</label>
                                <input type="text" name="nameofconsignee" id="nameofconsignee" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vehicle No:</label>
                                <input type="text" name="VehicleNo" id="VehicleNo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vehicle Type:</label>
                                <input type="text" name="VehicleType" id="VehicleType" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Container No:</label>
                                <input type="text" name="ContainerNo" id="ContainerNo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Seal No:</label>
                                <input type="text" name="SealNo" id="SealNo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Lot No. / Contract No.</th>
                                        <th scope="col">Pack Size & Type</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Weight</th>
                                    </tr>
                                </thead>
                                <tbody id="goodissuedata">

                                </tbody>
                                <tfoot id="goodissuedata_tfoot"></tfoot>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <input class="btn btn-success" id="printpagebutton" type="button" value="Print"
                                    onclick="printpage()" />
                            </div>
                        </div>
                    </div>
                </form>
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
    //headername
    $('#headername').html("GatePasses Report");
    </script>

    <script>
    $('#GINNo').on('change', function() {
        var GINNo = $(this).val();

        $('#goodissuedata').html('');
        $('#goodissuedata_tfoot').html('');

        if (GINNo !== null && GINNo !== '') {
            $.ajax({
                type: 'POST',
                url: 'get_GatePass_issue_ReportData.php',
                data: 'GIN_NO=' + GINNo,
                success: function(response) {
                    console.log(response);

                    $('#gin_no').val(GINNo);

                    var json_response = JSON.parse(response);

                    $('#goodissuedata').html(json_response.tbody);
                    $('#goodissuedata_tfoot').html(json_response.tfoot);

                    $('#nameofconsignee').val(json_response.nameofconsignee);
                    $('#VehicleNo').val(json_response.vehicleno);
                    $('#VehicleType').val(json_response.vehicletype);
                    $('#ContainerNo').val(json_response.containerno);
                    $('#SealNo').val(json_response.sealno);

                    $('#goodissuenoteReport').show();
                },
            });
        }
    })
    </script>


    <!-- Print Document -->
    <script type="text/javascript">
    function printpage() {

        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.display = 'none';

        var printButton = document.getElementById("name_select");
        //Set the print button visibility to 'hidden' 
        printButton.style.display = 'none';

        var printButton = document.getElementById("print_ginno");
         //Set the print button to 'visible' again 
         printButton.style.display = '';

        //Print the page content
        window.print()

    }
    </script>


</body>

</html>