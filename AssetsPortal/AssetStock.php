<?php
include_once 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatthemes.com/metrica/material-vertical-2/projects/projects-index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Mar 2020 08:03:26 GMT -->

<head>
    <meta charset="utf-8">
    <title>Asset Stock Report - Dashboard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description">
    <meta content="Mannatthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <style>
    label {
        font-weight: bold;
    }
    table tr th{
        background-color: #33F3FF;
    }
    </style>
</head>

<body>
    <!-- Top Bar Start -->
    <?php include_once 'header.php'; ?>
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        <?php include_once 'sidebar.php'; ?>

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
                                    <li class="breadcrumb-item active">Asset Stock Report</li>
                                </ol>
                            </div>
                            <h4 class="page-title"></h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <br><br>
                <!-- end page title end breadcrumb -->
                <div class="row" id="" style="">
                    <div class="col-md-9 text-center">
                        <h3><b><u>Asset Stock Report</u></b></h3>
                    </div>
                    <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Asset Name</b></th>
                                    <th scope="col"><b>Description</b></th>
                                    <th scope="col"><b>Qty</b></th>
                                    <th scope="col"><b>Brand</b></th>
                                    <th scope="col"><b>Asset Type</b></th>
                                    <th scope="col"><b>Actual Price</b></th>
                                    <th scope="col"><b>Depreciation Rate</b></th>
                                    <th scope="col"><b>Depreciated Price</b></th>
                                    <th scope="col"><b>Date</b></th>
                                    <th scope="col"><b>Assigned Date</b></th>
                                    <th scope="col"><b>Assigned Qty</b></th>
                                    <th scope="col"><b>Department</b></th>
                                    <th scope="col"><b>Assigned To</b></th>
                                    <!-- <th scope="col"><b>N.Weight</b></th> -->
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                // $count = 1;
                                // $sql = 'SELECT makecontract.ContractNo, CustomerName, makecontract.Quality, makecontract.Variety, SUM(Bags), SUM(CAST(REPLACE(LOWER(NetWT), "kg", "") AS DECIMAL(10,2))) FROM makecontract JOIN weighing ON makecontract.ContractNo = weighing.ContractNo JOIN weighing_description_receiving ON weighing_description_receiving.WeighingId = weighing.Id GROUP BY weighing_description_receiving.WeighingId, makecontract.ContractNo';
                                // // echo $sql;
                                // $result = mysqli_query($conn, $sql);
                                // if(mysqli_num_rows($result) > 0) {
                                //     while($row = mysqli_fetch_assoc($result)){
                                //       echo '
                                //             <tr>
                                //                 <th scope="row"><b>'.$count++.'</b></th>
                                //                 <td>'.$row['ContractNo'].'</td>
                                //                 <td>'.$row['CustomerName'].'</td>
                                //                 <td>'.$row['Quality'].'</td>
                                //                 <td>'.$row['Variety'].'</td>
                                //                 <td>'.$row['SUM(Bags)'].'</td>
                                //                 <td>'.$row['SUM(CAST(REPLACE(LOWER(NetWT), "kg", "") AS DECIMAL(10,2)))'].'</td>
                                //             </tr>';
                                //     }
                                // }
                                $count = 1;
                                $sql =
                                    'SELECT asset.*, asset_in.*, asset_assign.Date AS AssetAssignDate, Department, Assigned_To, asset_in.Id AS asset_in_id FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId GROUP BY asset_in.Id';
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <tr>
                                        <td scope="row"><b>' .
                                        $count++ .
                                        '</b></td>
                                        <td>' .
                                        $row['AssetName'] .
                                        '</td>
                                        <td>' .
                                        $row['Description'] .
                                        '</td>
                                        <td>' .
                                        $row['AssetQty'] .
                                        '</td>
                                        <td>' .
                                        $row['Brand'] .
                                        '</td>
                                        <td>' .
                                        $row['Asset_Type'] .
                                        '</td>
                                        <td>Rs. ' .
                                        number_format(
                                            floatval($row['Price']),
                                            2
                                        ) .
                                        '</td>
                                        <td>';
                                    if ($row['Asset_Type'] == 'Fixed') {
                                        echo $row['Deprication_Rate'] . ' %';
                                    }
                                    echo '</td>
                                        <td>';
                                    if ($row['Asset_Type'] == 'Fixed') {
                                        $depreciation = 0;
                                        $price = floatval($row['Price']);
                                        $rate =
                                            floatval($row['Deprication_Rate']) /
                                            100;
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($row['Date']);
                                        $datediff = $now - $your_date;

                                        $daysPassed = floor(
                                            $datediff / (60 * 60 * 24)
                                        );
                                        echo 'Rs. ' .
                                            number_format(
                                                $price -
                                                    (($price * $rate) / 365) *
                                                        $daysPassed,
                                                2
                                            );
                                    }
                                    $assignedDate = [];
                                    $assignedDept = [];
                                    $assignedTo = [];
                                    $assignedQty = [];
                                    $sql1 =
                                        'SELECT asset.*, asset_in.*, asset_assign.Date AS AssetAssignDate, Department, Assigned_To, AssignedQty FROM asset JOIN asset_in ON asset_in.AssetId = asset.AssetId LEFT JOIN asset_assign ON asset_in.Id = asset_assign.AssetInId WHERE asset_in.Id = ' .
                                        $row['asset_in_id'];
                                    // echo $sql1;
                                    $result1 = mysqli_query($conn, $sql1);
                                    while (
                                        $row1 = mysqli_fetch_assoc($result1)
                                    ) {
                                        $assignedDate[] =
                                            '* ' .
                                            date(
                                                'd-M-Y',
                                                strtotime(
                                                    $row['AssetAssignDate']
                                                )
                                            );
                                        $assignedDept[] =
                                            '* ' . $row1['Department'];
                                        $assignedTo[] =
                                            '* ' . $row1['Assigned_To'];
                                        $assignedQty[] =
                                            '* ' . $row1['AssignedQty'];
                                    }
                                    echo '</td>
                                        <td>' .
                                        date('d-M-Y', strtotime($row['Date'])) .
                                        '</td>
                                        <td>';
                                    echo implode('<br>', $assignedDate);

                                    echo '</td>
                                    <td>' .
                                        implode('<br>', $assignedQty) .
                                        '</td>
                                    <td>' .
                                        implode('<br>', $assignedDept) .
                                        '</td>
                                        <td>' .
                                        implode('<br>', $assignedTo) .
                                        '</td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot id="">

                            </tfoot>
                        </table>
                        </div>
                        </div>
                        <br><br>
                    </div>
                </div>
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/waves.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <!--Plugins-->
    <script src="../assets/plugins/morris/morris.min.js"></script>
    <script src="../assets/plugins/raphael/raphael.min.js"></script>
    <script src="../assets/plugins/moment/moment.js"></script>
    <script src="../assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/pages/jquery.projects_dashboard.init.js"></script>
    <script src="../assets/pages/jquery.projects_dashboard.init.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <!-- App js -->
    <script src="../assets/js/app.js"></script>

    <script>
    $('#headername').html("Asset Stock Report");
    </script>
    <script>
    $(document).ready( function () {
        $('.table').DataTable();
    } );
    </script>

</body>

</html>