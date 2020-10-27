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
    <title>Weighing - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Weighing / Actual Recievable</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <form action="WeighingSubmit.php" method="POST">
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
                    </div>
                    <div class="row" id="quantity_variety" style="display:none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quality:</label>
                                <input type="text" name="quality" id="quality" value="" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Variety:</label>
                                <input type="text" name="variety" id="variety" value="" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <h3 style="color: #7088C8"><u>Item Required:</u></h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Description:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Receiving:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date:</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>GRN:</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>TruckNo:</label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Bags:</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Net WT:</label>
                            </div>
                        </div>
                    </div>
                    <div id="items">
                        <!-- <div class="row" id="Weighing_row_0" name="Weighing_rows">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="description[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="receiving[]" class="form-control" required>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input name="addFieldButton" type="button" value="+Add Item" onclick="addField();"
                                class="form-control itembutton">
                        </div>
                        <div class="col-3">
                            <input name="delFieldButton" type="button" value="+Remove Item" onclick="delField();"
                                class="form-control itembutton">
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
                </form>
            </div>
            <!-- container -->
            <br><br><br>

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
    $('#headername').html("Weighing / Actual Recievable");
    </script>

    <script>
    $('#contractno').on('change', function() {
        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: 'POST',
            url: 'WeighingData.php',
            data: 'ContractNo=' + id,
            success: function(response) {
                var obj = JSON.parse(response);
                $('#quality').val(obj.quality);
                $('#variety').val(obj.variety);

                $('#quantity_variety').show();
            },
        });
    })
    </script>

    <!-- script of add_Item_button/del_Item_button work -->
    <script>
    counter = -1;

    function addField() {
        counter++;

        var content = '';
        content += '<div class="row" id="Weighing_row_' + counter + '" name="Weighing_rows">';
        content += '    <div class="col-md-3">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="description[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="receiving[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="date" name="date[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-1">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="grn[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-1">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="truckno[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-1">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="bags[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '    <div class="col-md-2">';
        content += '        <div class="form-group">';
        content += '            <input type="text" name="netwt[]" class="form-control">';
        content += '        </div>';
        content += '    </div>';
        content += '</div>';
        $('#items').append(content);
    }

    function delField() {
        $("#Weighing_row_" + counter).remove();
        counter--;
    }
    </script>
</body>

</html>