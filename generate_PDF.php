<?php

if(isset($_POST["generate_pdf1"])) {  
  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetTitle("Balance Sheet PDF");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $obj_pdf->SetDefaultMonospacedFont('helvetica');
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
      $obj_pdf->setPrintHeader(false);
      $obj_pdf->setPrintFooter(false);
      $obj_pdf->SetAutoPageBreak(TRUE, 10);
      $obj_pdf->SetFont('helvetica', '', 11);
      $obj_pdf->AddPage();

      $monthArray = array("","January","February","March","April","May","June","July","August","September","October","November","December");
      $str = explode("-",$_POST['timeForPDF']);
      $month1 = $str[1];

      $content = '';
      $content .= '<p style="text-align:center;"><img src="images1/kharcha-logo1.png" width="200px" height="150px"></p>';  
      // $content .= '<img src="images1/kharcha-logo1.png" width="200px" height="150px" style="border-radius: 5px; display: block; margin: 0 auto;">';
      $content .= fetch_user(); 
      $content .= '  
      <h3 style="text-align: center;"><b>Monthly Transaction for '.$monthArray[$month1].'-'.$str[0].'</b></h3>
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr nobr="true">     
              <th><b>No.</b></th>
              <th><b>Name</b></th>
              <th><b>Description</b></th>
              <th><b>Date</b></th>
              <th><b>Category</b></th>
              <th><b>Debit</b></th>
              <th><b>Credit</b></th>
           </tr>  
      ';  
      $content .= fetch_data(); 
      
      $content .= '</table>';  
      $content .= '  
      <table border="1" cellspacing="0" cellpadding="3" >  
           <tr style="text-align: center;" nobr="true">  
              <th colspan="3"><b>Total</b></th>
           </tr>  
           <tr nobr="true">  
              <th><b>Debit</b></th>
              <th><b>Credit</b></th>
              <th><b>Balance</b></th>
           </tr>  
      ';  
      $content .= fetch_data1(); 
      $content .= '</table>'; 
      
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('Balance Sheet.pdf', 'I');  
}


    function fetch_data() {  
        include "conn/conn.php";

        $i=1;
        $output = '';  
        $sql = "SELECT BalanceID, BName,BDescription,BDate,CategoryID,IF(BDebit=0, 0, BAmount) AS Debit,IF(BDebit=1, 0, BAmount) AS TransType FROM balancesheet WHERE BDate LIKE '" . $_POST['timeForPDF'] . "-%' AND  balancesheet.UserId='".$_POST['hiddenUserId']."' ";
        $result = mysqli_query($conn, $sql);  
        while ($row = $result->fetch_assoc()) {
            $output .= '<tr nobr="true">';
            $count = 0;
            foreach($row as $column) {
                if($count == 0)
                    $output .= '<td>' . $i . '</td>';
                else
                    $output .= '<td>' . $column . '</td>';
                $count++;
            }
            $output .= '</tr>';
            $i++;
        }
        return $output;  
    }

    function fetch_data1() {  
        include "conn/conn.php";

        $output = ''; 
        $sqlDebit = "SELECT SUM(BAmount) as TotalDebit FROM balancesheet WHERE BDebit = 1 AND BDate LIKE '" . $_POST['timeForPDF'] . "-%' AND  balancesheet.UserId='".$_POST['hiddenUserId']."' ";
        $resultDebit = $conn->query($sqlDebit);
        $rowDebit = $resultDebit->fetch_assoc();
        $TotalDebit = $rowDebit['TotalDebit'];

        $sqlCredit = "SELECT SUM(BAmount) as TotalCredit FROM balancesheet WHERE BCredit = 1 AND BDate LIKE '" . $_POST['timeForPDF'] . "-%' AND  balancesheet.UserId='".$_POST['hiddenUserId']."' ";
        $resultCredit = $conn->query($sqlCredit);
        $rowCredit = $resultCredit->fetch_assoc();
        $TotalCredit = $rowCredit['TotalCredit'];

        $balance = $TotalCredit - $TotalDebit;

        $output .= '<tr nobr="true">';  
        $output .= '<td>' . $TotalDebit . '</td>'; 
        $output .= '<td>' . $TotalCredit . '</td>';
        $output .= '<td>' . $balance . '</td>';       
        $output .= '</tr>';

    
        return $output;  
    }  

    function fetch_user() {  
        include "conn/conn.php";

        $output = ''; 
        $sqlUser = "SELECT * FROM users WHERE  UserId=".$_POST['hiddenUserId'];
        $resultUser = $conn->query($sqlUser);
        $rowUser = $resultUser->fetch_assoc();

        $output .= '<div class = "row">';  
        $output .= '<div class = "col-md-3"><span style = "font-size: 1.5em;"><b>Name:</b> '.$rowUser['Name'].'</span></div>'; 
        $output .= '<div class = "col-md-3"><span style = "font-size: 1.5em;"><b>Email:</b> '.$rowUser['email'].'</span></div>'; 
        $output .= '<div class = "col-md-3"><span style = "font-size: 1.5em;"><b>Username:</b> '.$rowUser['UserName'].'</span></div>'; 
        $output .= '</div>';

    
        return $output;  
    }  



?>