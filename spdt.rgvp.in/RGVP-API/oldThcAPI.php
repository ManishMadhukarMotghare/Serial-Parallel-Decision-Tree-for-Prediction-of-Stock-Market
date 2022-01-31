<?php

include "include.php"; // VARIABLES
$SelectColumns = array("THCID", "THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "ContractAmt", "OtherAmt", "TotalAmt", "AdvanceAmt", "BalanceAmt", "AdvancedPayBranch", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "ContractAmt", "OtherAmt", "TotalAmt", "AdvanceAmt", "BalanceAmt", "AdvancedPayBranch", "Status", "AddedBy", "UpdateBy");
$UpdateColumns = array("THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "ContractAmt", "OtherAmt", "TotalAmt", "AdvanceAmt", "BalanceAmt", "AdvancedPayBranch", "Status", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_THCNumber", "date_THCDate", "txt_FromBranch", "txt_ToBranch", "txt_RouteID", "txt_Manifests", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnloadedBy", "txt_UnloadingSupervisor", "txt_VendorType", "txt_VendorPANNo", "txt_VendorName", "txt_DriverID", "txt_DriverName", "txt_DriverPhone", "txt_DriverLicence", "txt_VehicleID", "txt_VehicleNo", "txt_EngineNo", "date_InsuranceExpDate", "txt_ChasisNo", "date_FitnessExpDate", "txt_Seal", "txt_OpeningKM", "txt_ContractAmount", "txt_OtherAmount", "txt_TotalAmount", "txt_AdvancedAmt", "txt_BalancedAmount", "txt_AdvancedPayBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_THCNumber", "date_THCDate", "txt_FromBranch", "txt_ToBranch", "txt_RouteID", "txt_Manifests", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnloadedBy", "txt_UnloadingSupervisor", "txt_VendorType", "txt_VendorPANNo", "txt_VendorName", "txt_DriverID", "txt_DriverName", "txt_DriverPhone", "txt_DriverLicence", "txt_VehicleID", "txt_VehicleNo", "txt_EngineNo", "date_InsuranceExpDate", "txt_ChasisNo", "date_FitnessExpDate", "txt_Seal", "txt_OpeningKM", "txt_ContractAmount", "txt_OtherAmount", "txt_TotalAmount", "txt_AdvancedAmt", "txt_BalancedAmount", "txt_AdvancedPayBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "THCID";
$sTable = "thc";
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

function ReplaceString($Content) {
    $Content = str_replace('|', ",", $Content);
    return $Content;
}

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;
    case "INSERT":
        // AJAX ADD FROM JQUERY
        if (isset($_REQUEST)) {
            //dbinit($gaSql);
            foreach ($InsertColumnsData as $FieldData)
                $InsertColDataString .= "'" . $posted[$FieldData] . "',";
            $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString) - 1);
            $Sql_input = "INSERT INTO $sTable (" . implode(",", $InsertColumns) . ") VALUES ($InsertColDataString)";

            $Sql_input = str_replace(",,", ",'',", $Sql_input);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT");
            if ($RGVP->DB->StatusCode == "502") {
                $id = $RGVP->DB->PrimaryKeyID;
                $thcnumber = "THC/" . $posted["txt_FromBranch"] . "/" . $id . "";
                $Sql_input = "UPDATE thc Set THCNumber = '$thcnumber', Status = 'Intransit' where THCID = $id ";
                $Sql_output_update_thc = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
                $Manifests = $posted['txt_Manifests'];
                $manifest = ReplaceString($Manifests);
                $Sql_input_manifest_status = "UPDATE manifest Set Status = 'Intransit' where ManifestID in ($manifest) ";
                $Sql_output_manifest = $RGVP->DB->Execute_Query($Sql_input_manifest_status, "SET", "UPDATE");
            }
        }
        header("location:../thc-print.php?ID=$id");
        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        if (isset($_GET["txt_THCID"]) && 0 < intval($_GET["txt_THCID"])) {
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
           $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["txt_THCID"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

            // GET DATA
//            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["txt_THCID"]);
//            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
             header("location:../thc-view.php?txt_id= $THCNumber");
        }
       
        break;
    case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
            $Sql_input = " DELETE FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "DELETE");
            if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                echo $RGVP->DB->Exception . $RGVP->DB->Msg;
            }
        }
        break;
    case "SELECT-WITH-ID":
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "SELECT-THC":
// QUERY LIMIT
        $sLimit = "";
