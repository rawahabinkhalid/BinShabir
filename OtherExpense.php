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
    <title>Other Expense - Dashboard</title>
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
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

    <style>
    label {
        font-weight: bold;
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
                                    <li class="breadcrumb-item active">Other Expense</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>

                <div class="row" id="view_logo" style="display:none; margin-top: 10px; margin-bottom: -50px">
                    <div class="col-md-12 text-center" style="">
                        <h3><img src="logo/ricemilllogo1.png" style="width: 400px;" alt=""></h3>
                    </div>
                </div>

                <!-- end page title end breadcrumb -->
                <form action="OtherExpenseSubmit.php" method="POST">
                    <br><br>
                    <div class="row" id="formarea">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Head:</label>
                                <select name="expensehead" class="form-control" required>
                                    <option value="" selected disabled>Select Expense Head</option>
                                    <option value="Administrative Expense">Administrative Expense</option>
                                    <option value="Operational Expense">Operational Expense</option>
                                    <option value="General Expense">General Expense</option>
                                    <option value="Petty Expense">Petty Expense</option>
                                    <option value="Payroll Expense">Payroll Expense</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Description:</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date:</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount:</label>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="form-group">
                                <button type="submit" id="submitbtn" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2><u>Other Expense Details</u></h2>
                        </div>
                    </div>

                    <br>

                    <div class="row" id="datefilter">
                        <div class="col-md-6">
                            <div id="reportrange"
                                style="width: calc(100% - 100px) !important; display: inline-block; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                            <input type="hidden" class="form-control" name="daterange" id="daterange"
                                style="width: calc(100% - 100px); display: inline-block;" />
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" class="btn btn-primary" value="Filter" name="daterangeBtn"
                                id="daterangeBtn" style="width: 150px; display: inline-block;" />
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>S.No</b></th>
                                        <th scope="col"><b>Expense Head</b></th>
                                        <th scope="col"><b>Description</b></th>
                                        <th scope="col"><b>Date</b></th>
                                        <th scope="col"><b>Amount</b></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_table">
                                    <?php
                                        $count = 1;
                                        $sql = 'SELECT * FROM otherexpense';
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                            <tr>
                                                <td scope="row"><b>'.$count++.'</b></td>
                                                <td>'.$row['ExpenseHead'].'</td>
                                                <td>'.$row['Description'].'</td>
                                                <td>'.$row['Date'].'</td>
                                                <td>'.$row['Amount'].'</td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <input class="btn btn-success" id="printpagebutton" type="button" value="Print"
                                onclick="printpage()" />
                        </div>
                    </div>

                    <br><br>


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
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
    $('#headername').html("Other Expense");
    </script>

    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
    </script>


    <!-- Date Filter start-->
    <script type="text/javascript" src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript">
    $(function() {
        var temp_range = {
            // 'Please select Date Range': [],
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        };
        var start = ($('#daterange').val() != '') ? moment($('#daterange').val().split(" - ")[0]) : moment();
        var end = ($('#daterange').val() != '') ? moment($('#daterange').val().split(" - ")[1]) : moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#daterange').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'))
        }


        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: temp_range
        }, cb);

        cb(start, end);

    });

    $('.ranges ul li').on('click', function() {
        console.log($(this).attr('data-range-key'));
    })

    $('#daterangeBtn').on('click', function() {
        var dateFrom = $('#daterange').val().split(' - ')[0].replaceAll('/', '-');
        var dateTo = $('#daterange').val().split(' - ')[1].replaceAll('/', '-');
        console.log(dateFrom);
        console.log(dateTo);
        $.ajax({
            type: 'POST',
            url: 'get_Other_Expense_byDate.php',
            data: 'date_from=' + encodeURIComponent(dateFrom) + '&date_to=' + encodeURIComponent(
                dateTo),
            success: function(response) {
                console.log(response);
                $('.table').dataTable().fnDestroy();
                $('#tbody_table').html("");
                $('#tbody_table').html(response);
                $('.table').DataTable();
            },
        });
    })
    </script>
    <!-- Date Filter end-->

    <!-- Print Document -->
    <script type="text/javascript">
    function printpage() {

        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';

        var datefilter = document.getElementById("datefilter");
        //Set the datefilter button visibility to 'hidden' 
        datefilter.style.display = 'none';

        var form = document.getElementById("formarea");
        //Set the form visibility to 'hidden'         
        form.style.display = 'none';

        var viewlogo = document.getElementById("view_logo");
        //Set the viewlogo to 'visible' 
        viewlogo.style.display = '';

        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        printButton.style.visibility = 'visible';
        datefilter.style.display = '';
        form.style.display = '';
        viewlogo.style.display = 'none';

    }
    </script>


</body>

</html>