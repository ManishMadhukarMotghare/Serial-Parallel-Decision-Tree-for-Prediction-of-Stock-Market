<?php

include 'include.php';
session_start();
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();


$CommandType = "EMPTY";
if (isset($_REQUEST["ddl_Doc"]))
    $CommandType = $_REQUEST["ddl_Doc"];

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;

    case "Docket":
        $ID = $_GET["txt_DocID"];
        $StartDate = $_GET["txt_startdate"];
        $EndDate = $_GET["txt_enddate"];
        $FromBranch = $_GET["txt_FromBranch"];
        $ToBranch = $_GET["txt_ToBranch"];
        $Sql_input = "select * from docket where DocketDate between ('$StartDate' and '$EndDate') and FromBranch='$FromBranch'and ToBranch='$ToBranch'and DocketID='$ID'";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $displayTableRow = "";
        $displaytable = "";

        while ($Row1 = mysqli_fetch_assoc($sql_output)) {
         $displayTableRow .= '<tr>
                                 <td>' . $Row1['DocketID'] . '</td>
                                <td>' . $Row1['DocketNumber'] . ' </td>
                                <td>' . $Row1['DocketDate'] . ' </td>
                                <td>' . $Row1['FromBranch'] . ' </td>
                                <td>' . $Row1['ToBranch'] . ' </td>
                                <td>' . $Row1['PickupDelivery'] . ' </td>
                               <td>' . $Row1['PackingType'] . ' </td>
                               <td>' . $Row1['ActualWeight'] . '</td> 
                                <td>' . $Row1['PaymentType'] . ' </td>
                               <td>' . $Row1['BillingPartySelection'] . ' </td>
                               <td>' . $Row1['EDD'] . ' </td>
                              <td>' . $Row1['ServiceType'] . ' </td>
                              <td>' . $Row1['FromConsignor'] . ' </td> 
                            <td>' . $Row1['FromGSTIN'] . ' </td> 
                            <td>' . $Row1['FromAddress'] . ' </td> 
                             <td>' . $Row1['FromCity'] . ' </td>
                              <td>' . $Row1['FromPincode'] . ' </td> 
                              <td>' . $Row1['FromState'] . ' </td> 
                             <td>' . $Row1['FromPhone'] . ' </td> 
                             <td>' . $Row1['ToConsignee'] . ' </td> 
                            <td>' . $Row1['ToGSTIN'] . ' </td>     
                             <td>' . $Row1['ToAddress'] . ' </td>   
                              <td>' . $Row1['ToCity'] . ' </td>   
                              <td>' . $Row1['ToPincode'] . ' </td>   
                               <td>' . $Row1['ToState'] . ' </td>   
                                <td>' . $Row1['ToPhone'] . ' </td>   
                                <td>' . $Row1['ItemDescription'] . ' </td>   
                                 <td>' . $Row1['VolmetricWeight'] . ' </td>   
                                 <td>' . $Row1['ChargedWeight'] . ' </td>   
                                 <td>' . $Row1['InvoiceNo'] . ' </td>
                                  <td>' . $Row1['InvoiceValue'] . ' </td>   
                                 <td>' . $Row1['RiskType'] . ' </td>   
                                  <td>' . $Row1['BookedBy'] . ' </td>   
                                 <td>' . $Row1['EWayBillNo'] . ' </td> 
                                 <td>' . $Row1['ExpiryDate'] . ' </td>   
                                  <td>' . $Row1['ValueAddedService'] . ' </td>   
                                   <td>' . $Row1['VASAmount'] . ' </td>   
                                    <td>' . $Row1['BasicFreight'] . ' </td>   
                                    <td>' . $Row1['FOV'] . ' </td> 
                                      <td>' . $Row1['FuelSurcharge'] . ' </td>  
                                      <td>' . $Row1['DocketCharge'] . ' </td>
                                       <td>' . $Row1['ODAOPA'] . ' </td>  
                                        <td>' . $Row1['HandlingCharge'] . ' </td>  
                                       <td>' . $Row1['CODDACC'] . ' </td>  
                                       <td>' . $Row1['ToPayCharge'] . ' </td>  
                                       <td>' . $Row1['OtherCharges'] . ' </td>      
                                     <td>' . $Row1['GSTRate'] . ' </td>
                                   <td>' . $Row1['SubTotal'] . ' </td>
                                     <td>' . $Row1['GSTAmt'] . ' </td>
                                   <td>' . $Row1['GrandTotal'] . ' </td>
                                 <td>' . $Row1['POD'] . ' </td>
                                     <td>' . $Row1['DeliveredDate'] . ' </td>
                                   <td>' . $Row1['StatusRemark'] . ' </td>
                                   <td>' . $Row1['Status'] . ' </td>
                                 <td>' . $Row1['AddedBy'] . ' </td>
                                       <td>' . $Row1['AddedDate'] . ' </td>
                                    <td>' . $Row1['UpdateBy'] . ' </td>
                                             <td>' . $Row1['UpdatedDate'] . ' </td>';
            ' </tr>';
        }
        echo $displaytable = '<div class="container-fluid">
                        <div class="dynamic-content">
                            <!--dynamic content-->
                            <table class="table table-bordered condensed">
                                <thead>
                                </thead>
                                <th>Docket ID</th>
                                <th>Docket Number</th>
                                <th>Docket Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Pickup Delivery</th>
                                <th>Packing Type</th>
                                <th>Actual Weight</th>
                                <th>Payment Type</th>
                                <th>Billing Party Selection</th>
                                <th>EDD</th>
                                <th>Service Type</th>
                                <th>From Consignor</th>
                                <th>From GSTIN</th>
                                <th>From Address</th>
                                <th>From City</th>
                                <th>From Pincode</th>
                                <th>From State</th>
                                <th>From Phone</th>
                                <th>To Consignee</th>
                                <th>To GSTIN</th>
                                <th>To Address</th>
                                <th>To City</th>
                                <th>To PinCode</th>
                                <th>To State</th>
                                <th>To Phone</th>
                                <th>Item Description</th>
                                <th>Volmetric Weight</th>
                                <th>Charged Weight</th>
                                <th>Invoice No</th>
                                <th>Invoice Value</th>
                                <th>Risk Type</th>
                                <th>Booked By</th>
                                <th>E-Way Bill No.</th>
                                <th>Expiry Date</th>
                                <th>Value Added Service</th>
                                <th>VAS Amount</th>
                                <th>Basic Freight</th>
                                <th>Fuel Surcharge</th>
                                <th>Docket Charge</th>
                                <th>ODA/OPA</th>
                                <th>Handling Charge</th>
                                <th>CODD/ACC</th>
                                <th>To-Pay Charge</th>
                                <th>Other Charges</th>
                                <th>GST Rate</th>
                                <th>SubTotal</th> 
                                <th>GST Amt</th>
                                <th>POD</th>
                                <th>Delivered Date</th>
                                <th>Status Remark</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Added Date</th>
                                <th>Update By</th>
                                <th>Update Date</th>
                                <tbody>
                                     ' . $displayTableRow . ' 
                                </tbody>
                            </table>';


        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Docket", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;

    case "THC":
        $Sql_input = "select * from thc ";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents THC", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;

    case "manifest":
        $Sql_input = "select * from manifest";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Manifest", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;

    case "DRS":
        $Sql_input = "select * from drs";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents DRS", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;

    case "Acknowledge":
        $Sql_input = "select * from Acknowledge";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Acknowledge", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;

    case "Handover":
        $Sql_input = "select * from Handover";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Handover", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        break;
    case "MRBILL":
        $Sql_input = "select * from MRBILL";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents MRBILL", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        echo $returnstring;
}
?>







