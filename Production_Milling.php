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
                <form action="Production_Milling_Submit.php" method="POST">
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
                        <!-- <div class="col-md-4">
                            <label>Date :</label>
                            <input class="form-control" type="date" name="reportdate"
                                value="<?php //echo date("Y-m-d") ?>">
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3><b><u>MILLING DETAIL</u></b></h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Item Name :</label>
                            <input class="form-control" type="text" name="milling_itemname">
                        </div>
                        <div class="col-md-8">
                            <label>Description :</label>
                            <input class="form-control" type="text" name="milling_desription">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label>% </label>
                            <input class="form-control" type="text" name="milling_percentage" id="milling_percentage">
                        </div>
                        <div class="col-md-4">
                            <label>Bags :</label>
                            <input class="form-control" type="text" name="milling_bags" id="bags" onkeyup="mul()">
                        </div>
                        <div class="col-md-2">
                            <label>KG :</label>
                            <input class="form-control" type="text" name="milling_kg" id="kg" onkeyup="mul()">
                        </div>
                        <div class="col-md-4">
                            <label>N.Weight :</label>
                            <input class="form-control" type="text" name="milling_Nweight" id="m_nweight" readonly>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" type="text" id="nweight_processed" hidden readonly>
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

    <!--  *,-,+,/ Two Input Box Number And Show in 3rd Box -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
    function mul() {
        var Bags = document.getElementById('bags').value;
        var Kg = document.getElementById('kg').value;
        var result = parseInt(Bags) * parseInt(Kg);
        if (!isNaN(result)) {
            document.getElementById('m_nweight').value = result;
        }


        var n_w_processed = $('#nweight_processed').val();
        var m_nweight = $('#m_nweight').val();
        if (m_nweight != '' && n_w_processed != '')
            $('#milling_percentage').val(parseFloat(m_nweight) / parseFloat(n_w_processed) * 100)

    }
    </script>

    <script>
    $('#m_nweight').on('change', function() {
        var m_nweight = $(this).val();
        var n_w_processed = $('#nweight_processed').val();
        if (m_nweight != '' && n_w_processed != '')
            $('#milling_percentage').val(parseFloat(m_nweight) / parseFloat(n_w_processed) * 100)
        alert(m_nweight);
    })
    $('#nweight_processed').on('change', function() {
        var n_w_processed = $(this).val();
        var m_nweight = $('#m_nweight').val();
        if (m_nweight != '' && n_w_processed != '')
            $('#milling_percentage').val(parseFloat(m_nweight) / parseFloat(n_w_processed) * 100)
        alert(n_w_processed);
    })

    // var n_w_processed = $('#nweight_processed').val();
    // var m_nweight = $('#m_nweight').val();
    // if (m_nweight != '' && n_w_processed != '')
    //     $('#milling_percentage').val(parseFloat(m_nweight) / parseFloat(n_w_processed) * 100)
    // ye kaam mul ke function me hoga
    </script>


    <script>
    $('#contractno').on('change', function() {
        var getcontractno = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'get_partyname_itemname.php',
            data: 'contractno=' + getcontractno,
            success: function(response) {
                console.log(response);

                var json_response = JSON.parse(response);

                $('#partyname').val(json_response.CustomerName);
                $('#item_name').val(json_response.Variety);
            },
        });

        get_ProductionGoods_Data();
    })

    function get_ProductionGoods_Data() {
        var contractno = $('#contractno').val();

        if (contractno !== null && contractno !== '') {
            $.ajax({
                type: 'POST',
                url: 'get_Production_goods_data.php',
                data: 'contractno=' + encodeURIComponent(contractno),
                success: function(response) {
                    $('#nweight_processed').val(response);
                },
            });
        }
    }
    </script>

</body>

</html>