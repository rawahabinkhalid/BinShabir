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

    table tr th {
        background-color: #33F3FF;
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
                        <h3><b><u>GOODS RECIEVED NOTE</u></b></h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="name_select">
                            <div class="form-group">
                                <label>GRN NO # :</label>
                                <select class="form-control" name="GRNNo" id="GRNNo" required>
                                    <option selected disabled value="">Select GRN No</option>
                                    <?php
                                        $sql = 'SELECT * FROM gatepass_g_recieved';
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo'
                                            <option value="'.$row['GRN_No'].'">'.$row['GRN_No'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- print ke time pr ye visible hoga GRN NO (start) -->
                        <div class="col-md-4" id="print_grnno" style="display: none">
                            <div class="form-group">
                                <label>GRN No #:</label>
                                <input type="text" name="grn_no" id="grn_no" value="" class="form-control">
                            </div>
                        </div>
                        <!-- (end) -->
                    </div>
                    <div class="row" id="goodrecievednoteReport" style="display:none">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Contract No# :</label>
                                <input type="text" name="contractno" id="contractno" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Party Name:</label>
                                <input type="text" name="partyname" id="partyname" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date:</label>
                                <input type="date" name="date" id="date" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Time In:</label>
                                <input type="time" name="timein" id="timein" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Vehicle No:</label>
                                <input type="text" name="vehicleNo" id="vehicleNo" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CHALKY:</label>
                                <input type="text" name="chalky" id="chalky" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>B-1:</label>
                                <input type="text" name="b1" id="b1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>B-2:</label>
                                <input type="text" name="b2" id="b2" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>B-3:</label>
                                <input type="text" name="b3" id="b3" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>D/D:</label>
                                <input type="text" name="dd" id="dd" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>SHV:</label>
                                <input type="text" name="shv" id="shv" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>RED STRIPE/UM:</label>
                                <input type="text" name="redstripe" id="redstripe" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>CHOBA:</label>
                                <input type="text" name="choba" id="choba" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>OV:</label>
                                <input type="text" name="ov" id="ov" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>MOISTURE:</label>
                                <input type="text" name="moisture" id="moisture" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>COOKING:</label>
                                <input type="text" name="cooking" id="cooking" class="form-control">
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
                                        <th scope="col">Ex Weight</th>
                                        <th scope="col">Weight</th>
                                    </tr>
                                </thead>
                                <tbody id="goodrecieveddata">

                                </tbody>
                                <tfoot id="goodrecieveddata_tfoot"></tfoot>
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
    $('#GRNNo').on('change', function() {
        var GRNNo = $(this).val();

        $('#goodrecieveddata').html('');
        $('#goodrecieveddata_tfoot').html('');

        if (GRNNo !== null && GRNNo !== '') {
            $.ajax({
                type: 'POST',
                url: 'get_GatePass_recieved_ReportData.php',
                data: 'GRN_NO=' + GRNNo,
                success: function(response) {
                    console.log(response);

                    $('#grn_no').val(GRNNo);

                    var json_response = JSON.parse(response);

                    $('#goodrecieveddata').html(json_response.tbody);
                    $('#goodrecieveddata_tfoot').html(json_response.tfoot);

                    $('#contractno').val(json_response.contract_no);                    
                    $('#partyname').val(json_response.party_name);
                    $('#date').val(json_response.date);
                    $('#timein').val(json_response.timein);
                    $('#vehicleNo').val(json_response.vehicleno);
                    $('#chalky').val(json_response.Chalky);
                    $('#b1').val(json_response.B1);
                    $('#b2').val(json_response.B2);
                    $('#b3').val(json_response.B3);
                    $('#dd').val(json_response.DD);
                    $('#shv').val(json_response.Shv);
                    $('#redstripe').val(json_response.RedStripe);
                    $('#choba').val(json_response.Choba);
                    $('#ov').val(json_response.Ov);
                    $('#moisture').val(json_response.Moisture);
                    $('#cooking').val(json_response.Cooking);

                    $('#goodrecievednoteReport').show();
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

        var printButton = document.getElementById("print_grnno");
        //Set the print button to 'visible' again 
        printButton.style.display = '';

        //Print the page content
        window.print()

    }
    </script>

</body>

</html>