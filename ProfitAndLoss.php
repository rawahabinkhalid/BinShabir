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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Year:</label>
                            <select name="dateyear" id="dateyear" class="form-control" required>
                                <option selected disabled value="">Please select a Year</option>
                                <?php for ($i = 2030; $i >= 2010; $i--) {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Month:</label>
                            <select name="datemonth" id="datemonth" class="form-control">
                                <option selected disabled value="">Please select a Month</option>
                                <?php
                                $month = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];
                                for ($i = 0; $i < count($month); $i++) {
                                    echo '<option value="';
                                    echo strlen(strval($i + 1)) == 1 ? '0' . ($i + 1) : $i + 1;
                                    echo '">' . $month[$i] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label style="width: 100%; visibility: hidden">Button</label>
                            <button type="button" name="filterBtn" id="filterBtn" class="btn btn-primary"
                                style="width: 180px; float: right">
                                Filter
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>OVER ALL INCOME</u></b></h3>
                    </div>

                    <div class="col-md-12 mt-4">
                        <!-- category wise income total table start -->
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Weighbridge </b></th>
                                    <th scope="col"><b>Biltybills </b></th>
                                    <th scope="col"><b>Toolmilling (Processing)</b></th>
                                    <th scope="col"><b>SelfManufacturing (Income)</b></th>
                                    <th scope="col"><b>Total</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo'<tr>';
                                    $income_Total = 0;

                                    $sql1 = 'SELECT *, SUM(Amount) AS Total_weighbridge FROM overallprofit WHERE `Description` = "WeighBridge" ';
                                    $result1 = mysqli_query($conn,$sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    echo'
                                        <td id="all_weighbridge">'.number_format($row1['Total_weighbridge']).'</td>
                                    ';

                                    $sql2 = 'SELECT *, SUM(Amount) AS Total_biltybills FROM overallprofit WHERE `Description` = "BiltyBills" ';
                                    $result2 = mysqli_query($conn,$sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    echo'
                                        <td id="all_biltybills">'.number_format($row2['Total_biltybills']).'</td>
                                    ';

                                    $sql3 = 'SELECT *, SUM(Amount) AS Total_toolmilling FROM overallprofit WHERE `Description` = "Tool Milling" ';
                                    $result3 = mysqli_query($conn,$sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    echo'
                                        <td id="all_toolmillingProcessing">'.number_format($row3['Total_toolmilling']).'</td>
                                    ';

                                    $sql4 = 'SELECT *, SUM(Amount) AS Total_selfManufacturing FROM overallprofit WHERE `Description` = "SM Income" ';
                                    $result4 = mysqli_query($conn,$sql4);
                                    $row4 = mysqli_fetch_assoc($result4);
                                    echo'
                                        <td id="all_selfManufacturingIncome">'.number_format($row4['Total_selfManufacturing']).'</td>
                                    '; 
                                    
                                    $income_Total = floatval($income_Total) + floatval($row1['Total_weighbridge']) + floatval($row2['Total_biltybills']) + floatval($row3['Total_toolmilling']) + floatval($row4['Total_selfManufacturing']);

                                echo'
                                        <td id="income_Total">'.number_format($income_Total).'</td>
                                </tr>';
                                ?>
                            </tbody>
                        </table>
                        <!-- category wise income total table end -->

                        <!-- overall income total table start -->
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalIncome = 0;
                                $sql = 'SELECT *, SUM(Amount) FROM overallprofit ';
                                $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo'
                                    <tr>
                                        <td id="all_income">'.number_format($row['SUM(Amount)'], 2).'</td>
                                    </tr>';
                                    $totalIncome = floatval($totalIncome) + floatval($row['SUM(Amount)']);
                            ?>
                            </tbody>
                        </table>
                        <!-- overall income total table end -->
                        <br>
                    </div>
                </div>

                <div class="row" id="" style="">
                    <div class="col-md-12 text-center">
                        <h3><b><u>OVER ALL EXPENSE</u></b></h3>
                    </div>

                    <div class="col-md-12 mt-4">
                        <!-- category wise expense total table start -->
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Other Expense </b></th>
                                    <th scope="col"><b>Toolmilling (Labour)</b></th>
                                    <th scope="col"><b>SelfManufacturing (Expense)</b></th>
                                    <th scope="col"><b>Total</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo'<tr>';
                                    $expense_Total = 0;

                                    $sql1 = 'SELECT *, SUM(Amount) AS Total_otherexpense FROM overallloss WHERE `Description` = "OtherExpnse" ';
                                    $result1 = mysqli_query($conn,$sql1);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    echo'
                                        <td id="all_otherexpense">'.number_format($row1['Total_otherexpense']).'</td>
                                    ';

                                    $sql2 = 'SELECT *, SUM(Amount) AS Total_toolmilling FROM overallloss WHERE `Description` = "Tool Milling" ';
                                    $result2 = mysqli_query($conn,$sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    echo'
                                        <td id="all_toolmillingLabour">'.number_format($row2['Total_toolmilling']).'</td>
                                    ';

                                    $sql3 = 'SELECT *, SUM(Amount) AS Total_selfManufacturing FROM overallloss WHERE `Description` = "SM Expense" ';
                                    $result3 = mysqli_query($conn,$sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    echo'
                                        <td id="all_selfManufacturingExpense">'.number_format($row3['Total_selfManufacturing']).'</td>
                                    '; 
                                    
                                    $expense_Total = floatval($expense_Total) +  floatval($row1['Total_otherexpense']) + floatval($row2['Total_toolmilling']) + floatval($row3['Total_selfManufacturing']);

                                echo'
                                        <td id="expense_Total">'.number_format($expense_Total).'</td>
                                </tr>';
                                ?>
                            </tbody>
                        </table>
                        <!-- category wise expense total table end -->

                        <!-- overall expense total table start -->
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $totalExpense = 0;
                                $sql = 'SELECT *, SUM(Amount) FROM overallloss';
                                $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo'
                                    <tr>
                                        <td id="all_expense">'.number_format($row['SUM(Amount)'], 2).'</td>
                                    </tr>';
                                    $totalExpense = floatval($totalExpense) + floatval($row['SUM(Amount)']);
                            ?>
                            </tbody>
                        </table>
                        <!-- overall expense total table end -->

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
                                    <th scope="col"><b>Amount</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                echo'
                                <tr>
                                    <td id="total_profit_loss">'.number_format(floatval(floatval($totalIncome) - floatval($totalExpense)), 2).'</td>
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

    <!-- Year/Month filter start -->
    <script>
    $('#filterBtn').on('click', function() {
        if ($('#dateyear').val() != '' && $('#dateyear').val() != undefined && $('#dateyear').val() != null) {
            var data = 'yearFilter=' + $('#dateyear').val();

            if ($('#datemonth').val() != '' && $('#datemonth').val() != undefined && $('#datemonth').val() != null) {
               data += '&monthFilter=' + $('#datemonth').val();
            }

            $.ajax({
                type: 'POST',
                url: 'get_profit_and_loss.php',
                data: data,
                success: function(response) {
                    console.log(response);

                    let obj = JSON.parse(response);
                    $('#all_income').html(numberWithCommas(obj.totalIncome));
                    $('#all_expense').html(numberWithCommas(obj.totalExpense));

                    var profit_loss = parseFloat(obj.totalIncome) - parseFloat(obj.totalExpense);
                    if(profit_loss < 0)
                        profit_loss = '(' + numberWithCommas(Math.abs(profit_loss)) + ')';
                    else
                        profit_loss = numberWithCommas(profit_loss);
                        
                    $('#total_profit_loss').html(profit_loss);
                },
            });
            
            $.ajax({
                type: 'POST',
                url: 'get_Categorywise_profit_and_loss.php',
                data: data,
                success: function(response) {
                    console.log(response);

                    let obj = JSON.parse(response);
                    $('#all_weighbridge').html(numberWithCommas(obj.totalWeighbridge));
                    $('#all_biltybills').html(numberWithCommas(obj.totalBiltybills));
                    $('#all_toolmillingProcessing').html(numberWithCommas(obj.totalToolmillingProcessing));
                    $('#all_selfManufacturingIncome').html(numberWithCommas(obj.totalSelfManufacturingIncome));
                    $('#income_Total').html(numberWithCommas(obj.masterTotalIncome));


                    $('#all_otherexpense').html(numberWithCommas(obj.totalOtherexpense));
                    $('#all_toolmillingLabour').html(numberWithCommas(obj.totalToolmillingLabour));
                    $('#all_selfManufacturingExpense').html(numberWithCommas(obj.totalSelfManufacturingExpense));
                    $('#expense_Total').html(numberWithCommas(obj.masterTotalExpense));
                    
                },
            });
            
        } 
        else if ($('#datemonth').val() != '' && $('#datemonth').val() != undefined && $('#datemonth').val() != null) {
            alert('Please select a Year');
        }
    })
    
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '.00';
    }
    </script>
    <!-- Year/Month filter start -->


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