<?php

include "include.php"; // VARIABLES
$SelectColumns = array("ID", "Nifty50", "SGXNifty", "DJIA30", "Nasdaq100", "Russel2000", "SnP500", "FTSE100", "Nikkei225", "CAC40", "DAX30", "HangSeng", "SSE180", "MCXBulldex", "GoldFutureIndia", "CrudeOil", "WebInfoData", "IndianTVNews", "SocialMediaFeed", "BrokeragesHouseNews", "FIISData", "DIISData", "GlobalTrend", "Nifty50WeeklyExpiry", "Nifty50MonthlyExpiry", "PandemicWarSituation", "Output"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("Nifty50", "SGXNifty", "DJIA30", "Nasdaq100", "Russel2000", "SnP500", "FTSE100", "Nikkei225", "CAC40", "DAX30", "HangSeng", "SSE180", "MCXBulldex", "GoldFutureIndia", "CrudeOil", "WebInfoData", "IndianTVNews", "SocialMediaFeed", "BrokeragesHouseNews", "FIISData", "DIISData", "GlobalTrend", "Nifty50WeeklyExpiry", "Nifty50MonthlyExpiry", "PandemicWarSituation", "Output");
$UpdateColumns = array("Nifty50", "SGXNifty", "DJIA30", "Nasdaq100", "Russel2000", "SnP500", "FTSE100", "Nikkei225", "CAC40", "DAX30", "HangSeng", "SSE180", "MCXBulldex", "GoldFutureIndia", "CrudeOil", "WebInfoData", "IndianTVNews", "SocialMediaFeed", "BrokeragesHouseNews", "FIISData", "DIISData", "GlobalTrend", "Nifty50WeeklyExpiry", "Nifty50MonthlyExpiry", "PandemicWarSituation", "Output");
$InsertColumnsData = array("txt_Nifty50", "txt_SGXNifty", "txt_DJIA30", "txt_Nasdaq100", "txt_Russel2000", "txt_SnP500", "txt_FTSE100", "txt_Nikkei225", "txt_CAC40", "txt_DAX30", "txt_HangSeng", "txt_SSE180", "txt_MCXBulldex", "txt_GoldFutureIndia", "txt_CrudeOil", "txt_WebInfoData", "txt_IndianTVNews", "txt_SocialMediaFeed", "txt_BrokeragesHouseNews", "txt_FIISData", "txt_DIISData", "txt_GlobalTrend", "txt_Nifty50WeeklyExpiry", "txt_Nifty50MonthlyExpiry", "txt_PandemicWarSituation", "txt_Output");
$ColumnAPIUpdateData = array("txt_Nifty50", "txt_SGXNifty", "txt_DJIA30", "txt_Nasdaq100", "txt_Russel2000", "txt_SnP500", "txt_FTSE100", "txt_Nikkei225", "txt_CAC40", "txt_DAX30", "txt_HangSeng", "txt_SSE180", "txt_MCXBulldex", "txt_GoldFutureIndia", "txt_CrudeOil", "txt_WebInfoData", "txt_IndianTVNews", "txt_SocialMediaFeed", "txt_BrokeragesHouseNews", "txt_FIISData", "txt_DIISData", "txt_GlobalTrend", "txt_Nifty50WeeklyExpiry", "txt_Nifty50MonthlyExpiry", "txt_PandemicWarSituation", "txt_Output");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "ID";
$sTable = "NiftyDataset";
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB::GetConnection();
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
            $id = $RGVP->DB->PrimaryKeyID;
            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
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
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
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
            $output["data"][] = array_merge($row, array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECT-TRAINING-DATASET":
        // FETCH
        if ($posted["Percent"] == 'undefined') {
            $posted["Percent"] = 70;
        }
        $percent = intval($posted["Percent"]);
        $slimit = intval(10 * $percent / 100);
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable  order by $sIndexColumn LIMIT $slimit";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $output = array();
        while ($aRow = mysqli_fetch_assoc($rResult)) {
            $row = array();
//            for ($i = 0; $i < count($SelectColumns); $i++) {
//                if ($SelectColumns[$i] == "version") {
//                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
//                } else if ($SelectColumns[$i] != " ") {
//                    $row[] = $aRow[$SelectColumns[$i]];
//                }
//            }
            $output["data"][] = $aRow; //$row
        }
        //$output["data"][] = $aRow;//$row
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    case "SELECT-TESTING-DATASET":
        // FETCH
        if ($posted["Percent"] == 'undefined') {
            $posted["Percent"] = 30;
        }
        $percent = intval($posted["Percent"]);
        $slimit = intval(10 * $percent / 100);
        $sQueryDisplay = "";
        $sQuery = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable  order by $sIndexColumn desc LIMIT $slimit";
        $sQueryDisplay .= $sQuery . "\n";
        $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
        $output = array();
        while ($aRow = mysqli_fetch_assoc($rResult)) {
            $row = array();
//            for ($i = 0; $i < count($SelectColumns); $i++) {
//                if ($SelectColumns[$i] == "version") {
//                    $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
//                } else if ($SelectColumns[$i] != " ") {
//                    $row[] = $aRow[$SelectColumns[$i]];
//                }
//            }
            $output["data"][] = $aRow; //$row
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}