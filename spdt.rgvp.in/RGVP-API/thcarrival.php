<?php

include "include.php"; // VARIABLES
$SelectColumns = array("THCID", "THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "AdvancedAmt", "AdvancedPayBranch", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "AdvancedAmt", "AdvancedPayBranch", "Status", "AddedBy", "UpdateBy","OtherAmt","ContractAmt","TotalAmt","BalancedAmt");
$UpdateColumns = array("THCNumber", "THCDate", "FromBranch", "ToBranch", "RouteID", "Manifests", "LoadedBy", "LoadingSupervisor", "UnloadedBy", "UnloadingSupervisor", "VendorType", "VendorPANNo", "VendorName", "DriverID", "DriverName", "DriverPhone", "DriverLicence", "VehicleID", "VehicleNo", "EngineNo", "InsuranceExpDate", "ChasisNo", "FitnessExpDate", "Seal", "OpeningKM", "AdvancedAmt", "AdvancedPayBranch", "Status", "AddedBy", "UpdateBy","OtherAmt","ContractAmt","TotalAmt","BalancedAmt");
$InsertColumnsData = array("txt_THCNumber", "date_THCDate", "txt_FromBranch", "txt_ToBranch", "txt_RouteID", "txt_Manifests", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnloadedBy", "txt_UnloadingSupervisor", "txt_VendorType", "txt_VendorPANNo", "txt_VendorName", "txt_DriverID", "txt_DriverName", "txt_DriverPhone", "txt_DriverLicence", "txt_VehicleID", "txt_VehicleNo", "txt_EngineNo", "date_InsuranceExpDate", "txt_ChasisNo", "date_FitnessExpDate", "txt_Seal", "txt_OpeningKM", "txt_AdvancedAmt", "txt_AdvancedPayBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy","txt_OtherAmount","txt_ContractAmount","txt_TotalAmount","txt_BalancedAmount");
$ColumnAPIUpdateData = array("txt_THCNumber", "date_THCDate", "txt_FromBranch", "txt_ToBranch", "txt_RouteID", "txt_Manifests", "txt_LoadedBy", "txt_LoadingSupervisor", "txt_UnloadedBy", "txt_UnloadingSupervisor", "txt_VendorType", "txt_VendorPANNo", "txt_VendorName", "txt_DriverID", "txt_DriverName", "txt_DriverPhone", "txt_DriverLicence", "txt_VehicleID", "txt_VehicleNo", "txt_EngineNo", "date_InsuranceExpDate", "txt_ChasisNo", "date_FitnessExpDate", "txt_Seal", "txt_OpeningKM", "txt_AdvancedAmt", "txt_AdvancedPayBranch", "ddl_Status", "txt_AddedBy", "txt_UpdateBy","txt_OtherAmount","txt_ContractAmount","txt_TotalAmount","txt_BalancedAmount");
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
                //$Sql_input1 = "UPDATE thc Set Status = 'Intransit' where THCID in ($manifest) ";
                //$Sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "SET", "UPDATE");
                $Sql_input_manifest_status = "UPDATE manifest Set Status = 'Intransit' where ManifestID in ($manifest) ";
                $Sql_output_manifest = $RGVP->DB->Execute_Query($Sql_input_manifest_status, "SET", "UPDATE");
                $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = $id";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
                die(json_encode(mysqli_fetch_assoc($Sql_output)));
            }
        }
        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

            // GET DATA
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
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
    case "SELECT":
        // QUERY LIMIT
        $sLimit = "";
        if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
            $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
        }
        // QUERY ORDER
        $sOrder = "";
        if (isset($_GET["iSortCol_0"])) {
            $sOrder = "ORDER BY ";
            for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                    $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY")
                $sOrder = "";
        }
        // QUERY SEARCH
        $sWhere = "";
        if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ")";
        }
        // BUILD QUERY
        for ($i = 0; $i < count($SelectColumns); $i++) {
            if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                if ($sWhere == "")
                    $sWhere = "WHERE ";
                else
                    $sWhere .= " AND ";
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
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
            $output["data"][] = array_merge(array('<a href="view-thcarrival.php?txt_id=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;

    case "StatusChange":
        $Sql_input = " UPDATE thc SET Status ='Delivered', DeliveredDate = '" . date("Y-m-d") . "' where THCID=" . $posted["txt_THCID"];
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        $Sql_input = " SELECT Manifests from thc where THCID=" . $posted["txt_THCID"]; // SET Status ='Delivered', DeliveredDate = ".date("Y-m-d H:i:s")." where THCID=".$posted["txt_THCID"];
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $row = mysqli_fetch_assoc($Sql_output);
        $row["Manifests"];
        $manifests = explode("|", $row["Manifests"]);
        //var_dump($manifests);
        $manifests = implode(",", $manifests);
        //var_dump($manifests);

        $Sql_input_manifest = " UPDATE manifest SET Status ='Delivered', DeliveredDate = '" . date("Y-m-d H:i:s") . "' where $manifests in ($manifests)";
        $Sql_output_manifest = $RGVP->DB->Execute_Query($Sql_input_manifest, "SET", "UPDATE");
        //echo $Sql_input = " UPDATE manifest SET Status ='Delivered', DeliveredDate = '".date("Y-m-d H:i:s")."' where THCID=".$posted["txt_THCID"];
        //$Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

        header("location:../Thcarrival.php");
        break;

    case "SELECTTHCARRIVAL":
        // QUERY LIMIT
        $sLimit = "";
        if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
            $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
        }
        // QUERY ORDER
        $sOrder = "";
        if (isset($_GET["iSortCol_0"])) {
            $sOrder = "ORDER BY ";
            for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                    $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY")
                $sOrder = "";
        }
        // QUERY SEARCH
        $sWhere = "";
        if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($SelectColumns); $i++) {
                if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ")";
        }
        // BUILD QUERY
        for ($i = 0; $i < count($SelectColumns); $i++) {
            if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                if ($sWhere == "")
                    $sWhere = "WHERE ";
                else
                    $sWhere .= " AND ";
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT * From thc WHERE Status = 'Intransit' ";
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
            $output["data"][] = array_merge(array('<a href="RGVP-API/thc.php?txt_THCID=' . $row[0] . '&CommandType=StatusChange" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row, $row);
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
        
    //$dockets = ReplaceString($dockets);
         $Manifest=ReplaceString($Manifests);
        $Sql_input = "UPDATE thc SET StatusRemark = '" . $posted["txt_Remark"] . "',ClosingKm = '" . $posted["txt_ClosingKm"] . "',ArrivalTime = '" . $posted["txt_ArrivalTime"] . "',DeliveredDate = '" . $posted["txt_ArrivalTime"] . "',DelayEarly = '" . $posted["txt_DelayEarly"] . "',Status = 'Delivered' where THCID= '" . $posted['id'] . "'";
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
$dockets = explode("|",$dockets);
    
        $Sql_input_manifest = " UPDATE manifest SET Status ='Delivered', DeliveredDate = '" . date("Y-m-d H:i:s") . "' where ManifestID in ($Manifest)";
        $Sql_output_manifest = $RGVP->DB->Execute_Query($Sql_input_manifest, "SET", "UPDATE");
        
        foreach($dockets as $docket) {
            $docketinputID = "txt_doc_" . $docket;
            $Sql_input1 = "UPDATE docket SET Remark = '".$posted[$docketinputID]."' WHERE DocketID = $docket"; // SET Status ='Delivered', DeliveredDate = ".date("Y-m-d H:i:s")." where THCID=".$posted["txt_THCID"];
            $Sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "SET", "UPDATE");
        }
 header("location:../Thcarrival.php");
        break;

    default:
        echo "Invalid Command.";
        break;
}