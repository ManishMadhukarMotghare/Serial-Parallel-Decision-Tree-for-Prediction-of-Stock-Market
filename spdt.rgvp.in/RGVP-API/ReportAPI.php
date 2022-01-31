<?php

include "include.php"; // VARIABLES
//$SelectColumns = array("RouteID", "RouteName", "FromBranch", "ToBranch", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdatedDate"); // array("id", "name", "email", "mobile", "start_date");
//$InsertColumns = array("RouteName", "FromBranch", "ToBranch", "Status", "AddedBy", "UpdateBy");
//$UpdateColumns = array("RouteName", "FromBranch", "ToBranch", "Status", "AddedBy", "UpdateBy");
//$InsertColumnsData = array("txt_RouteName", "txt_FromBranch", "txt_ToBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
//$ColumnAPIUpdateData = array("txt_RouteName", "txt_FromBranch", "txt_ToBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
//$InsertColDataString = "";
//$UpdateColDataString = "";
$sIndexColumn = "RouteID";
$sTable = "route";
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$CommandType = "EMPTY";
if (isset($_REQUEST["CommandType"]))
    $CommandType = $_REQUEST["CommandType"];
$posted = $_REQUEST;
foreach ($posted as &$val)
    if (gettype($val) == "string")
        $val = mysqli_real_escape_string($RGVPDBCon, $val);

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;
    case "SELECT-SALES-REGISTER":
        $CustomerID = $posted['CustomerName'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $PaymentType = $posted['PaymentType'];
        $Status = $posted['Status'];
        $sWhere = " WHERE BillingPartySelection ='$CustomerID'  AND Status = '$Status' AND PaymentType= '$PaymentType' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;

    case "SELECT-PENDING-STOCK-DOCKET":
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE FromBranch ='$FromBranch' AND  Status = 'Active' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-PENDING-STOCK-DRS":
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE FromBranch ='$FromBranch' AND  Status ='Cancelled' AND DSRDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT * FROM drs $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-WITHOUT-POD":
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE PODHandover ='No' AND  Status ='Delivered' AND DeliveryDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT * FROM pod $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-POD-NOT-HANDOVER":
        $CustomerName = $posted['CustomerName'];
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE FromBranch ='$FromBranch' AND  BillingPartySelection = '$CustomerName' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT DocketNumber,DocketDate,FromBranch,ToConsignee,ToPincode,QTY,ActualWeight,ChargedWeight,ToBranch FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;

    case "SELECT-PERFORMANCES":
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE FromBranch ='$FromBranch' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT DocketNumber,DocketDate,FromBranch,ToBranch,EDD,AddedDate,Status FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-EXPECTED-ARRIVAL":
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE FromBranch ='$FromBranch' AND THCDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = " SELECT THCNumber,THCDate,FromBranch,ToBranch,VehicleNo,Status,DeliveredDate,AddedDate FROM thc $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-DELIVERY":
        $DocketNumber = $posted['DocketNumber'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE DocketNumber ='$DocketNumber' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        $sQuery = "SELECT DocketNumber,DocketDate,ToBranch,ToConsignee,QTY,ChargedWeight,ToCity,ToPincode,DeliveredDate FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-SALES-ACTUAL-TARGET":

        $FromBranch = $posted['FromBranch'];
        $Year = $posted['Year'];
        $Month = $posted['Month'];
        if ($Status == "") {
            $sWhere = " WHERE docket.DocketDate LIKE '%$Year-$Month%'";
        } else {
            $sWhere = " WHERE branchtargets.BranchCode ='$FromBranch' AND docket.DocketDate LIKE '%$Year-$Month%'";
        }
        $sQuery = "SELECT branchtargets.BranchCode,branchtargets.Month,branchtargets.Year,branchtargets.TargetDocket,
            branchtargets.TargetWt,branchtargets.TargetRevenue,docket.DocketID,docket.ActualWeight,docket.GrandTotal
           FROM docket INNER JOIN branchtargets ON docket.FromBranch = branchtargets.BranchCode $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);


            if ($aRow > 0) {

                $rowarray;

//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $BranchCode = $row['BranchCode'];
                    $Month = $row['Month'];
                    $Year = $row['Year'];
                    $TargetDocket = $row['TargetDocket'];
                    $Count = $aRow;
                    $TargetWt = $row["TargetWt"];
                    $TargetRevenue = $row['TargetRevenue'];
                    $ActualWeight += $row['ActualWeight'];
                    $GrandTotal += $row['GrandTotal'];

                    $percentage = ($GrandTotal * 100 ) / $TargetRevenue;
                }
//                $DisplayTableData = '<tr>'
//                        . '<td>' . $row['BranchCode'] . '</td>
//                            <td>' . $row['Month'] . '</td>
//                             <td>' . $row['Year'] . '</td>
//                             <td>' . $row['TargetDocket'] . '</td>
//                           <td>' . $row['TargetWt'] . '</td>
//                            <td>' . $aRow . '</td>
//                              <td>' . $ActualWeight . '</td>
//                                 <td>' . $GrandTotal . '</td>
//                                      <td>' . $percentage . '</td>
//                            </tr> ';
                $DecimalPlaces = 2;
                $ThousandSeparater = ",";
                $DecimalSeparater = ".";
                $percentage = number_format($percentage, $DecimalPlaces, $DecimalSeparater, $ThousandSeparater);
                $rowarray[] = array('BranchCode' => $BranchCode, 'Month' => $Month, 'Year' => $Year, 'TargetDocket' => $TargetDocket, 'TargetWt' => $TargetWt, 'TargetRevenue' => $TargetRevenue, 'DocketCount' => $Count, 'ActualWeight' => $ActualWeight, 'GrandTotal' => $GrandTotal, 'percentage' => $percentage);




                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {

                $FromBranch = $posted['FromBranch'];
                $Year = $posted['Year'];
                $Month = $posted['Month'];
                $sWhere = " WHERE branch.Code ='$FromBranch' AND docket.DocketDate BETWEEN ='$Year' AND '$Month'";
                $sQuery = "SELECT branch.Code,docket.Month,docket.Year,branch.TargetDocket,
            branch.TargetWt,branch.TargetRevenue,docket.DocketID,docket.ActualWeight,docket.GrandTotal
           FROM docket INNER JOIN branch ON docket.FromBranch = branch.Code $sWhere";
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SELECT-AUTO-MIS":
        $CustomerID = $posted['CustomerName'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
//        $FromBranch = $posted['FromBranch'];
        $Status = $posted['Status'];
        if ($Status == "") {
            $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        } else {
            $sWhere = " WHERE BillingPartySelection ='$CustomerID'  AND Status = '$Status' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        }
        $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {

            if (mysqli_num_rows($rResult) > 0) {
                $docket_row = mysqli_fetch_assoc($rResult);
                $rowarray;
                while ($Rowdocket = mysqli_fetch_assoc($rResult)) {
                    $DocketID = $Rowdocket['DocketID'];
                    $displaytrackingrow[0] = "" . "|*|" . "" . "|*|" . $RGVP->MySQLDateDisplay . $docket_row["FromBranch"] . "";
                    $displaytrackingrow[1] = "Booked" . "|*|" . $docket_row["DocketNumber"] . "|*|" . "Docket Booked." . "|*|" . $RGVP->MySQLDateDisplay($docket_row["DocketDate"], $DisplayFormat = "d-m-Y");

                    $sql_input_manifest = "Select * from manifest where Dockets Like '%" . $DocketID . "%' and `Status`!='Cancelled'";
                    $sql_output_manifest = $RGVP->DB->Execute_Query($sql_input_manifest, "GET", "SQLObj");
                    if ($RGVP->DB->StatusCode == "502") {
                        if (mysqli_num_rows($sql_output_manifest) > 0) {
                            $manifest_row = mysqli_fetch_assoc($sql_output_manifest);

                            $displaytrackingrow[2] = "<a href='manifest-print.php?ID=" . $manifest_row["ManifestID"] . "'>" . $manifest_row["ManifestNumber"] . "( " . $manifest_row['Status'] . " )" . "</a>" . $manifest_row["ManifestDate"];
                            $sql_input_thc = "Select * from thc where Manifests Like '%" . $manifest_row["ManifestID"] . "%' ";
                            $sql_output_thc = $RGVP->DB->Execute_Query($sql_input_thc, "GET", "SQLObj");

                            if ($RGVP->DB->StatusCode == "502") {
                                if (mysqli_num_rows($sql_output_thc) > 0) {
                                    $thc_row = mysqli_fetch_assoc($sql_output_thc);

                                    $displaytrackingrow[3] = "THC" . "|*|<a href='thc-print.php?ID=" . $thc_row["THCID"] . "'>" . $thc_row["THCNumber"] . "(" . $thc_row["Status"] . ")" . "</a>|*|" . "THC Made" . $docket_row["ToBranch"] . "|*|" . $RGVP->MySQLDateDisplay($thc_row["THCDate"], $DisplayFormat = "d-m-Y");
                                }
                            }
                            if ($manifest_row["Status"] == "Delivered") {
                                $displaytrackingrow[4] = "" . "|*|" . "" . "|*|" . $RGVP->MySQLDateDisplay . $docket_row["ToBranch"] . "";
                                $sql_input_drs = "Select * from drs where Docket Like '%" . $DocketID . "%' ";
                                $sql_output_drs = $RGVP->DB->Execute_Query($sql_input_drs, "GET", "SQLObj");
                                if ($RGVP->DB->StatusCode == "502") {
                                    if (mysqli_num_rows($sql_output_drs) > 0) {
                                        $drs_row = mysqli_fetch_assoc($sql_output_drs);
                                        $displaytrackingrow[5] = "DRS" . "|*|<a href='view-drsprint.php?ID=" . $drs_row["DrsID"] . "'>" . $drs_row["DRSNumber"] . "(" . $drs_row["Status"] . ")" . "</a>" . $RGVP->MySQLDateDisplay($drs_row["DSRDate"], $DisplayFormat = "d-m-Y");
                                    }
                                }
                            }
                        }
                        if ($docket_row["POD"] != "") {
                            $docket_row["POD"] = $pod = '<a href = "../images/pod/' . $docket_row["POD"] . '" target = "_blank"><i class = "fa fa-download fa-2x"></i></a>';
                            $displaytrackingrow[6] = "POD" . "|*|" . $docket_row["FromBranch"] . "|*|" . "Docket Delivered." . "|*|" . $RGVP->MySQLDateDisplay($docket_row["DeliveredDate"], $DisplayFormat = "d-m-Y");
                        }
//$DisplayOutput = "";
                    }


                    $DocketNumber = $Rowdocket['DocketNumber'];
                    $DocketDate = $Rowdocket['DocketDate'];
                    $FromBranch = $Rowdocket['FromBranch'];
                    $ToBranch = $Rowdocket['ToBranch'];
                    $ToConsignee = $Rowdocket['ToConsignee'];
                    $ManifestNumber = $manifest_row["ManifestNumber"];
                    $ManifestDate = $manifest_row["ManifestDate"];
                    $THCNumber = $thc_row["THCNumber"];
                    $THCDate = $thc_row["THCDate"];
                    $DRSNumber = $drs_row["DRSNumber"];
                    $DSRDate = $drs_row["DSRDate"];
                    //$QTY = $Rowdocket['QTY'];
                    //$ActualWeight = $Rowdocket['ActualWeight'];
                    //$ChargedWeight = $Rowdocket['ChargedWeight'];
                    //$BasicFreight = $Rowdocket['BasicFreight'];
                    //$FOV = $Rowdocket['FOV'];
                    //$FuelSurcharge = $Rowdocket['FuelSurcharge'];
                    //$DocketCharge = $Rowdocket['DocketCharge'];
                    //$ODAOPA = $Rowdocket['ODAOPA'];
                    //$HandlingCharge = $Rowdocket['HandlingCharge'];
                    //$CODDACC = $Rowdocket['CODDACC'];
                    //$ToPayCharge = $Rowdocket['ToPayCharge'];
                    // $OtherCharges = $Rowdocket['OtherCharges'];
                    // $GSTAmt = $Rowdocket['GSTAmt'];
                    //$GrandTotal = $Rowdocket['GrandTotal'];
                    $Status = $Rowdocket['Status'];
                    $StatusRemark = $Rowdocket['StatusRemark'];
                    $DeliveredDate = $Rowdocket['DeliveredDate'];
                    $DocketDay = substr($DocketDate, 8, 2);
                    $DocketMonth = substr($DocketDate, 5, 2);
                    $DocketYear = substr($DocketDate, 0, 4);
                    $DiliverdDay = "";
                    $DiliverdMonth = "";
                    $DiliverdYear = "";
                    $DeliveredDatecalc="";
                    if ($DeliveredDate == " " || $DeliveredDate == "") {
                        $DiliverdDay = date("d");
                        $DiliverdMonth = date("m");
                        $DiliverdYear = date("Y");
                        $DeliveredDatecalc = date("Y-m-d");
                    }
                    else
                    {
                        $DeliveredDatecalc = substr($DeliveredDate,0,10);
                    }
$timediff = strtotime($DeliveredDatecalc)-strtotime($DocketDate);
$daydiff = intval($timediff/60/60/24);

                  
//                    $diff = date("d", $AgeingDate);
                    $Ageing = ($daydiff > 1)?$daydiff." Days":$daydiff." Day";
                   
                    $rowarray[] = array('DocketNumber' => $DocketNumber, 'DocketDate' => $DocketDate, 'FromBranch' => $FromBranch, 'ToBranch' => $ToBranch, 'ToConsignee' => $ToConsignee, 'ManifestNumber' => $ManifestNumber, 'ManifestDate' => $ManifestDate, 'THCNumber' => $THCNumber, 'THCDate' => $THCDate, 'DRSNumber' => $DRSNumber, 'DSRDate' => $DSRDate, 'Status' => $Status, 'StatusRemark ' => $StatusRemark, 'DeliveredDate' => $Rowdocket['DeliveredDate'], 'Ageing' => $Ageing);
                }

                // $DeliveredDate12;
                // $AgeingDate = $DeliveredDate12 - $DocketDate1;
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);

                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received", $sQuery);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }

        echo $returnstring;
        break;
    case "SELECT-CUSTOMER-LEDGER":
        $CustomerName = $posted['CustomerName'];
        $FromBranch = $posted['FromBranch'];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $sWhere = " WHERE customer_accounts.Branch_code ='$FromBranch' AND  customer.Name = '$CustomerName'";
        $sQuery = " SELECT customer.Name,customer_accounts.Branch_code,customer_accounts.Date_Transaction,customer_accounts.Transaction_type,
customer_accounts.TransactionID,customer_accounts.TransactionAmount
FROM customer
INNER JOIN customer_accounts
ON customer.CustomerID = customer_accounts.CustomerID";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received  ");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;

        break;
    case "SELECT-CUSTOMER-DOCKET":
        $sql_input = "";
        $docket_row = "";
        $manifest_row = "";
        $thc_row = "";
        $drs_row = "";
        $displayrow = "";
        $displaytrackingrow = array();
        $DisplayOutput = "";
        $pod = "Yet to Be Updated.";

        $CustomerID = $posted["CustomerID"];
        $StartDate = $posted['StartDate'];
        $EndDate = $posted['EndDate'];
        $Status = $posted['Status1'];
        if ($Status == "") {
            $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        } else {
            $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND Status = '$Status' AND DocketDate BETWEEN '$StartDate' AND '$EndDate'";
        }
        $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {

            if (mysqli_num_rows($rResult) > 0) {
                $docket_row = mysqli_fetch_assoc($rResult);
                $rowarray;

                while ($Rowdocket = mysqli_fetch_assoc($rResult)) {
                    $DocketID = $Rowdocket['DocketID'];
                    $displaytrackingrow[0] = "" . "|*|" . "" . "|*|" . $RGVP->MySQLDateDisplay . $docket_row["FromBranch"] . "";
                    $displaytrackingrow[1] = "Booked" . "|*|" . $docket_row["DocketNumber"] . "|*|" . "Docket Booked." . "|*|" . $RGVP->MySQLDateDisplay($docket_row["DocketDate"], $DisplayFormat = "d-m-Y");

                    $sql_input_manifest = "Select * from manifest where Dockets Like '%" . $DocketID . "%' and `Status`!='Cancelled'";
                    $sql_output_manifest = $RGVP->DB->Execute_Query($sql_input_manifest, "GET", "SQLObj");
                    if ($RGVP->DB->StatusCode == "502") {
                        if (mysqli_num_rows($sql_output_manifest) > 0) {
                            $manifest_row = mysqli_fetch_assoc($sql_output_manifest);

                            $displaytrackingrow[2] = "<a href='manifest-print.php?ID=" . $manifest_row["ManifestID"] . "'>" . $manifest_row["ManifestNumber"] . "( " . $manifest_row['Status'] . " )" . "</a>" . $manifest_row["ManifestDate"];
                            $sql_input_thc = "Select * from thc where Manifests Like '%" . $manifest_row["ManifestID"] . "%' ";
                            $sql_output_thc = $RGVP->DB->Execute_Query($sql_input_thc, "GET", "SQLObj");

                            if ($RGVP->DB->StatusCode == "502") {
                                if (mysqli_num_rows($sql_output_thc) > 0) {
                                    $thc_row = mysqli_fetch_assoc($sql_output_thc);

                                    $displaytrackingrow[3] = "THC" . "|*|<a href='thc-print.php?ID=" . $thc_row["THCID"] . "'>" . $thc_row["THCNumber"] . "(" . $thc_row["Status"] . ")" . "</a>|*|" . "THC Made" . $docket_row["ToBranch"] . "|*|" . $RGVP->MySQLDateDisplay($thc_row["THCDate"], $DisplayFormat = "d-m-Y");
                                }
                            }
                            if ($manifest_row["Status"] == "Delivered") {
                                $displaytrackingrow[4] = "" . "|*|" . "" . "|*|" . $RGVP->MySQLDateDisplay . $docket_row["ToBranch"] . "";
                                $sql_input_drs = "Select * from drs where Docket Like '%" . $DocketID . "%' ";
                                $sql_output_drs = $RGVP->DB->Execute_Query($sql_input_drs, "GET", "SQLObj");
                                if ($RGVP->DB->StatusCode == "502") {
                                    if (mysqli_num_rows($sql_output_drs) > 0) {
                                        $drs_row = mysqli_fetch_assoc($sql_output_drs);
                                        $displaytrackingrow[5] = "DRS" . "|*|<a href='view-drsprint.php?ID=" . $drs_row["DrsID"] . "'>" . $drs_row["DRSNumber"] . "(" . $drs_row["Status"] . ")" . "</a>" . $RGVP->MySQLDateDisplay($drs_row["DSRDate"], $DisplayFormat = "d-m-Y");
                                    }
                                }
                            }
                        }
                        if ($docket_row["POD"] != "") {
                            $docket_row["POD"] = $pod = '<a href = "../images/pod/' . $docket_row["POD"] . '" target = "_blank"><i class = "fa fa-download fa-2x"></i></a>';
                            $displaytrackingrow[6] = "POD" . "|*|" . $docket_row["FromBranch"] . "|*|" . "Docket Delivered." . "|*|" . $RGVP->MySQLDateDisplay($docket_row["DeliveredDate"], $DisplayFormat = "d-m-Y");
                        }
//$DisplayOutput = "";
                    }

                    $GSTAmt1 += $Rowdocket['GSTAmt'];
                    $GrandTotal1 += $Rowdocket['GrandTotal'];

                    $DocketNumber = $Rowdocket['DocketNumber'];
                    $DocketDate = $Rowdocket['DocketDate'];
                    $FromBranch = $Rowdocket['FromBranch'];
                    $ToBranch = $Rowdocket['ToBranch'];
                    $ToConsignee = $Rowdocket['ToConsignee'];
                    $ManifestNumber = $manifest_row["ManifestNumber"];
                    $ManifestDate = $manifest_row["ManifestDate"];
                    $THCNumber = $thc_row["THCNumber"];
                    $THCDate = $thc_row["THCDate"];
                    $DRSNumber = $drs_row["DRSNumber"];
                    $DSRDate = $drs_row["DSRDate"];
                    $QTY = $Rowdocket['QTY'];
                    $ActualWeight = $Rowdocket['ActualWeight'];
                    $ChargedWeight = $Rowdocket['ChargedWeight'];
                    $BasicFreight = $Rowdocket['BasicFreight'];
                    $FOV = $Rowdocket['FOV'];
                    $FuelSurcharge = $Rowdocket['FuelSurcharge'];
                    $DocketCharge = $Rowdocket['DocketCharge'];
                    $ODAOPA = $Rowdocket['ODAOPA'];
                    $HandlingCharge = $Rowdocket['HandlingCharge'];
                    $CODDACC = $Rowdocket['CODDACC'];
                    $ToPayCharge = $Rowdocket['ToPayCharge'];
                    $OtherCharges = $Rowdocket['OtherCharges'];
                    $GSTAmt = $Rowdocket['GSTAmt'];
                    $GrandTotal = $Rowdocket['GrandTotal'];
                    $Status = $Rowdocket['Status'];
                    $StatusRemark = $Rowdocket['StatusRemark'];

                    $rowarray[] = array('DocketNumber' => $DocketNumber, 'DocketDate' => $DocketDate, 'FromBranch' => $FromBranch, 'ToBranch' => $ToBranch, 'ToConsignee' => $ToConsignee, 'ManifestNumber' => $ManifestNumber, 'ManifestDate' => $ManifestDate, 'THCNumber' => $THCNumber, 'THCDate' => $THCDate, 'DRSNumber' => $DRSNumber, 'DSRDate' => $DSRDate, 'QTY' => $QTY, 'ActualWeight' => $ActualWeight, 'ChargedWeight' => $ChargedWeight, 'BasicFreight' => $BasicFreight, 'FOV' => $FOV, 'FuelSurcharge' => $FuelSurcharge, 'DocketCharge' => $DocketCharge, 'ODAOPA' => $ODAOPA, 'HandlingCharge' => $HandlingCharge, 'CODDACC' => $CODDACC, 'ToPayCharge' => $ToPayCharge, 'OtherCharges' => $OtherCharges, 'GSTAmt' => $GSTAmt, 'GrandTotal' => $GrandTotal, 'Status' => $Status, 'StatusRemark ' => $StatusRemark);

                    //$footarray[] = array('GSTAmt1' => $GSTAmt1, 'GrandTotal1' => $GrandTotal1);
                }


                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);

                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }

        echo $returnstring;
        break;
    case "SELECT-DAILY-CUSTOMER-DOCKET":

        $CustomerID = $posted["CustomerName"];
        $StartDate = $posted['StartDate'];
        $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND DocketDate = '$StartDate'";
        $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {
                $rowarray;
//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($row = mysqli_fetch_assoc($rResult)) {
                    $rowarray[] = $row;
                }
                $displaytabledata = json_encode($rowarray, JSON_PARTIAL_OUTPUT_ON_ERROR);


                $returnstring = $RGVP::GetStatus("750", TRUE, "Table Data Returned.", $displaytabledata);
            } else {
                $returnstring = $RGVP::GetStatus("751", FALSE, "No Data Received");
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;
        break;
    case "SEND-EMAIL":
        $CustomerID = $posted["Customerid"];
        $StartDate = $posted['date'];
        $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND DocketDate = '$StartDate'";
        echo $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        $displayTableHead = "<tr>
                                                <th>DocketID</th>
                                                <th>Docket No</th>
                                                <th>Status</th>
                                                <th>Status Remark</th>
                                                <th>Docket Date</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Consignee</th>
                                                <th>QTY</th>
                                                <th>Actual Weight</th>
                                                <th>Charged Weight</th>
                                                <th>Basic Freight</th>
                                                <th>FOV Charge</th>
                                                <th>Fuel Surcharge</th>
                                                <th>Docket Charge</th>
                                                <th>ODA/OPA Charge</th>
                                                <th>Handling Charge</th>
                                                <th>COD/DACC</th>
                                                <th>To-Pay Charge</th>
                                                <th>Other Charges</th>
                                                <th>GSTAmt</th>
                                                <th>GrandTotal</th>
                                            </tr>";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {

//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($Rowdocket = mysqli_fetch_assoc($rResult)) {
                    $ConsigneeName = $Rowdocket['ToConsignee'];
                    $QTY += $Rowdocket['QTY'];
                    $ActualWeight += $Rowdocket['ActualWeight'];
                    $ChargedWeight += $Rowdocket['ChargedWeight'];
                    $BasicFreight += $Rowdocket['BasicFreight'];
                    $FOV += $Rowdocket['FOV'];
                    $FuelSurcharge += $Rowdocket['FuelSurcharge'];
                    $DocketCharge += $Rowdocket['DocketCharge'];
                    $ODAOPA += $Rowdocket['ODAOPA'];
                    $HandlingCharge += $Rowdocket['HandlingCharge'];
                    $CODDACC += $Rowdocket['CODDACC'];
                    $ToPayCharge += $Rowdocket['ToPayCharge'];
                    $OtherCharges += $Rowdocket['OtherCharges'];
                    $GSTAmt += $Rowdocket['GSTAmt'];
                    $GrandTotal += $Rowdocket['GrandTotal'];

                    $displayTable .= '<tr>'
                            . '<td>' . $Rowdocket['DocketID'] . '</td>
            <td>' . $Rowdocket['DocketNumber'] . '</td>
            <td>' . $Rowdocket['Status'] . '</td>
            <td>' . $Rowdocket['StatusRemark'] . '</td>
            <td>' . $Rowdocket['DocketDate'] . ' </td>
            <td>' . $Rowdocket['FromBranch'] . ' </td>
            <td>' . $Rowdocket['ToBranch'] . ' </td>
            <td>' . $Rowdocket['ToConsignee'] . ' </td>
            <td>' . $Rowdocket['QTY'] . ' </td>
            <td>' . $Rowdocket['ActualWeight'] . ' </td>
            <td>' . $Rowdocket['ChargedWeight'] . ' </td>
            <td>' . $Rowdocket['BasicFreight'] . ' </td>
            <td>' . $Rowdocket['FOV'] . ' </td>
            <td>' . $Rowdocket['FuelSurcharge'] . ' </td>
            <td>' . $Rowdocket['DocketCharge'] . ' </td>
            <td>' . $Rowdocket['ODAOPA'] . ' </td>
            <td>' . $Rowdocket['HandlingCharge'] . ' </td>
            <td>' . $Rowdocket['CODDACC'] . '</td>
            <td>' . $Rowdocket['ToPayCharge'] . '</td>
            <td>' . $Rowdocket['OtherCharges'] . '</td>
            <td>' . $Rowdocket['GSTAmt'] . '</td>
            <td>' . $Rowdocket['GrandTotal'] . ' </td>';
                    ' </tr>';
                }
                $email_body = "You have received a Daily Customer Reports.\n\n" . "Here are the details:<br/>\n\n
   <img src='RGVPWebImagesURL/a1logo.png' alt=''/>
    <h4>Customer Name:$ConsigneeName<h4>
        <h4>Date:$StartDate</h4>
        <table class='' border=1>
            <thead>" . $displayTableHead . "</thead>
            <tbody>" . $displayTable . "</tbody>
            <tfoot>
                <tr>
                <th colspan='7'></th>
                <th>Total</th>
                <th>" . $QTY . "</th>
                <th> " . $ActualWeight . "</th>
                <th>" . $ChargedWeight . "</th>
                <th>" . $BasicFreight . "</th>
                <th>" . $FOV . "</th>
                <th>" . $FuelSurcharge . "</th>
                <th>" . $DocketCharge . "</th>
                <th>" . $ODAOPA . "</th>
                <th> " . $HandlingCharge . "</th>
                <th> " . $CODDACC . "</th>
                <th> " . $ToPayCharge . "</th>
                <th> " . $OtherCharges . "</th>
                <th> " . $GSTAmt . "</th>
                <th> " . $GrandTotal . "</th>
                </tr>
                </tfoot>
            </table>";
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;


        $to = 'madhuri@bifs.in'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Website Contact:  $ConsigneeName";

        echo RGVP_Mailer::SendMail($email_subject, $email_body, $to);
        break;
    case "SEND-EMAIL":
        $CustomerID = $posted["Customerid"];
        $StartDate = $posted['date'];
        $sWhere = " WHERE BillingPartySelection ='$CustomerID' AND DocketDate = '$StartDate'";
        echo $sQuery = " SELECT * FROM docket $sWhere";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");

        $displayTableHead = "<tr>
                                                <th>DocketID</th>
                                                <th>Docket No</th>
                                                <th>Status</th>
                                                <th>Status Remark</th>
                                                <th>Docket Date</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Consignee</th>
                                                <th>QTY</th>
                                                <th>Actual Weight</th>
                                                <th>Charged Weight</th>
                                                <th>Basic Freight</th>
                                                <th>FOV Charge</th>
                                                <th>Fuel Surcharge</th>
                                                <th>Docket Charge</th>
                                                <th>ODA/OPA Charge</th>
                                                <th>Handling Charge</th>
                                                <th>COD/DACC</th>
                                                <th>To-Pay Charge</th>
                                                <th>Other Charges</th>
                                                <th>GSTAmt</th>
                                                <th>GrandTotal</th>
                                            </tr>";
        if ($RGVP->DB->StatusCode == "502") {
            $aRow = mysqli_num_rows($rResult);
            if ($aRow > 0) {

//$displaytabledata = json_encode($rResult,JSON_PARTIAL_OUTPUT_ON_ERROR);
                while ($Rowdocket = mysqli_fetch_assoc($rResult)) {
                    $ConsigneeName = $Rowdocket['ToConsignee'];
                    $QTY += $Rowdocket['QTY'];
                    $ActualWeight += $Rowdocket['ActualWeight'];
                    $ChargedWeight += $Rowdocket['ChargedWeight'];
                    $BasicFreight += $Rowdocket['BasicFreight'];
                    $FOV += $Rowdocket['FOV'];
                    $FuelSurcharge += $Rowdocket['FuelSurcharge'];
                    $DocketCharge += $Rowdocket['DocketCharge'];
                    $ODAOPA += $Rowdocket['ODAOPA'];
                    $HandlingCharge += $Rowdocket['HandlingCharge'];
                    $CODDACC += $Rowdocket['CODDACC'];
                    $ToPayCharge += $Rowdocket['ToPayCharge'];
                    $OtherCharges += $Rowdocket['OtherCharges'];
                    $GSTAmt += $Rowdocket['GSTAmt'];
                    $GrandTotal += $Rowdocket['GrandTotal'];

                    $displayTable .= '<tr>'
                            . '<td>' . $Rowdocket['DocketID'] . '</td>
            <td>' . $Rowdocket['DocketNumber'] . '</td>
            <td>' . $Rowdocket['Status'] . '</td>
            <td>' . $Rowdocket['StatusRemark'] . '</td>
            <td>' . $Rowdocket['DocketDate'] . ' </td>
            <td>' . $Rowdocket['FromBranch'] . ' </td>
            <td>' . $Rowdocket['ToBranch'] . ' </td>
            <td>' . $Rowdocket['ToConsignee'] . ' </td>
            <td>' . $Rowdocket['QTY'] . ' </td>
            <td>' . $Rowdocket['ActualWeight'] . ' </td>
            <td>' . $Rowdocket['ChargedWeight'] . ' </td>
            <td>' . $Rowdocket['BasicFreight'] . ' </td>
            <td>' . $Rowdocket['FOV'] . ' </td>
            <td>' . $Rowdocket['FuelSurcharge'] . ' </td>
            <td>' . $Rowdocket['DocketCharge'] . ' </td>
            <td>' . $Rowdocket['ODAOPA'] . ' </td>
            <td>' . $Rowdocket['HandlingCharge'] . ' </td>
            <td>' . $Rowdocket['CODDACC'] . '</td>
            <td>' . $Rowdocket['ToPayCharge'] . '</td>
            <td>' . $Rowdocket['OtherCharges'] . '</td>
            <td>' . $Rowdocket['GSTAmt'] . '</td>
            <td>' . $Rowdocket['GrandTotal'] . ' </td>';
                    ' </tr>';
                }
                $email_body = "You have received a Daily Customer Reports.\n\n" . "Here are the details:<br/>\n\n
   <img src='RGVPWebImagesURL/a1logo.png' alt=''/>
    <h4>Customer Name:$ConsigneeName<h4>
        <h4>Date:$StartDate</h4>
        <table class='' border=1>
            <thead>" . $displayTableHead . "</thead>
            <tbody>" . $displayTable . "</tbody>
            <tfoot>
                <tr>
                <th colspan='7'></th>
                <th>Total</th>
                <th>" . $QTY . "</th>
                <th> " . $ActualWeight . "</th>
                <th>" . $ChargedWeight . "</th>
                <th>" . $BasicFreight . "</th>
                <th>" . $FOV . "</th>
                <th>" . $FuelSurcharge . "</th>
                <th>" . $DocketCharge . "</th>
                <th>" . $ODAOPA . "</th>
                <th> " . $HandlingCharge . "</th>
                <th> " . $CODDACC . "</th>
                <th> " . $ToPayCharge . "</th>
                <th> " . $OtherCharges . "</th>
                <th> " . $GSTAmt . "</th>
                <th> " . $GrandTotal . "</th>
                </tr>
                </tfoot>
            </table>";
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, $sQuery, $sQuery);
        }
        echo $returnstring;


        $to = 'madhuri@bifs.in'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Website Contact:  $ConsigneeName";

        echo RGVP_Mailer::SendMail($email_subject, $email_body, $to);
        break;
    default:
        echo "Invalid Command.";
        break;
}



