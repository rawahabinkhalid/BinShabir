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
    <title>Gate Passes - Dashboard</title>
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

        .itembutton {

            font-size: 18px;
            color: #9C4BEB;
            background: transparent;
            border: 2px solid #9C4BEB;
            border-radius: 15px 15px 15px 15px;
            padding: 4px;
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
                                    <li class="breadcrumb-item active">Gate Passes</li>
                                </ol>
                            </div>
                            <h4 class="page-title" style="font-weight: bold;  font-size: 25px;">Good Issue Note</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="GatePass_GoodIssueSubmit.php" method="POST">
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contract #:</label>
                                <select name="contractno" id="contractno" class="form-control">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>GIN NO # :</label>
                                <?php
                                $sql = 'SELECT MAX(Id) as maxid FROM gatepass_g_issue';
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $count = $row['maxid'] + 1;
                                } else {
                                    $count = 1;
                                }

                                echo '
                                <input type="text" name="GINNo" value="' . $count++ . '" class="form-control" readonly>'
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name Of Consignee:</label>
                                <input type="text" name="nameofconsignee" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vehicle No:</label>
                                <input type="text" name="VehicleNo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vehicle Type:</label>
                                <input type="text" name="VehicleType" id="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Container No:</label>
                                <input type="text" name="ContainerNo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Seal No:</label>
                                <input type="text" name="SealNo" class="form-control" required>
                            </div>
                        </div>
                    </div> <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Items:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Description:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Lot No / Contract No:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Pack Size & Type:</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Quantity:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Weight :</label>
                            </div>
                        </div>
                    </div>
                    <div id="items">
                        <!-- <div class="row" id="GoodIssueNote_row_0" name="GoodIssue_rows">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="Items[]">
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="Description[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="LabNo[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="Packsize[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <input type="text" name="Quantity[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="Weight[]" class="form-control">
                                </div>
                            </div>
                        </div> -->
                    </div><br>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-2">
                            <input name="addFieldButton" type="button" value="+Add Item" onclick="addField();" class="form-control itembutton">
                        </div>
                        <div class="col-3">
                            <input name="delFieldButton" type="button" value="+Remove Item" onclick="delField();" class="form-control itembutton">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
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
        $('#headername').html("Gate Passes");
    </script>

    <!-- script of add_Item_button/del_Item_button work -->
    <script>
        counter = -1;

        function addField() {
            counter++;

            var content = '';
            content += '<div class="row" id="GoodIssueNote_row_' + counter + '" name="GoodIssue_rows">';
            content += '    <div class="col-md-3">';
            content += '        <div class="form-group">';
            content += '            <select class="form-control" name="Items[]">';
            content += '                <option selected disabled>Select Variety</option>';
            content += '                <option value="1121 Kainaat">1121 Kainaat</option>';
            content +=
                '                <option value="Super Kernal Basmati Sindh-Punjab">Super Kernal Basmati Sindh-Punjab </option>';
            content += '                <option value="Rice 386 Basmati">Rice 386 Basmati</option>';
            content += '                <option value="Rice 386 Supri">Rice 386 Supri</option>';
            content += '                <option value="Super Fine">Super Fine</option>';
            content += '                <option value="Irri 9-C9">Irri 9-C9</option>';
            content += '                <option value="Irri 6">Irri 6</option>';
            content += '                <option value="D-98">D-98</option>';
            content += '                <option value="KS-282">KS-282</option>';
            content += '            </select>';
            content += '        </div>';
            content += '    </div>';
            content += '    <div class="col-md-2">';
            content += '        <div class="form-group">';
            content += '            <input type="text" name="Description[]" class="form-control">';
            content += '        </div>';
            content += '    </div>';
            content += '    <div class="col-md-2">';
            content += '        <div class="form-group">';
            content += '            <input type="text" name="LabNo[]" class="form-control">';
            content += '        </div>';
            content += '    </div>';
            content += '    <div class="col-md-2">';
            content += '        <div class="form-group">';
            content += '            <input type="text" name="Packsize[]" class="form-control">';
            content += '        </div>';
            content += '    </div>';
            content += '    <div class="col-md-1">';
            content += '        <div class="form-group">';
            content += '            <input type="text" name="Quantity[]" class="form-control">';
            content += '        </div>';
            content += '    </div>';
            content += '    <div class="col-md-2">';
            content += '        <div class="form-group">';
            content += '            <input type="text" name="Weight[]" class="form-control">';
            content += '        </div>';
            content += '    </div>';
            content += '</div>';
            $('#items').append(content);
        }

        function delField() {
            $("#GoodIssueNote_row_" + counter).remove();
            counter--;
        }
    </script>
</body>

</html>