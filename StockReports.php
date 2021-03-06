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
                    <div class="col-md-9 text-center">
                        <h4><b><u>Tool Mill Contract Report</u></b></h4>
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
                                    <th scope="col"><b>Location</b></th>
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
                                    <!-- <th scope="col"><b>Weight</b></th> -->
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                $count = 1;
                                $sql = 'SELECT  toolmillcontract.ContractNo, SaleCustomerName, ProcessingMill, Quality, Variety, 
                                                SUM(gatepass_g_recieved_items.Quantity) AS Quantity, gatepass_g_recieved_items.Items
                                                FROM toolmillcontract 
                                                JOIN gatepass_g_recieved ON toolmillcontract.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE gatepass_g_recieved_items.Type = "Rice"
                                                GROUP BY ContractNo  ORDER BY CAST(toolmillcontract.ContractNo AS DECIMAL)';

                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // print_r($row);
                                    // echo '<br>';
                                    $sql1 = 'SELECT ' . $row['Quantity'] . ' - SUM(production_goods.Bags) AS Quantity, SUM(production_goods.Bags) AS Production_Bags
                                    FROM production_goods 
                                    WHERE ContractNo = ' . $row['ContractNo'] . '
                                    GROUP BY ContractNo
                                    ';
                                    // echo $sql1;
                                    $result1 = mysqli_query($conn, $sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {

                                            echo '
                                    <tr>
                                        <td scope="row"><b>' . $count++ . '</b></td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['SaleCustomerName'] . '</td>
                                        <td>' . $row['ProcessingMill'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';
                                            $quantity = $row1['Quantity'];
                                            $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . '
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo, gatepass_g_issue_items.Items';
                                            // echo $sql_gi_raw_material;

                                            $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                            if ($r_gi_raw_material->num_rows > 0) {
                                                $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                                $quantity -= $row_gi_raw_material['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoFrom, Items';
                                            // echo $sql_stock_transfer . '<br>';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity -= $row_stock_transfer['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoTo, Items';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity += $row_stock_transfer['Quantity'];
                                            }

                                            echo '
                                                <td>' . $row['Variety'] . '</td> 
                                                <td>' . $quantity . '</td>';

                                            foreach ($varieties as $variety) {
                                                // $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                //     FROM production_milling 
                                                //     WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                                //     AND M_ItemName = "' . $variety . '"
                                                //     GROUP BY ContractNo
                                                //     ';
                                                $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                    FROM production_milling 
                                                    WHERE ContractNo = ' . $row['ContractNo'] . '
                                                    AND M_ItemName = "' . $variety . '"
                                                    GROUP BY ContractNo
                                                    ';
                                                // echo $sql2 . '<br>';
                                                $result2 = mysqli_query($conn, $sql2);
                                                echo '<td>';
                                                if ($result2->num_rows > 0)
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {

                                                        $sql_goodissue = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                                                        AND gatepass_g_issue_items.ItemName = "' . $variety . '" GROUP BY gatepass_g_issue.ContractNo ';
                                                        // echo $sql_goodissue;
                                                        $result_goodissue = mysqli_query($conn, $sql_goodissue);
                                                        $row_goodissue = mysqli_fetch_assoc($result_goodissue);

                                                        if (isset($row_goodissue['Quantity'])) {
                                                            echo $row2['Quantity'] - $row_goodissue['Quantity'];
                                                        } else {
                                                            echo $row2['Quantity'];
                                                        }
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
                                            WHERE ContractNo = ' . $row['ContractNo'] . '
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
                                        <td>' . $row['ProcessingMill'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';

                                        $quantity = $row['Quantity'];

                                        $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity, gatepass_g_issue_items.Items FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . '
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo ';
                                        // echo $sql_gi_raw_material;
                                        $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                        if ($r_gi_raw_material->num_rows > 0) {
                                            $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                            $quantity -= $row_gi_raw_material['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoFrom';
                                        // echo $sql_stock_transfer . '<br>';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity -= $row_stock_transfer['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoTo';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity += $row_stock_transfer['Quantity'];
                                        }

                                        echo '
                                            <td>' . $row['Variety'] . '</td> 
                                            <td>' . $quantity . '</td>';

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



                    <div class="col-md-9 text-center">
                        <!-- <h4><b><u>Creditor Contract Report</u></b></h4> -->
                        <h4><b><u>Bin Shabir Stock Report</u></b></h4>
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
                                    <th scope="col"><b>Type</b></th>
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
                                $sql = 'SELECT  creditor.ContractNo, creditor.ContractType, PurchaseSupplierName, Quality, Variety, 
                                                SUM(gatepass_g_recieved_items.Quantity) AS Quantity, gatepass_g_recieved_items.Items
                                                FROM creditor 
                                                JOIN gatepass_g_recieved ON creditor.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE gatepass_g_recieved_items.Type = "Rice"
                                                GROUP BY ContractNo';

                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // print_r($row);
                                    // echo '<br>';
                                    $sql1 = 'SELECT ' . $row['Quantity'] . ' - SUM(production_goods.Bags) AS Quantity, SUM(production_goods.Bags) AS Production_Bags
                                    FROM production_goods 
                                    WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                    GROUP BY ContractNo
                                    ';
                                    // echo $sql1;
                                    $result1 = mysqli_query($conn, $sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {

                                            echo '
                                    <tr>
                                        <td scope="row"><b>' . $count++ . '</b></td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['ContractType'] . '</td>
                                        <td>' . $row['PurchaseSupplierName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';
                                            $quantity = $row1['Quantity'];

                                            $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo, gatepass_g_issue_items.Items';
                                            // echo $sql_gi_raw_material;

                                            $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                            if ($r_gi_raw_material->num_rows > 0) {
                                                $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                                $quantity -= $row_gi_raw_material['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoFrom';
                                            // echo $sql_stock_transfer . '<br>';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity -= $row_stock_transfer['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoTo';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity += $row_stock_transfer['Quantity'];
                                            }

                                            echo '
                                                <td>' . $row['Variety'] . '</td> 
                                                <td>' . $quantity . '</td>';


                                            foreach ($varieties as $variety) {
                                                // $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                //     FROM production_milling 
                                                //     WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                                //     AND M_ItemName = "' . $variety . '"
                                                //     GROUP BY ContractNo
                                                //     ';
                                                $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                    FROM production_milling 
                                                    WHERE ContractNo = ' . $row['ContractNo'] . '
                                                    AND M_ItemName = "' . $variety . '"
                                                    GROUP BY ContractNo
                                                    ';
                                                // echo $sql2 . '<br>';
                                                $result2 = mysqli_query($conn, $sql2);
                                                echo '<td>';
                                                if ($result2->num_rows > 0)
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {

                                                        $sql_goodissue = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                                                        AND gatepass_g_issue_items.ItemName = "' . $variety . '" GROUP BY gatepass_g_issue.ContractNo ';
                                                        // echo $sql_goodissue;
                                                        $result_goodissue = mysqli_query($conn, $sql_goodissue);
                                                        $row_goodissue = mysqli_fetch_assoc($result_goodissue);

                                                        if (isset($row_goodissue['Quantity'])) {
                                                            echo $row2['Quantity'] - $row_goodissue['Quantity'];
                                                        } else {
                                                            echo $row2['Quantity'];
                                                        }
                                                    }
                                                echo '</td>';
                                            }
                                            $sql2 = 'SELECT SUM(gatepass_g_recieved_items.Quantity) AS Quantity FROM creditor 
                                                JOIN gatepass_g_recieved ON creditor.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE creditor.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_recieved_items.Type = "Other"
                                                GROUP BY creditor.ContractNo
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
                                            WHERE ContractNo = ' . $row['ContractNo'] . '
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
                                        <td>' . $row['ContractType'] . '</td>
                                        <td>' . $row['PurchaseSupplierName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';
                                        $quantity = $row['Quantity'];

                                        $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity, gatepass_g_issue_items.Items FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . '
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo ';
                                        // echo $sql_gi_raw_material;
                                        $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                        if ($r_gi_raw_material->num_rows > 0) {
                                            $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                            $quantity -= $row_gi_raw_material['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoFrom';
                                        // echo $sql_stock_transfer . '<br>';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity -= $row_stock_transfer['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoTo';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity += $row_stock_transfer['Quantity'];
                                        }

                                        echo '
                                            <td>' . $row['Variety'] . '</td> 
                                            <td>' . $quantity . '</td>';


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

                                <?php
                                // $count = 1;
                                $sql = 'SELECT  debtor.ContractNo, debtor.ContractType, SaleCustomerName, Quality, Variety, 
                                                SUM(gatepass_g_recieved_items.Quantity) AS Quantity, gatepass_g_recieved_items.Items
                                                FROM debtor 
                                                JOIN gatepass_g_recieved ON debtor.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE gatepass_g_recieved_items.Type = "Rice"
                                                GROUP BY ContractNo';

                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // print_r($row);
                                    // echo '<br>';
                                    $sql1 = 'SELECT ' . $row['Quantity'] . ' - SUM(production_goods.Bags) AS Quantity, SUM(production_goods.Bags) AS Production_Bags
                                    FROM production_goods 
                                    WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                    GROUP BY ContractNo
                                    ';
                                    // echo $sql1;
                                    $result1 = mysqli_query($conn, $sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {

                                            echo '
                                    <tr>
                                        <td scope="row"><b>' . $count++ . '</b></td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['ContractType'] . '</td>
                                        <td>' . $row['SaleCustomerName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';
                                            $quantity = $row1['Quantity'];

                                            $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo, gatepass_g_issue_items.Items';
                                            // echo $sql_gi_raw_material;

                                            $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                            if ($r_gi_raw_material->num_rows > 0) {
                                                $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                                $quantity -= $row_gi_raw_material['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoFrom';
                                            // echo $sql_stock_transfer . '<br>';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity -= $row_stock_transfer['Quantity'];
                                            }

                                            $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                        WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                        AND ItemName = "" GROUP BY ContractNoTo';

                                            $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                            if ($r_stock_transfer->num_rows > 0) {
                                                $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                                $quantity += $row_stock_transfer['Quantity'];
                                            }

                                            echo '
                                                <td>' . $row['Variety'] . '</td> 
                                                <td>' . $quantity . '</td>';

                                            foreach ($varieties as $variety) {
                                                // $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                //     FROM production_milling 
                                                //     WHERE ContractNo = ' . $row['ContractNo'] . ' AND Party_ItemName = "' . $row['Items'] . '"
                                                //     AND M_ItemName = "' . $variety . '"
                                                //     GROUP BY ContractNo
                                                //     ';
                                                $sql2 = 'SELECT SUM(production_milling.M_Bags) AS Quantity
                                                    FROM production_milling 
                                                    WHERE ContractNo = ' . $row['ContractNo'] . '
                                                    AND M_ItemName = "' . $variety . '"
                                                    GROUP BY ContractNo
                                                    ';
                                                // echo $sql2 . '<br>';
                                                $result2 = mysqli_query($conn, $sql2);
                                                echo '<td>';
                                                if ($result2->num_rows > 0)
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {

                                                        $sql_goodissue = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_issue_items.Items = "' . $row['Items'] . '"
                                                        AND gatepass_g_issue_items.ItemName = "' . $variety . '" GROUP BY gatepass_g_issue.ContractNo ';
                                                        // echo $sql_goodissue;
                                                        $result_goodissue = mysqli_query($conn, $sql_goodissue);
                                                        $row_goodissue = mysqli_fetch_assoc($result_goodissue);

                                                        if (isset($row_goodissue['Quantity'])) {
                                                            echo $row2['Quantity'] - $row_goodissue['Quantity'];
                                                        } else {
                                                            echo $row2['Quantity'];
                                                        }
                                                    }
                                                echo '</td>';
                                            }
                                            $sql2 = 'SELECT SUM(gatepass_g_recieved_items.Quantity) AS Quantity FROM debtor 
                                                JOIN gatepass_g_recieved ON debtor.ContractNo = gatepass_g_recieved.ContractNo
                                                JOIN gatepass_g_recieved_items ON gatepass_g_recieved.Id = gatepass_g_recieved_items.GoodReceivedId
                                                WHERE debtor.ContractNo = ' . $row['ContractNo'] . ' AND gatepass_g_recieved_items.Type = "Other"
                                                GROUP BY debtor.ContractNo
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
                                            WHERE ContractNo = ' . $row['ContractNo'] . '
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
                                        <td><b>' . $count++ . '</b> </td>
                                        <td>' . $row['ContractNo'] . '</td>
                                        <td>' . $row['ContractType'] . '</td>
                                        <td>' . $row['SaleCustomerName'] . '</td>
                                        <td>' . $row['Quality'] . '</td>';
                                        $quantity = $row['Quantity'];

                                        $sql_gi_raw_material = 'SELECT *, SUM(gatepass_g_issue_items.Quantity) AS Quantity, gatepass_g_issue_items.Items FROM gatepass_g_issue 
                                                        JOIN gatepass_g_issue_items ON gatepass_g_issue.Id = gatepass_g_issue_items.GoodIssueId
                                                        WHERE gatepass_g_issue.ContractNo = ' . $row['ContractNo'] . '
                                                        AND gatepass_g_issue_items.ItemName = "" GROUP BY gatepass_g_issue.ContractNo ';
                                        // echo $sql_gi_raw_material;
                                        $r_gi_raw_material = mysqli_query($conn, $sql_gi_raw_material);
                                        if ($r_gi_raw_material->num_rows > 0) {
                                            $row_gi_raw_material  = mysqli_fetch_assoc($r_gi_raw_material);
                                            $quantity -= $row_gi_raw_material['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoFrom = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoFrom';
                                        // echo $sql_stock_transfer . '<br>';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity -= $row_stock_transfer['Quantity'];
                                        }

                                        $sql_stock_transfer = 'SELECT *, SUM(BagsTransfer) AS Quantity FROM stocktransfer 
                                                    WHERE ContractNoTo = ' . $row['ContractNo'] . '
                                                    AND ItemName = "" GROUP BY ContractNoTo';

                                        $r_stock_transfer = mysqli_query($conn, $sql_stock_transfer);
                                        if ($r_stock_transfer->num_rows > 0) {
                                            $row_stock_transfer  = mysqli_fetch_assoc($r_stock_transfer);
                                            $quantity += $row_stock_transfer['Quantity'];
                                        }

                                        echo '
                                            <td>' . $row['Variety'] . '</td> 
                                            <td>' . $quantity . '</td>';


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



                    <!-- <div class="col-md-9 text-center">
                        <h4><b><u>Debitor Contract Report</u></b></h4>
                    </div>
                    <?php
                    // $varieties = ["Final", "Short grain", "B1", "B2", "B3", "CSR", "Broken CSR", "Peddy", "Powder", "Choba", "Sweeping", "Stones"];
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
                                    // foreach ($varieties as $variety) {
                                    //     echo '<th scope="col"><b>' . $variety . '</b></th>';
                                    // }
                                    ?>
                                    <th scope="col"><b>Other</b></th>
                                    <th scope="col"><b>Total</b></th>

                                </tr>
                            </thead>
                            <tbody id="">
                                
                            </tbody>
                            <tfoot id="">

                            </tfoot>
                        </table>
                        <br>
                    </div> -->
                </div>
                <!-- <div class="row">
                    <div class="col-md-3">
                        <input class="btn btn-success" id="printpagebutton" type="button" value="Print" onclick="printpage()" />
                    </div>
                </div> -->
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