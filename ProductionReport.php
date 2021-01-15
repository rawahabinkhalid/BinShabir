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
    <title>Production Report - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Production Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action=".php" method="POST">
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center" id="view_logo" style="display:none; padding-bottom: 30px;">
                            <h3><img src="logo/ricemilllogo1.png" style="width: 300px;" alt=""></h3>
                        </div>
                        <div class="col-md-4" id="contract">
                            <div class="form-group">
                                <label>Contract #:</label>
                                <select class="form-control" name="contractno" id="contractno" required>
                                    <option selected disabled>Select Contract</option>
                                    <optgroup class="bg-success" label="Debtor/AccountReceivable/Sales"></optgroup>
                                    <?php
                                    $sql = 'SELECT * FROM debtor';
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ContractNo'] . '">' . $row['ContractNo'] . '</option>';
                                        }
                                    }
                                    ?>

                                    <optgroup class="bg-success" label="Creditor/AccountPayable/Purchase"></optgroup>
                                    <?php
                                    $sql = 'SELECT * FROM creditor';
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ContractNo'] . '">' . $row['ContractNo'] . '</option>';
                                        }
                                    }
                                    ?>

                                    <optgroup class="bg-success" label="Sales"></optgroup>
                                    <?php
                                    $sql = 'SELECT * FROM toolmillcontract';
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ContractNo'] . '">' . $row['ContractNo'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- print ke time pr ye visible hoga Contract No (start) -->
                        <div class="col-md-4" id="print_contractno" style="display: none">
                            <div class="form-group">
                                <label>Contract No #:</label>
                                <input type="text" name="contract_no" id="contract_no" value="" class="form-control">
                            </div>
                        </div>
                        <!-- (end) -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party Name :</label>
                                <input type="text" class="form-control" name="partyname" id="partyname" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name :</label>
                                <input type="text" class="form-control" name="item_name" id="item_name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="goodrecievedformilling" style="display:none">
                        <div class="col-md-12 text-center">
                            <h3><b><u>GOODS RECIEVED FOR MILLING</u></b></h3>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">GRN#</th>
                                        <th scope="col">Vehicle#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Bags</th>
                                        <th scope="col">Packing</th>
                                        <th scope="col">N.Weight</th>
                                    </tr>
                                </thead>
                                <tbody id="goodsdata">

                                </tbody>
                                <tfoot id="goodsdata_tfoot"></tfoot>
                            </table>
                        </div>

                        <div class="col-md-12 text-center">
                            <h3><b><u>MILLING DETAIL</u></b></h3>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">%</th>
                                        <th scope="col">Bags</th>
                                        <th scope="col">KG</th>
                                        <th scope="col">N.Weight</th>
                                    </tr>
                                </thead>
                                <tbody id="millingdetails">

                                </tbody>
                                <tfoot id="millingdetails_tfoot"></tfoot>
                            </table>
                        </div>

                        <div class="col-md-12 text-center">
                            <h3><b><u>MILLING BILL</u></b></h3>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Head</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Amount ( Rs. )</th>
                                    </tr>
                                </thead>
                                <tbody id="millingbill">

                                </tbody>
                                <tfoot id="millingbill_tfoot"></tfoot>
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
    $('#headername').html("Production Report");
    </script>

    <script>
    $('#contractno').on('change', function() {
        var contractno = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'get_partyname_itemname.php',
            data: 'contractno=' + contractno,
            success: function(response) {
                console.log(response);

                var json_response = JSON.parse(response);

                $('#partyname').val(json_response.PartyName);
                $('#item_name').val(json_response.Variety);
            },
        });

        get_production_ReportData();
    })
    </script>

    <script>
    function get_production_ReportData() {
        $('#goodsdata').html('');
        $('#goodsdata_tfoot').html('');

        $('#millingdetails').html('');
        $('#millingdetails_tfoot').html('');

        $('#millingbill').html('');
        $('#millingbill_tfoot').html('');

        var contractno = $('#contractno').val();

        if (contractno !== null && contractno !== '') {
            $.ajax({
                type: 'POST',
                url: 'get_production_ReportData.php',
                data: 'contractno=' + encodeURIComponent(contractno),
                success: function(response) {
                    console.log(response);

                    $('#contract_no').val(contractno);

                    var json_response = JSON.parse(response);

                    $('#goodrecievedformilling').show();

                    $('#goodsdata').html(json_response.tbody);
                    $('#goodsdata_tfoot').html(json_response.tfoot);

                    $('#millingdetails').html(json_response.tbody1);
                    $('#millingdetails_tfoot').html(json_response.tfoot1);

                    $('#millingbill').html(json_response.tbody2);
                    $('#millingbill_tfoot').html(json_response.tfoot2);

                },
            });
        }
    }
    </script>


    <!-- Print Document -->
    <script type="text/javascript">
    function printpage() {

        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';

        var contract = document.getElementById("contract");
        //Set the contract button visibility to 'hidden' 
        contract.style.display = 'none';

        var printcontractno = document.getElementById("print_contractno");
        //Set the printcontractno button to 'visible' again 
        printcontractno.style.display = '';

        var viewlogo = document.getElementById("view_logo");
        //Set the viewlogo to 'visible' 
        viewlogo.style.display = '';

        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
        viewlogo.style.display = 'none';



    }
    </script>

</body>

</html>