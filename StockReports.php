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
    <title>Stock Report - Dashboard</title>
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
                                    <li class="breadcrumb-item active">Stock Report</li>
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
                        <h3><b><u>STOCK AVAILABLE</u></b></h3>
                    </div>
                    <?php
                    $varieties = ["Final", "Short grain", "B1", "B2", "B3", "CSR", "Broken CSR", "Peddy", "Powder", "Choba", "Sweeping", "Stones"];
                    ?>
                    <div class="col-md-9 mt-4">
                        <table class="table table-bordered table-responsive" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Contract No</b></th>
                                    <th scope="col"><b>Customer Name</b></th>
                                    <th scope="col"><b>Quality</b></th>
                                    <th scope="col"><b>Variety</b></th>
                                    <th scope="col"><b>Raw Bags in Stock</b></th>
                                    <?php
                                    foreach ($varieties as $variety) {
                                        echo '<th scope="col"><b>' . $variety . '</b></th>';
                                    }
                                    ?>
                                    <th scope="col"><b>Other</b></th>
                                    <th scope="col"><b>Total</b></th>

                                    <!-- <th scope="col"><b>N.Weight</b></th> -->
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $count = 1;
                                $sql = 'SELECT  toolmillcontract.ContractNo, SaleCustomerName, Quality, Variety, 
                                                SUM(gatepass_g_recieved_items.Quantity) AS Quantity, gatepass_g_recieved_items.Items
                                                FROM toolmillcontract 
                                                JOIN gatepass_g_recieved ON toolmillcontract.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE gatepass_g_recieved_items.Type = "Rice"
                                                GROUP BY ContractNo
                                                ';
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // print_r($row);
                                    // echo '<br>';
                                    $sql1 = 'SELECT ' . $row['Quantity'] . ' - SUM(production_goods.Bags) AS Quantity, SUM(production_goods.Bags) AS Production_Bags
                                    FROM production_goods 
                                    WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                    GROUP BY ContractNo
                                    ';
                                    $result1 = mysqli_query($conn, $sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {


                                            echo '
                                    <tr>
                                        <td scope="row"><b>' . $count++ . '</b></td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['SaleCustomerName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>
                                        <td>' . $row['Variety'] . '</td>
                                        <td>' . $row1['Quantity'] . '</td>';
                                            foreach ($varieties as $variety) {
                                                $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                    FROM production_milling 
                                                    WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                                    AND M_ItemName = "' . $variety . '"
                                                    GROUP BY ContractNo
                                                    ';
                                                $result2 = mysqli_query($conn, $sql2);
                                                echo '<td>';
                                                if ($result2->num_rows > 0)
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                        echo $row2['Quantity'];
                                                    }
                                                echo '</td>';
                                            }
                                            $sql2 = 'SELECT SUM(gatepass_g_recieved_items.Quantity) AS Quantity FROM toolmillcontract 
                                                JOIN gatepass_g_recieved ON toolmillcontract.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE toolmillcontract.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_recieved_items.Type = "Other"
                                                GROUP BY toolmillcontract.ContractNo
                                                ';
                                            $result2 = mysqli_query($conn, $sql2);
                                            echo '<td>';
                                            if ($result2->num_rows > 0)
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2['Quantity'];
                                                }
                                            echo '</td>';

                                            $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                            FROM production_milling 
                                            WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                            GROUP BY ContractNo
                                            ';
                                            $result2 = mysqli_query($conn, $sql2);
                                            echo '<td>';
                                            if ($result2->num_rows > 0)
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row1['Quantity'] + $row2['Quantity'];
                                                }
                                            else
                                                echo $row1['Production_Bags'];
                                            echo '</td>';

                                            echo '</tr>';
                                        }
                                    } else {

                                        echo '
                                    <tr>
                                        <td scope="row"><b>' . $count++ . '</b></td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['SaleCustomerName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>
                                        <td>' . $row['Variety'] . '</td>
                                        <td>' . $row['Quantity'] . '</td>';
                                        foreach ($varieties as $variety) {
                                            echo '<td>';
                                            echo '</td>';
                                        }
                                        echo '<td>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo $row['Quantity'];
                                        echo '</td>';

                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot id="">

                            </tfoot>
                        </table>
                        <br>
                    </div>
                    <!-- <div class="col-md-12 mt-4">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.No</b></th>
                                    <th scope="col"><b>Contract No</b></th>
                                    <th scope="col"><b>Customer Name</b></th>
                                    <th scope="col"><b>Quality</b></th>
                                    <th scope="col"><b>Variety</b></th>
                                    <th scope="col"><b>Bags</b></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                // $count = 1;
                                // $sql = 'SELECT * FROM contract_wise_totalbags JOIN makecontract ON contract_wise_totalbags.ContractNo = makecontract.ContractNo';
                                // $result = mysqli_query($conn, $sql);
                                // while ($row = mysqli_fetch_assoc($result)) {
                                //     echo '
                                //     <tr>
                                //         <td scope="row"><b>' . $count++ . '</b></td>
                                //         <td>' . $row['ContractNo'] . '</td>
                                //         <td>' . $row['CustomerName'] . '</td>
                                //         <td>' . $row['Quality'] . '</td>
                                //         <td>' . $row['Variety'] . '</td>
                                //         <td>' . $row['TotalBags'] . '</td>
                                //     </tr>';
                                // }
                                ?>
                            </tbody>
                            <tfoot id="">

                            </tfoot>
                        </table>
                        <br>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input class="btn btn-success" id="printpagebutton" type="button" value="Print" onclick="printpage()" />
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
        $('#headername').html("Stock Report");
    </script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
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