// QUERY ORDER
        $sOrder = "";
// QUERY SEARCH
        $sWhere = "";

        // BUILD QUERY
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE Status ='Intransit'";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="thc-view.php?txt_id=' . $row[1] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECTTHCARRIVAL-Arriving":
        // QUERY LIMIT
        $sLimit = "";

        // QUERY ORDER
        $sOrder = "";
        $SWhere = "";

        if (isset($_REQUEST["BranchCode"]))
            if ($_REQUEST["BranchCode"] != "")
                $sWhere = "AND ToBranch= '" . $_REQUEST["BranchCode"] . "'";
        $sOrder = "order by THCID desc";
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT * From thc WHERE Status = 'Intransit' $sWhere $sOrder $sLimit";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="thc-arrival-view.php?txt_THCID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECTTHCARRIVAL-Arrived":
        // QUERY LIMIT
        $sLimit = "";

        // QUERY ORDER
        $sOrder = "";
        $SWhere = "";

        if (isset($_REQUEST["BranchCode"]))
            if ($_REQUEST["BranchCode"] != "")
                $sWhere = "AND ToBranch= '" . $_REQUEST["BranchCode"] . "'";
        $sOrder = "order by THCID desc";
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT * From thc WHERE Status = 'Delivered' $sWhere $sOrder $sLimit";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
        $sQueryDisplay .= $sQuery . "\n";
        $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
        $output = array();
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if ($SelectColumns[$i] == "version")
                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                else if ($SelectColumns[$i] != " ")
                    $row[] = $aRow[$SelectColumns[$i]];
            }
            $output["data"][] = array_merge(array('<a href="thc-print.php?ID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;

    case "UPDATE-THCARRIVAL":
        $posted["txt_ClosingKm"];
        $posted["txt_ArrivalTime"];
        $posted["txt_DelayEarly"];
        $posted["txt_Remark"];
        $dockets = $posted["txt_Docket"];
        $Manifests = $posted["txt_manifest"];
        $DocketsArray = explode("|", $dockets);
        $DocketsStr = implode(",", $DocketsArray);
        //Dockets String Formating
        $DocketsStr = str_replace(",,", ",", $DocketsStr);
        $DocketsStr = str_replace(",,", ",", $DocketsStr);
        $DocketsStr = str_replace(",,", ",", $DocketsStr);
        $DocketsStr = str_replace(",,", ",", $DocketsStr);
        $DocketsStr = str_replace(",,", ",", $DocketsStr);

        $ManifestsArray = explode("|", $Manifests);
        $ManifestsStr = implode(",", $ManifestsArray);
        //Manifests String Formating
        $ManifestsStr = str_replace(",,", ",", $ManifestsStr);
        $ManifestsStr = str_replace(",,", ",", $ManifestsStr);
        $ManifestsStr = str_replace(",,", ",", $ManifestsStr);
        $ManifestsStr = str_replace(",,", ",", $ManifestsStr);
        $ManifestsStr = str_replace(",,", ",", $ManifestsStr);


        $Manifest = ReplaceString($Manifests);
        $Sql_input = "UPDATE thc SET StatusRemark = '" . $posted["txt_Remark"] . "',ClosingKm = '" . $posted["txt_ClosingKm"] . "',ArrivalTime = '" . $posted["txt_ArrivalTime"] . "',DeliveredDate = '" . $posted["txt_ArrivalTime"] . "',DelayEarly = '" . $posted["txt_DelayEarly"] . "',Status = 'Delivered' where THCID= '" . $posted['id'] . "'";
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");


        $Sql_input_manifest = " UPDATE manifest SET Status ='Delivered', DeliveredDate = '" . date("Y-m-d H:i:s") . "' where ManifestID in ($ManifestsStr)";
        $Sql_output_manifest = $RGVP->DB->Execute_Query($Sql_input_manifest, "SET", "UPDATE");

        foreach ($dockets as $docket) {
            $docketinputID = "txt_doc_" . $docket;
            $Sql_input1 = "UPDATE docket SET Remark = '" . $posted[$docketinputID] . "' WHERE DocketID = $docket"; // SET Status ='Delivered', DeliveredDate = ".date("Y-m-d H:i:s")." where THCID=".$posted["txt_THCID"];
            $Sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "SET", "UPDATE");
        }
        header("location:../thc-arrival-list.php?status=success&msg=THC Arrived Successfully.");
        break;

    default:
        echo "Invalid Command.";
        break;
}