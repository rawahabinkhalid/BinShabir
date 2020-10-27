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
    <title>Production - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Production</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="Production_Goods_Submit.php" method="POST">
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contract #:</label>
                                <select class="form-control" name="contractno" id="contractno" required>
                                    <option selected disabled>Select Contract No</option>
                                    <?php
                                        $sql = 'SELECT * FROM makecontract';
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo'
                                            <option value="'.$row['ContractNo'].'">'.$row['ContractNo'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
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
                        <!--
                        <div class="col-md-4">
                            <label>Date :</label>
                            <input class="form-control" type="date" name="reportdate"
                                value="<?php //echo date("Y-m-d") ?>">
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h3><b><u>GOODS RECIEVED FOR MILLING</u></b></h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date :</label>
                            <input class="form-control" type="date" name="date">
                        </div>
                        <div class="col-md-4">
                            <label>GRN# :</label>
                            <input class="form-control" type="text" name="GRN">
                        </div>
                        <div class="col-md-4">
                            <label>Vehicle# :</label>
                            <input class="form-control" type="text" name="vehicle">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name :</label>
                                <select class="form-control" name="itemname" required>
                                    <option selected disabled>Select Item Name</option>
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
                            <label>Bags :</label>
                            <input class="form-control" type="text" name="Bags">
                        </div>
                        <div class=" col-md-2">
                            <label>Packing :</label>
                            <input class="form-control" type="text" name="Packing">
                        </div>
                        <div class=" col-md-2">
                            <label>BardanaWeight :</label>
                            <input class="form-control" type="text" name="bardanaweight" id="bardanaweight">
                        </div>
                        <div class="col-md-2">
                            <label>Gross Weight :</label>
                            <input class="form-control" type="text" name="Nweight" id="Nweight">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-2">
                            <label>Gross Weight :</label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="text" value="0" id="totalgrossweight" readonly>
                            <input class="form-control" type="hidden" value="0" id="totalgrossweightDefault">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class=" col-md-2">
                            <label>Less: Bardana Weight </label>
                        </div>
                        <div class=" col-md-4">
                            <input class="form-control" type="text" value="0" id="totalbardanaweight" readonly>
                            <input class="form-control" type="hidden" value="0" id="totalbardanaweightDefault">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-2">
                            <label>N.Weight Processed :</label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="text" id="nweight_processed" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
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
    $('#headername').html("Production");
    </script>

    <script>
    $('#totalgrossweight').on('change', function() {
        calculateNetWeight();
    })
    $('#totalbardanaweight').on('change', function() {
        calculateNetWeight();
    })

    calculateNetWeight();

    function calculateNetWeight() {
        var t_g_weight = $('#totalgrossweight').val();
        var t_b_weight = $('#totalbardanaweight').val();
        if (t_g_weight != '' && t_b_weight != '')
            $('#nweight_processed').val(parseFloat(t_g_weight) - parseFloat(t_b_weight))
    }
    </script>


    <script>
    $('#Nweight').on('change', function() {
        var Nweight = parseFloat($(this).val());

        if (parseFloat($('#totalgrossweightDefault').val()) > 0 && !isNaN(Nweight))
            $('#totalgrossweight').val(parseFloat($('#totalgrossweightDefault').val()) + Nweight);
        else if (!isNaN(Nweight))
            $('#totalgrossweight').val(Nweight);
        else
            $('#totalgrossweight').val($('#totalgrossweightDefault').val());

        var t_g_weight = $('#totalgrossweight').val();
        var t_b_weight = $('#totalbardanaweight').val();
        if (t_g_weight != '' && t_b_weight != '')
            $('#nweight_processed').val(parseFloat(t_g_weight) - parseFloat(t_b_weight))
    })

    $('#bardanaweight').on('change', function() {
        var bardanaweight = parseFloat($(this).val());

        if (!isNaN(parseFloat($('#totalbardanaweightDefault').val())) && parseFloat($(
                '#totalbardanaweightDefault').val()) > 0 && !isNaN(bardanaweight)) {
            $('#totalbardanaweight').val(parseFloat($('#totalbardanaweightDefault').val()) + bardanaweight);
        } else if (!isNaN(bardanaweight)) {
            $('#totalbardanaweight').val(bardanaweight);
        } else {
            $('#totalbardanaweight').val($('#totalbardanaweightDefault').val());
        }

        var t_g_weight = $('#totalgrossweight').val();
        var t_b_weight = $('#totalbardanaweight').val();
        if (t_g_weight != '' && t_b_weight != '')
            $('#nweight_processed').val(parseFloat(t_g_weight) - parseFloat(t_b_weight))
    })
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

                $('#partyname').val(json_response.CustomerName);
                $('#item_name').val(json_response.Variety);
            },
        });

        refreshtotal();
    })

    function refreshtotal() {
        var contractno = $('#contractno').val();

        if (contractno != '') {
            $.ajax({
                type: 'POST',
                url: 'Production_get_Partyname_Itemname.php',
                data: 'contractno=' + contractno,
                success: function(response) {
                    console.log(response);

                    var json_response = JSON.parse(response);
                    $('#totalgrossweight').val(json_response.NWeight)
                    $('#totalgrossweightDefault').val(json_response.NWeight)
                    $('#totalbardanaweight').val(json_response.BardanaWeight)
                    $('#totalbardanaweightDefault').val(json_response.BardanaWeight)
                    $('#nweight_processed').val(parseFloat(json_response.NWeight) - parseFloat(json_response
                        .BardanaWeight))
                },
            });
        }
    }
    </script>

</body>

</html>