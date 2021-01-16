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
    <title>Stock Transfer - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Stock Transfer</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="StockTransferSubmit.php" method="POST">
                    <br><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CONTRACT NO# FROM:</label>
                                <select name="contractnofrom" id="contractnofrom" class="form-control" required>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CONTRACT NO# TO:</label>
                                <select name="contractnoto" id="" class="form-control" required>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Variety:</label>
                                <select class="form-control" name="itemvariety" required>
                                    <option selected disabled>Select Variety</option>
                                    <option value="1121 Kainaat">1121 Kainaat</option>
                                    <option value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab
                                    </option>
                                    <option value="Rice 386 Basmati">Rice 386 Basmati</option>
                                    <option value="Rice 386 Supri">Rice 386 Supri</option>
                                    <option value="Super Fine">Super Fine</option>
                                    <option value="Irri 9-C9">Irri 9-C9</option>
                                    <option value="Irri 6">Irri 6</option>
                                    <option value="D-98">D-98</option>
                                    <option value="KS-282">KS-282</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Item Name:</label>
                                <select class="form-control" type="text" name="itemname">
                                    <option selected disabled>Select Item</option>
                                    <option value="Final">Final</option>
                                    <option value="Short grain">Short grain</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="CSR">CSR</option>
                                    <option value="Broken CSR">Broken CSR</option>
                                    <option value="Peddy">Peddy</option>
                                    <option value="Powder">Powder</option>
                                    <option value="Choba">Choba</option>
                                    <option value="Sweeping">Sweeping</option>
                                    <option value="Stones">Stones</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bags:</label>
                                <input type="number" name="bagstransfer" id="bagstransfer" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" id="submitbtn" class="btn btn-success">Submit</button>
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
    $('#headername').html("Stock Transfer");
    </script>

    <script>
    $('#bagstransfer').on('change', function() {
        var id = $('#contractnofrom').val();
        var bags = $(this).val();
        // alert(id);
        $.ajax({
            type: 'POST',
            url: 'CheckNoOfBags.php',
            data: 'ContractId=' + id,
            success: function(response) {
                // alert(response);
                var totalbags = parseInt(response);
                var remaining = parseInt(totalbags) - parseInt(bags);
                if (remaining < 0) {
                    alert('Not Enough Bags');
                    $('#submitbtn').prop('disabled', true);
                } else {
                    $('#submitbtn').prop('disabled', false);
                }
            },
        });
    })
    </script>

</body>

</html>