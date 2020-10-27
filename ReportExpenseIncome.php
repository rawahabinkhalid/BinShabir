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
    <title> Expense/Income Report - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Expense/Income Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="" method="POST">
                    <br>
                    <div class="row">
                        <div class="col-md-4" id="select_name">
                            <div class="form-group">
                                <label>Production #:</label>
                                <select class="form-control" name="productionno" id="productionno" required>
                                    <option selected disabled>Select Production No</option>
                                    <?php
                                        $sql = 'SELECT * FROM expense';
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo'
                                            <option value="'.$row['ProductionNo'].'">'.$row['ProductionNo'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- print ke time pr ye production no show krwana ha (start) -->
                        <div class="col-md-4" id="print_prodno" style="display: none">
                            <div class="form-group">
                                <label>Production No #:</label>
                                <input type="text" name="production_no" id="production_no" value="" class="form-control">
                            </div>
                        </div>
                        <!-- (end) -->
                    </div>
                    <div class="row" id="ownproduction_expense_income" style="display:none">
                        <div class="col-md-12 text-center">
                            <h3><b><u>EXPENSE DETAIL</u></b></h3>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Production#</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="expensedata">

                                </tbody>
                                <tfoot id="expensedata_tfoot"></tfoot>
                            </table>
                        </div>

                        <div class="col-md-12 text-center">
                            <h3><b><u>INCOME DETAIL</u></b></h3>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Production#</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="incomedata">

                                </tbody>
                                <tfoot id="incomedata_tfoot"></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <input class="btn btn-success" id="printpagebutton" type="button" value="Print"
                                onclick="printpage()" />
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
    $('#headername').html("Expense/Income Report");
    </script>

    <script>
    $('#productionno').on('change', function() {
        var productionno = $(this).val();
        get_ExpenseIncome_Data();
    })
    </script>

    <script>
    function get_ExpenseIncome_Data() {
        $('#expensedata').html('');
        $('#expensedata_tfoot').html('');

        $('#incomedata').html('');
        $('#incomedata_tfoot').html('');

        var productionno = $('#productionno').val();

        if (productionno !== null && productionno !== '') {
            $.ajax({
                type: 'POST',
                url: 'get_Expense_Income_Data.php',
                data: 'productionno=' + encodeURIComponent(productionno),
                success: function(response) {
                    console.log(response);

                    var json_response = JSON.parse(response);
                    console.log(json_response);
                    $('#ownproduction_expense_income').show();

                    $('#expensedata').html(json_response.tbody);
                    $('#expensedata_tfoot').html(json_response.tfoot);

                    $('#incomedata').html(json_response.tbody1);
                    $('#incomedata_tfoot').html(json_response.tfoot1);

                    $('#production_no').val(productionno);
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
        printButton.style.display = 'none';

        var printButton = document.getElementById("select_name");
        //Set the print button visibility to 'hidden' 
        printButton.style.display = 'none';
        
        var printButton = document.getElementById("print_prodno");
        //Set the print button to 'visible' again 
        printButton.style.display = '';

        //Print the page content
        window.print()
    }
    </script>

</body>

</html>